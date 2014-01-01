<?php

class TasksController extends BaseController
{
    public function index()
    {
        $tasks = Task::where('user', Auth::user()->id)->get();

        return Response::json(array(
                'error' => false,
                'tasks' => $tasks->toArray()),
                200
        );

    }

    public function store()
    {
        $task = new Task;
        $task->user = Auth::user()->id;
        $task->title = Input::get('title');
        $task->completed = Input::get('completed');
        $task->save();

        return Response::json(array(
                'error' => false,
                'task' => $task->toArray()),
                200
            );
    }

    public function destroy($id)
    {
        if ($task = Task::where('user', Auth::user()->id)->find($id)) {
            $res = $task->delete();
        } else {
            $res = false;
        }

        return Response::json(array(
            'error' => !$res),
            200
        );

    }

    public function show($id)
    {
        $error = false;
        if ($task = Task::where('user', Auth::user()->id)->find($id)) {
            $task = $task->toArray();
        } else {
            $error = true;
        }

        return Response::json(array(
            'error' => $error,
            'task' => $task
        ), 200);

    }

    public function update($id)
    {
        $error = false;
        if (!$task = Task::where('user', Auth::user()->id)->find($id)) {
            $error = true;

        } else {

            if ($title = Input::get('title')) {
                $task->title = $title;
            }

            $task->completed = Input::get('completed');

            $task->save();
            $task = $task->toArray();
        }

        return Response::json(array(
            'error' => $error,
            'task' => $task
        ), 200);
    }
}
