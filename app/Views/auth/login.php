<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Task Tracker</title>

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

<div class="auth-split">

    <!-- Info panel -->

    <div class="auth-split-info">

        <div class="auth-split-info-inner">

            <span class="auth-split-brand">
                Task &amp; Time Tracker
            </span>

            <h2>
                Know exactly where your hours go.
            </h2>

            <p>
                Log what you're working on, track the time it takes, and turn
                it into a report in a couple of clicks.
            </p>

            <ul class="auth-split-features">

                <li>
                    Record tasks with objectives and status
                </li>

                <li>
                    Track start and end times automatically
                </li>

                <li>
                    Export accomplishment reports as PDF
                </li>

            </ul>

        </div>

    </div>


    <!-- Form panel -->

    <div class="auth-split-form">

        <div class="auth-split-form-inner">

            <a href="/" class="auth-split-mobile-brand">
                Task &amp; Time Tracker
            </a>

            <div class="text-center mb-4">

                <h1 class="form-title">
                    Welcome back
                </h1>

                <p class="form-description mb-0">
                    Login to your Task &amp; Time Tracker.
                </p>

            </div>


            <!-- Success Message -->

            <?php if (session()->getFlashdata('success')): ?>

                <div class="form-alert-error" style="background: var(--color-sage-bg); border-color: rgba(93, 118, 87, 0.25);">

                    <p style="color: var(--color-sage-700);">
                        <?= esc(session()->getFlashdata('success')) ?>
                    </p>

                </div>

            <?php endif; ?>


            <!-- Error Message -->

            <?php if (session()->getFlashdata('error')): ?>

                <div class="form-alert-error">

                    <p>
                        <?= esc(session()->getFlashdata('error')) ?>
                    </p>

                </div>

            <?php endif; ?>


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


            <!-- Login Form -->

            <form
                action="/login"
                method="post"
            >

                <?= csrf_field() ?>


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


                <!-- Submit -->

                <div class="form-field" style="margin-top: 1.75rem; margin-bottom: 0;">

                    <button
                        type="submit"
                        class="btn-primary-sage btn-block-sage"
                    >
                        Login
                    </button>

                </div>

            </form>


            <p class="auth-footer">
                Don't have an account?
                <a href="/register">Create account</a>
            </p>

        </div>

    </div>

</div>

</body>

</html>