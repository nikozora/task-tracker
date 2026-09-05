<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
public function index()
{
    $taskModel = new TaskModel();

    $userId = session()->get('user_id');

    $search = $this->request->getGet('search');
    $status = $this->request->getGet('status');

    $taskModel
        ->where('user_id', $userId);

    // Search by task name
    if (!empty($search)) {
        $taskModel
            ->like('task_name', $search);
    }

    // Filter by status
    if (!empty($status)) {
        $taskModel
            ->where('status', $status);
    }

    $data['tasks'] = $taskModel
        ->orderBy('id', 'DESC')
        ->paginate(10);

    $data['pager'] = $taskModel->pager;

    $data['pager']->setPath('/tasks');
    
    $data['search'] = $search;
    $data['status'] = $status;

    return view('tasks/index', $data);
}


    public function create()
    {
        return view('tasks/create');
    }


    public function store()
    {
        $taskModel = new TaskModel();
        $userId = session()->get('user_id');


        $taskModel->insert([
            'user_id' => session()->get('user_id'),
            'task_name' => $this->request->getPost('task_name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'notes' => $this->request->getPost('notes')
        ]);

        return redirect()->to('/tasks');
    }


    public function edit($id)
    {
        $taskModel = new TaskModel();

        $task = $taskModel
            ->where('id', $id)
            ->where('user_id', session()->get('user_id'))
            ->first();

        if (!$task) {
            return redirect()
                ->to('/tasks')
                ->with('error', 'Task not found.');
        }

        return view('tasks/edit', [
            'task' => $task
        ]);
    }


    public function update($id)
    {
        $taskModel = new TaskModel();

        $task = $taskModel
            ->where('id', $id)
            ->where('user_id', session()->get('user_id'))
            ->first();

        if (!$task) {
            return redirect()
                ->to('/tasks')
                ->with('error', 'Task not found.');
        }

        $taskModel->update($id, [
            'task_name' => $this->request->getPost('task_name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'notes' => $this->request->getPost('notes')
        ]);

        return redirect()->to('/tasks');
    }


    public function delete($id)
    {
        $taskModel = new TaskModel();

        $task = $taskModel
            ->where('id', $id)
            ->where('user_id', session()->get('user_id'))
            ->first();

        if (!$task) {
            return redirect()
                ->to('/tasks')
                ->with('error', 'Task not found.');
        }

        $taskModel->delete($id);

        return redirect()->to('/tasks');
    }
}