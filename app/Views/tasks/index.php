<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tasks - Task Tracker</title>

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
                All tasks
            </h1>

            <p>
                Manage and review all your recorded tasks.
            </p>

        </div>

        <a
            href="/tasks/create"
            class="btn-primary-sage"
        >
            + Add task
        </a>

    </div>

<form
    action="/tasks"
    method="get"
    class="row g-2 mb-4"
>

    <!-- Search -->
    <div class="col-md-5">
        <input
            type="text"
            name="search"
            class="form-control-sage"
            placeholder="Search task..."
            value="<?= esc($search ?? '') ?>"
        >
    </div>

    <!-- Status -->
    <div class="col-md-4">
        <select
            name="status"
            class="form-select-sage"
        >
            <option value="">
                All statuses
            </option>
            <option
                value="Pending"
                <?= ($status ?? '') === 'Pending' ? 'selected' : '' ?>
            >
                Pending
            </option>
            <option
                value="In Progress"
                <?= ($status ?? '') === 'In Progress' ? 'selected' : '' ?>
            >
                In Progress
            </option>
            <option
                value="Completed"
                <?= ($status ?? '') === 'Completed' ? 'selected' : '' ?>
            >
                Completed
            </option>
        </select>
    </div>

    <!-- Search button -->
    <div class="col-md-2">
        <button
            type="submit"
            class="btn-primary-sage btn-block-sage"
        >
            Search
        </button>
    </div>

    <!-- Clear -->
    <div class="col-md-1">
        <a
            href="/tasks"
            class="btn-secondary-sage btn-block-sage"
        >
            Clear
        </a>
    </div>

</form>
    <!-- Tasks Card -->

    <div class="surface" style="overflow: hidden;">

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
                            Start time
                        </th>

                        <th>
                            End time
                        </th>

                        <th>
                            Duration
                        </th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if (!empty($tasks)): ?>

                    <?php foreach ($tasks as $task): ?>

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
                                        <?= esc($task['description']) ?>
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- Status -->

                            <td>

                                <?php if ($task['status'] === 'Completed'): ?>

                                    <span class="status status--completed">
                                        Completed
                                    </span>

                                <?php elseif ($task['status'] === 'In Progress'): ?>

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
                                        'M d, Y',
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
                                            'M d, Y',
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


                            <!-- Actions -->

                            <td class="text-end">

                                <div class="actions-group">

                                    <a
                                        href="/tasks/edit/<?= $task['id'] ?>"
                                        class="btn-row-action"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="/tasks/delete/<?= $task['id'] ?>"
                                        method="post"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                                    >

                                        <button
                                            type="submit"
                                            class="btn-row-action btn-row-action--danger"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                <p>
                                    No tasks yet. Start by adding your first task.
                                </p>

                                <a
                                    href="/tasks/create"
                                    class="btn-primary-sage"
                                >
                                    + Add task
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>
            <div class="mt-4">
             <?= $pager->only(['search', 'status'])->links('default', 'bootstrap') ?>
                </div>
                
        </div>

    </div>

</div>

</body>

</html>