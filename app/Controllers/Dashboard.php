<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $userId = session()->get('user_id');

        // Total tasks for the logged-in user
        $data['totalTasks'] = $taskModel
            ->where('user_id', $userId)
            ->countAllResults();

        // Completed tasks for the logged-in user
        $data['completedTasks'] = $taskModel
            ->where('user_id', $userId)
            ->where('status', 'Completed')
            ->countAllResults();

        // Pending tasks for the logged-in user
        $data['pendingTasks'] = $taskModel
            ->where('user_id', $userId)
            ->where('status', 'Pending')
            ->countAllResults();

        // In Progress tasks for the logged-in user
        $data['inProgressTasks'] = $taskModel
            ->where('user_id', $userId)
            ->where('status', 'In Progress')
            ->countAllResults();

        // Get the 10 most recent tasks for the logged-in user
        $data['recentTasks'] = $taskModel
            ->where('user_id', $userId)
            ->orderBy('start_time', 'DESC')
            ->findAll(10);

        return view('dashboard/index', $data);
    }
}