<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Task - Task Tracker</title>

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

<div class="container py-5">

    <div class="form-page">

        <div class="surface">

            <div class="form-card-body">

                <h1 class="form-title">
                    Add new task
                </h1>

                <p class="form-description">
                    Create a new task and record your work.
                </p>


                <!-- Validation Errors -->

                <?php if (session()->getFlashdata('errors')): ?>

                    <div class="form-alert-error">

                        <p>
                            Please fix the following:
                        </p>

                        <ul>

                            <?php foreach (
                                session()->getFlashdata('errors')
                                as $error
                            ): ?>

                                <li>
                                    <?= esc($error) ?>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>


                <!-- Form -->

                <form
                    action="/tasks/store"
                    method="post"
                >

                    <div class="form-field">

                        <label
                            for="task_name"
                            class="form-label-sage"
                        >
                            Task name
                        </label>

                        <input
                            type="text"
                            name="task_name"
                            id="task_name"
                            class="form-control-sage"
                            value="<?= old('task_name') ?>"
                            required
                        >

                    </div>


                    <div class="form-field">

                        <label
                            for="description"
                            class="form-label-sage"
                        >
                            Objectives
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            class="form-control-sage"
                        ><?= old('description') ?></textarea>

                    </div>


                    <div class="form-field">

                        <label
                            for="status"
                            class="form-label-sage"
                        >
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="form-select-sage"
                            required
                        >

                            <option value="">
                                Select status
                            </option>

                            <option value="Pending">
                                Pending
                            </option>

                            <option value="In Progress">
                                In Progress
                            </option>

                            <option value="Completed">
                                Completed
                            </option>

                        </select>

                    </div>


                    <div class="form-row form-field">

                        <div>

                            <label
                                for="start_time"
                                class="form-label-sage"
                            >
                                Start time
                            </label>

                            <input
                                type="datetime-local"
                                name="start_time"
                                id="start_time"
                                class="form-control-sage"
                                value="<?= old('start_time') ?>"
                            >

                        </div>


                        <div>

                            <label
                                for="end_time"
                                class="form-label-sage"
                            >
                                End time
                            </label>

                            <input
                                type="datetime-local"
                                name="end_time"
                                id="end_time"
                                class="form-control-sage"
                                value="<?= old('end_time') ?>"
                            >

                        </div>

                    </div>


                    <div class="form-field">

                        <label
                            for="notes"
                            class="form-label-sage"
                        >
                            Tasks accomplished
                        </label>

                        <textarea
                            name="notes"
                            id="notes"
                            class="form-control-sage"
                        ><?= old('notes') ?></textarea>

                    </div>


                    <div class="form-actions">

                        <a
                            href="/tasks"
                            class="btn-secondary-sage"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn-primary-sage"
                        >
                            Save task
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>

</html>