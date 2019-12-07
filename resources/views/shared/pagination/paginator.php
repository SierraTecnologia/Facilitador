<?php
$controller = app('facilitador.wildcard')->detectController();
if ($paginator->total() > $controller::$per_page): ?>
    <div class="pagination-wrapper">

        <?php // The list of pages ?>
        <?php if ($paginator->lastPage() > 1): ?>
            <span class="pagination-desktop">
                <?= $paginator->render('facilitador::shared.pagination.desktop') ?>
            </span>

            <?php // On mobile, just show first, prev, current, next, last pagination buttons ?>
            <span class="pagination-mobile">
                <?= $paginator->render('facilitador::shared.pagination.mobile') ?>
            </span>
        <?php endif ?>

        <?php // Per page selector ?>
        <span class="per-page">
            <?= $paginator->render('facilitador::shared.pagination.per_page') ?>
        </span>
    </div>
<?php endif ?>
