<?php

namespace App\Controllers;

use App\Models\TaskModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Reports extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        // Get the currently logged-in user's ID
        $userId = session()->get('user_id');

        // Get date filters
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Only get tasks belonging to the logged-in user
        $taskModel->where('user_id', $userId);

        // Apply date filter if both dates are provided
        if ($startDate && $endDate) {

            $taskModel->where(
                'start_time >=',
                $startDate . ' 00:00:00'
            );

            $taskModel->where(
                'start_time <=',
                $endDate . ' 23:59:59'
            );
        }

        $data['tasks'] = $taskModel
            ->orderBy('id', 'DESC')
            ->findAll();

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return view('reports/index', $data);
    }


    public function pdf()
    {
        $taskModel = new TaskModel();

        // Get the currently logged-in user's ID
        $userId = session()->get('user_id');

        // Get date filters
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Only get tasks belonging to the logged-in user
        $taskModel->where('user_id', $userId);

        // Apply date filter if both dates are provided
        if ($startDate && $endDate) {

            $taskModel->where(
                'start_time >=',
                $startDate . ' 00:00:00'
            );

            $taskModel->where(
                'start_time <=',
                $endDate . ' 23:59:59'
            );
        }

        $tasks = $taskModel
            ->orderBy('id', 'DESC')
            ->findAll();

        // Calculate total hours
        $totalHours = 0;

        foreach ($tasks as $task) {

            if ($task['start_time'] && $task['end_time']) {

                $start = new \DateTime($task['start_time']);
                $end = new \DateTime($task['end_time']);

                $seconds =
                    $end->getTimestamp() -
                    $start->getTimestamp();

                $totalHours += $seconds / 3600;
            }
        }

        // Generate PDF HTML
        $html = view('reports/pdf', [
            'tasks' => $tasks,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalHours' => $totalHours
        ]);

        // Configure Dompdf
        $options = new Options();

        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        // A4 landscape
        $dompdf->setPaper('A4', 'landscape');

        // Generate PDF
        $dompdf->render();

        // Download PDF
        $dompdf->stream(
            'work-accomplishment-report.pdf',
            ['Attachment' => true]
        );
    }
}