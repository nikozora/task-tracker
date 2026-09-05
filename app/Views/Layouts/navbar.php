<?php $currentPath = trim(uri_string(), '/'); ?>

<style>
    .site-nav {
        position: sticky;
        top: 0;
        z-index: 20;
        background: rgba(255, 255, 255, 0.78);
        backdrop-filter: saturate(180%) blur(16px);
        -webkit-backdrop-filter: saturate(180%) blur(16px);
        border-bottom: 1px solid var(--color-border, #E7E8E4);
    }

    .site-nav .site-nav-inner {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100px;
        gap: 1.5rem;
    }

    .site-nav .brand {
        font-family: var(--font-sans, -apple-system, BlinkMacSystemFont, sans-serif);
        font-weight: 650;
        font-size: 1.02rem;
        letter-spacing: -0.01em;
        color: var(--color-ink, #1D1D1F);
        text-decoration: none;
        white-space: nowrap;
    }

    .site-nav .links {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        flex: 1;
        margin-left: 0.5rem;
    }

    .site-nav .links a {
        font-family: var(--font-sans, -apple-system, BlinkMacSystemFont, sans-serif);
        font-size: 0.88rem;
        font-weight: 500;
        color: var(--color-ink-soft, #6E6E73);
        text-decoration: none;
        padding: 0.4rem 0.75rem;
        border-radius: var(--radius-pill, 999px);
        transition: color 0.15s ease, background-color 0.15s ease;
    }

    .site-nav .links a:hover {
        color: var(--color-ink, #1D1D1F);
        background: var(--color-bg-subtle, #F6F7F5);
    }

    .site-nav .links a.active {
        color: var(--color-ink, #1D1D1F);
        background: var(--color-sage-50, #F1F4EF);
        font-weight: 600;
    }

    .site-nav .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .site-nav .add-task {
        display: inline-flex;
        align-items: center;
        background: var(--color-ink, #1D1D1F);
        color: #fff;
        font-family: var(--font-sans, sans-serif);
        font-size: 0.85rem;
        font-weight: 550;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: var(--radius-pill, 999px);
        border: 1px solid var(--color-ink, #1D1D1F);
        transition: opacity 0.15s ease;
        white-space: nowrap;
    }

    .site-nav .add-task:hover {
        opacity: 0.85;
        color: #fff;
    }

    .site-nav .nav-menu {
        display: flex;
        align-items: center;
        gap: 0.9rem;
    }

    .site-nav .nav-menu a {
        font-family: var(--font-sans, sans-serif);
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--color-ink-soft, #6E6E73);
        text-decoration: none;
        transition: color 0.15s ease;
        white-space: nowrap;
    }

    .site-nav .nav-menu a:hover,
    .site-nav .nav-menu a.active {
        color: var(--color-ink, #1D1D1F);
    }

    @media (max-width: 720px) {
        .site-nav .site-nav-inner {
            height: auto;
            flex-wrap: wrap;
            padding: 1rem 1.5rem;
            gap: 0.85rem;
        }

        .site-nav .links {
            order: 3;
            width: 100%;
            margin-left: 0;
            gap: 0.4rem;
        }

        .site-nav .nav-actions {
            order: 2;
            margin-left: auto;
        }
    }
</style>

<nav class="site-nav">
    <div class="site-nav-inner">

        <a class="brand" href="/dashboard">Task &amp; Time Tracker</a>

        <div class="links">
            <a href="/dashboard" class="<?= $currentPath === 'dashboard' ? 'active' : '' ?>">
                Dashboard
            </a>

            <a href="/tasks" class="<?= $currentPath === 'tasks' ? 'active' : '' ?>">
                Tasks
            </a>

            <a href="/reports" class="<?= $currentPath === 'reports' ? 'active' : '' ?>">
                Reports
            </a>
        </div>

        <div class="nav-actions">

            <a href="/tasks/create" class="add-task">
                + Add task
            </a>

            <div class="nav-menu">

                <a href="/profile" class="<?= $currentPath === 'profile' ? 'active' : '' ?>">
                    Profile
                </a>

                <a href="/logout" class="<?= $currentPath === 'logout' ? 'active' : '' ?>">
                    Logout
                </a>

            </div>

        </div>

    </div>
</nav>