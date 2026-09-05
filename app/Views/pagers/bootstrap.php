<?php if ($pager->hasPreviousPage() || $pager->hasNextPage()): ?>

<nav aria-label="Page navigation">

    <ul class="pagination-sage">

        <!-- Previous -->
        <?php if ($pager->hasPreviousPage()): ?>

            <li class="page-item-sage page-item-sage--nav">

                <a
                    class="page-link-sage page-link-sage--nav"
                    href="<?= $pager->getPreviousPage() ?>"
                >
                    Previous
                </a>

            </li>

        <?php else: ?>

            <li class="page-item-sage page-item-sage--nav disabled">

                <span class="page-link-sage page-link-sage--nav">
                    Previous
                </span>

            </li>

        <?php endif; ?>


        <!-- Page Numbers -->
        <?php foreach ($pager->links() as $link): ?>

            <li
                class="page-item-sage <?= $link['active'] ? 'active' : '' ?>"
            >

                <a
                    class="page-link-sage"
                    href="<?= $link['uri'] ?>"
                >
                    <?= $link['title'] ?>
                </a>

            </li>

        <?php endforeach; ?>


        <!-- Next -->
        <?php if ($pager->hasNextPage()): ?>

            <li class="page-item-sage page-item-sage--nav">

                <a
                    class="page-link-sage page-link-sage--nav"
                    href="<?= $pager->getNextPage() ?>"
                >
                    Next
                </a>

            </li>

        <?php else: ?>

            <li class="page-item-sage page-item-sage--nav disabled">

                <span class="page-link-sage page-link-sage--nav">
                    Next
                </span>

            </li>

        <?php endif; ?>

    </ul>

</nav>

<?php endif; ?>