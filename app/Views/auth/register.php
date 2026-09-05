<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Create Account - Task Tracker</title>

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

<div class="auth-page">

    <div class="auth-card-wrap">

        <a href="/" class="auth-brand">
            Task &amp; Time Tracker
        </a>

        <div class="surface">

            <div class="form-card-body">

                <h1 class="form-title text-center">
                    Create account
                </h1>

                <p class="form-description text-center">
                    Create your Task &amp; Time Tracker account.
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


                <form
                    action="/register"
                    method="post"
                >

                    <?= csrf_field() ?>


                    <!-- Name -->

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
                            value="<?= old('name') ?>"
                            required
                        >

                    </div>


                    <!-- Email -->

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
                            value="<?= old('email') ?>"
                            required
                        >

                    </div>


                    <!-- Password -->

                    <div class="form-field">

                        <label
                            for="password"
                            class="form-label-sage"
                        >
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control-sage"
                            required
                        >

                    </div>


                    <!-- Confirm Password -->

                    <div class="form-field">

                        <label
                            for="password_confirm"
                            class="form-label-sage"
                        >
                            Confirm password
                        </label>

                        <input
                            type="password"
                            name="password_confirm"
                            id="password_confirm"
                            class="form-control-sage"
                            required
                        >

                    </div>


                    <!-- Submit -->

                    <div class="form-field" style="margin-top: 1.75rem; margin-bottom: 0;">

                        <button
                            type="submit"
                            class="btn-primary-sage btn-block-sage"
                        >
                            Create account
                        </button>

                    </div>

                </form>

            </div>

        </div>


        <p class="auth-footer">
            Already have an account?
            <a href="/login">Log in</a>
        </p>

    </div>

</div>

</body>

</html>