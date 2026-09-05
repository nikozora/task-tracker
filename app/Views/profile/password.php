<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Change Password - Task Tracker</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h2 class="mb-4">
                        Change Password
                    </h2>

                    <?php if (session()->getFlashdata('error')): ?>

                        <div class="alert alert-danger">
                            <?= esc(session()->getFlashdata('error')) ?>
                        </div>

                    <?php endif; ?>


                    <?php if (session()->getFlashdata('errors')): ?>

                        <div class="alert alert-danger">

                            <ul class="mb-0">

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


                    <form
                        action="/profile/password/update"
                        method="post"
                    >

                        <?= csrf_field() ?>


                        <div class="mb-3">

                            <label
                                for="current_password"
                                class="form-label"
                            >
                                Current Password
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                id="current_password"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label
                                for="new_password"
                                class="form-label"
                            >
                                New Password
                            </label>

                            <input
                                type="password"
                                name="new_password"
                                id="new_password"
                                class="form-control"
                                minlength="8"
                                required
                            >

                            <div class="form-text">
                                Password must be at least 8 characters.
                            </div>

                        </div>


                        <div class="mb-4">

                            <label
                                for="password_confirm"
                                class="form-label"
                            >
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                name="password_confirm"
                                id="password_confirm"
                                class="form-control"
                                minlength="8"
                                required
                            >

                        </div>


                        <div class="d-flex gap-2">

                            <a
                                href="/profile"
                                class="btn btn-secondary"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Change Password
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>