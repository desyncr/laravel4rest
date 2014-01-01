<?php

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testCreateUser()
    {
        $email = 'test@test.com';
        $pass = 'test';
        $user = $this->createUser($email, $pass);
        $password = $user->getAuthPassword();
        $this->assertEquals($pass, $password);
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testNonAuthUserRequest()
    {
        Route::enableFilters();
        $crawler = $this->call('GET', 'api/v1/task');
        $this->assertResponseStatus(401);
    }

    public function testAuthorizedUserRequest()
    {
        $user = self::createUser();
        $this->be($user);

        Route::enableFilters();
        $crawler = $this->call('GET', 'api/v1/task');
        $this->assertResponseStatus(200);
    }

    public function testUserWithoutTasks()
    {
        $user = $this->createUser();
        $this->be($user);

        Route::enableFilters();

        $response = $this->getTasks($user);

        $this->assertEquals(false, $response->error);
        $this->assertEquals(0, count($response->tasks));
    }

    public function testUserWithTasks()
    {
        $user = $this->createUser();
        $task = $this->createTask($user, 'Example task');
        $this->be($user);

        $response = $this->getTasks($user);

        $this->assertEquals(false, $response->error);
        $this->assertEquals(1, count($response->tasks));
        array_map(function ($task) use ($user) {
            $this->assertEquals($user->id, $task->user);
        }, $response->tasks);
    }


    public function testAccessOtherUsersTasks()
    {
        $user = $this->createUser();
        $task = $this->createTask($user, 'Task user 1');

        $user2 = $this->createUser();
        $task2 = $this->createTask($user2, 'Task user 2');
        $this->be($user2);

        $response = $this->getTasks($user2);

        $this->assertEquals(false, $response->error);
        $this->assertEquals(1, count($response->tasks));
        array_map(function($task) use ($user2) {
            $this->assertEquals($user2->id, $task->user);
        }, $response->tasks);

        $response = $this->getTask($task->id, $user2);
        $this->assertTrue($response->error);
        $this->assertEquals(null, $response->task);
    }

    public function testAccessNonExistentTask()
    {
        $user = $this->createUser();
        $task = $this->createTask($user, 'Task user 1');

        $response = $this->getTask($task->id, $user);
        $this->assertTrue(is_object($response));
        $this->assertEquals($task->id, $response->task->id);

        $response = $this->getTask(++$task->id, $user);
        $this->assertTrue(is_object($response));
        $this->assertEquals(null, $response->task);
    }

    private function createUser($email = 'test@test.com', $password = 'test')
    {
        $user = new User;
        $user->email = rand(0, 123) . $email;
        $user->password = $password;
        $user->save();

        return $user;
    }

    private function getTasks($user)
    {
        $this->be($user);
        $crawler = $this->call('GET', 'api/v1/task');
        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $crawler);
        $response = json_decode($crawler->getContent());

        return $response;
    }

    private function getTask($id, $user)
    {
        $this->be($user);
        $crawler = $this->call('GET', '/api/v1/task/'. $id);

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $crawler);
        $response = json_decode($crawler->getContent());

        return $response;
    }

    private function createTask($user, $title = 'Default task title', $completed = false)
    {

        $task = new Task;
        $task->title = $title;
        $task->completed = $completed;
        $task->user = $user->id;

        $task->save();

        return $task;

    }

}
