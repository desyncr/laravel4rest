<?php
class TasksTableSeeder extends Seeder {
    public function run() {

        DB::table('tasks')->delete();
        Task::create(
            array('user' => 1, 'title' => 'Go to the market. Buy stuff I dont need.', 'completed' => false, 'created_at' => new DateTime, 'updated_at' => new DateTime)
        );
        Task::create(
            array('user' => 1, 'title' => 'Dont kill myself', 'completed' => false, 'created_at' => new DateTime, 'updated_at' => new DateTime)
        );
        Task::create(
            array('user' => 2, 'title' => 'Keep wasting my life', 'completed' => false, 'created_at' => new DateTime, 'updated_at' => new DateTime)
        );
    }

}
