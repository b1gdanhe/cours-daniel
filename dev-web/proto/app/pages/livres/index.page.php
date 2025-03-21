<?php page('partials/head.php') ?>
<main class="d-flex">
    <?php page('partials/sidebar.php') ?>
    <section class="bg-light w-100" style="height: 100dvh;">
        <?php page('partials/navbar.php', ['header' => 'Banner']) ?>
        <div class="p-3 bg-white m-3 shadow-sm" style="height: calc(100dvh-70px);">
            Bonjour
        </div>
    </section>
</main>
<?php page('partials/footer.php') ?>