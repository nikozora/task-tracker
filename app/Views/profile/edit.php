<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Profile - Task Tracker</title>

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
                    Edit profile
                </h1>

                <p class="form-description">
                    Update your account name and email.
                </p>


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


                <form
                    action="/profile/update"
                    method="post"
                >

                    <?= csrf_field() ?>

                    <div class="form-field">

                        <label
                            for="name"
                            class="form-label-sage"
                        >
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control-sage"
                            value="<?= esc(
                                old('name', $user['name'])
                            ) ?>"
                            required
                        >

                    </div>


                    <div class="form-field">

                        <label
                            for="email"
                            class="form-label-sage"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control-sage"
                            value="<?= esc(
                                old('email', $user['email'])
                            ) ?>"
                            required
                        >

                    </div>


                    <div class="form-actions">

                        <a
                            href="/profile"
                            class="btn-secondary-sage"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn-primary-sage"
                        >
                            Save changes
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>

</html>