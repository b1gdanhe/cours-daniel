<?php page('partials/head.php') ?>
<main class="d-flex">
    <?php page('partials/sidebar.php') ?>
    <section class="bg-light w-100">
        <?php page('partials/navbar.php', ['header' => 'Banner']) ?>
        <div class="p-3">
            Bonjour
        </div>
    </section>
</main>
<?php page('partials/footer.php') ?>