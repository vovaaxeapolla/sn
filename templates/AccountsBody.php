<body>
    <div class="accounts">
        <form action="<?= $action ?>" method="<?= $method ?>" class="accounts__wrapper">
            <div class="accounts__header">
                <?= renderTemplate('./templates/UI/Icon.php', ['icon' => $icon])?>
                <p class="accounts__title">
                    <?= $title ?>
                </p>
            </div>
            <?= $content ?>
        </form>
        <?php if ($extraSection) { ?>
            <div class="accounts__wrapper">
                <?= $extraSection ?>
            </div>
        <?php } ?>
    </div>
</body>