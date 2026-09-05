<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Task Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<?= $this->include('layouts/navbar') ?>

    <div class="container py-5" style="max-width: 1100px;">

        <div class="page-header mb-4">
            <div>
                <h1>Reports</h1>
                <p>Summarize accomplished work over a date range.</p>
            </div>
        </div>

        <div class="surface" style="overflow: hidden;">

            <div class="filter-bar">

                <h5 class="filter-title">Generate report</h5>

                <form action="/reports" method="get" class="row g-3">

                    <div class="col-md-4">
                        <label for="start_date" class="form-label-sage">Start date</label>
                        <input
                            type="date"
                            name="start_date"
                            id="start_date"
                            class="form-control-sage"
                            value="<?= esc($startDate ?? '') ?>"
                            required
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="end_date" class="form-label-sage">End date</label>
                        <input
                            type="date"
                            name="end_date"
                            id="end_date"
                            class="form-control-sage"
                            value="<?= esc($endDate ?? '') ?>"
                            required
                        >
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn-primary-sage w-100 justify-content-center">
                            Generate
                        </button>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn-secondary-sage w-100 justify-content-center" onclick="generatePDF()">
                            Export PDF
                        </button>
                    </div>

                </form>

            </div>

            <?php
                // Calculate hours once per task and reuse for both
                // the per-row display and the running total.
                $totalHours = 0;

                $rows = array_map(function ($task) use (&$totalHours) {
                    $hours = 0;

                    if ($task['start_time'] && $task['end_time']) {
                        $start = new DateTime($task['start_time']);
                        $end   = new DateTime($task['end_time']);
                        $hours = ($end->getTimestamp() - $start->getTimestamp()) / 3600;
                    }

                    $totalHours += $hours;
                    $task['hours_worked'] = $hours;

                    return $task;
                }, $tasks);
            ?>

            <div class="table-responsive">
                <table class="task-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Task</th>
                            <th>Objectives</th>
                            <th>Accomplished</th>
                            <th>Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rows)): ?>
                            <?php foreach ($rows as $task): ?>
                                <tr>
                                    <td class="cell-primary"><?= date('M d, Y', strtotime($task['start_time'])) ?></td>
                                    <td class="task-name"><?= esc($task['task_name']) ?></td>
                                    <td class="cell-secondary"><?= esc($task['description']) ?></td>
                                    <td class="cell-secondary"><?= esc($task['notes']) ?></td>
                                    <td>
                                        <span class="duration-value"><?= number_format($task['hours_worked'], 2) ?></span>
                                        <span class="duration-unit">hrs</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <p>No tasks in this date range.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($rows)): ?>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th><?= number_format($totalHours, 2) ?> hrs</th>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>

        </div>

    </div>

    <script>
        function generatePDF()
        {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (!startDate || !endDate) {
                alert('Please select a start date and end date.');
                return;
            }

            const params = new URLSearchParams({
                start_date: startDate,
                end_date: endDate,
            });

            window.location.href = '/reports/pdf?' + params.toString();
        }
    </script>

</body>
</html>