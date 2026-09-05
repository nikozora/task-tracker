<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'task_name',
        'description',
        'status',
        'start_time',
        'end_time',
        'notes'
    ];
}