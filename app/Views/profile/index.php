<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile - Task Tracker</title>

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
                    My profile
                </h1>

                <p class="form-description">
                    Your account details.
                </p>


                <div class="info-field">

                    <div class="info-label">
                        Name
                    </div>

                    <div class="info-value">
                        <?= esc($user['name']) ?>
                    </div>

                </div>


                <div class="info-field">

                    <div class="info-label">
                        Email
                    </div>

                    <div class="info-value">
                        <?= esc($user['email']) ?>
                    </div>

                </div>


                <div class="info-field">

                    <div class="info-label">
                        Account ID
                    </div>

                    <div class="info-value">
                        <?= esc($user['id']) ?>
                    </div>

                </div>


                <div class="form-actions" style="justify-content: flex-start; flex-wrap: wrap;">

                    <a
                        href="/profile/edit"
                        class="btn-primary-sage"
                    >
                        Edit profile
                    </a>

                    <a
                        href="/profile/password"
                        class="btn-caution-sage"
                    >
                        Change password
                    </a>

                    <a
                        href="/dashboard"
                        class="btn-secondary-sage"
                    >
                        Back to dashboard
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>