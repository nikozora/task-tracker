<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard - Task & Time Tracker</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="/css/app.css"
    >

</head>

<body>

<?= $this->include('layouts/navbar') ?>


<div class="container py-5" style="max-width: 1100px;">

    <!-- Page Header -->

    <div class="page-header mb-4">

        <div>

            <h1>
                Dashboard
            </h1>

            <p>
                Overview of your tasks and working hours.
            </p>

        </div>

        <span class="page-date">
            <?= date('l, F j') ?>
        </span>

    </div>


    <!-- Statistics -->

    <div class="row g-3 mb-4">

        <!-- Total Tasks -->

        <div class="col-6 col-lg-3">

            <div class="surface stat-card">

                <p class="stat-label">
                    Total tasks
                </p>

                <h2 class="stat-value">
                    <?= esc($totalTasks) ?>
                </h2>

            </div>

        </div>


        <!-- Completed -->

        <div class="col-6 col-lg-3">

            <div class="surface stat-card">

                <p class="stat-label">
                    Completed
                </p>

                <h2 class="stat-value is-sage">
                    <?= esc($completedTasks) ?>
                </h2>

            </div>

        </div>


        <!-- In Progress -->

        <div class="col-6 col-lg-3">

            <div class="surface stat-card">

                <p class="stat-label">
                    In progress
                </p>

                <h2 class="stat-value is-amber">
                    <?= esc($inProgressTasks) ?>
                </h2>

            </div>

        </div>


        <!-- Pending -->

        <div class="col-6 col-lg-3">

            <div class="surface stat-card">

                <p class="stat-label">
                    Pending
                </p>

                <h2 class="stat-value is-slate">
                    <?= esc($pendingTasks) ?>
                </h2>

            </div>

        </div>

    </div>


    <!-- Recent Tasks -->

    <div class="surface mb-4" style="overflow: hidden;">

        <div class="section-card-header">

            <div>

                <h5>
                    Recent tasks
                </h5>

                <p>
                    Your latest recorded tasks.
                </p>

            </div>

            <a
                href="/tasks"
                class="btn-quiet"
            >
                View all
            </a>

        </div>


        <div class="table-responsive">

            <table class="task-table">

                <thead>

                    <tr>

                        <th>
                            Task
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Start
                        </th>

                        <th>
                            End
                        </th>

                        <th>
                            Duration
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if (!empty($recentTasks)): ?>

                    <?php foreach ($recentTasks as $task): ?>

                        <?php

                            $hoursWorked = 0;

                            if (
                                $task['start_time'] &&
                                $task['end_time']
                            ) {

                                $start =
                                    new DateTime($task['start_time']);

                                $end =
                                    new DateTime($task['end_time']);

                                $seconds =
                                    $end->getTimestamp()
                                    - $start->getTimestamp();

                                $hoursWorked =
                                    $seconds / 3600;
                            }

                        ?>


                        <tr>

                            <!-- Task -->

                            <td>

                                <div class="task-name">
                                    <?= esc($task['task_name']) ?>
                                </div>

                                <?php if (!empty($task['description'])): ?>

                                    <span class="task-desc">

                                        <?= esc(
                                            $task['description']
                                        ) ?>

                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- Status -->

                            <td>

                                <?php if (
                                    $task['status'] === 'Completed'
                                ): ?>

                                    <span class="status status--completed">
                                        Completed
                                    </span>

                                <?php elseif (
                                    $task['status'] === 'In Progress'
                                ): ?>

                                    <span class="status status--progress">
                                        In Progress
                                    </span>

                                <?php else: ?>

                                    <span class="status status--pending">
                                        <?= esc($task['status']) ?>
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- Start -->

                            <td>

                                <span class="cell-primary">

                                    <?= date(
                                        'M d',
                                        strtotime($task['start_time'])
                                    ) ?>

                                </span>

                                <br>

                                <span class="cell-secondary">

                                    <?= date(
                                        'h:i A',
                                        strtotime($task['start_time'])
                                    ) ?>

                                </span>

                            </td>


                            <!-- End -->

                            <td>

                                <?php if ($task['end_time']): ?>

                                    <span class="cell-primary">

                                        <?= date(
                                            'M d',
                                            strtotime($task['end_time'])
                                        ) ?>

                                    </span>

                                    <br>

                                    <span class="cell-secondary">

                                        <?= date(
                                            'h:i A',
                                            strtotime($task['end_time'])
                                        ) ?>

                                    </span>

                                <?php else: ?>

                                    <span class="cell-muted">
                                        —
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- Duration -->

                            <td>

                                <?php if ($hoursWorked > 0): ?>

                                    <span class="duration-value">

                                        <?= number_format(
                                            $hoursWorked,
                                            2
                                        ) ?>

                                    </span>

                                    <span class="duration-unit">
                                        hrs
                                    </span>

                                <?php else: ?>

                                    <span class="cell-muted">
                                        —
                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5">

                            <div class="empty-state">

                                <p>
                                    No tasks recorded yet.
                                </p>

                                <a
                                    href="/tasks/create"
                                    class="btn-primary-sage"
                                >
                                    + Add your first task
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- Quick Actions -->

    <div class="surface">

        <div class="quick-actions-body">

            <h5 class="quick-actions-title">
                Quick actions
            </h5>

            <div class="d-flex flex-wrap gap-2">

                <a
                    href="/tasks/create"
                    class="btn-primary-sage"
                >
                    + Add task
                </a>

                <a
                    href="/tasks"
                    class="btn-secondary-sage"
                >
                    Manage tasks
                </a>

                <a
                    href="/reports"
                    class="btn-secondary-sage"
                >
                    View reports
                </a>

            </div>

        </div>

    </div>

</div>


</body>

</html>