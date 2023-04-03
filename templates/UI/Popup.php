<?php
$icon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'close']);
?>
<div class="popup" data-popup="<?= $id ?>">
    <div class="popup__wrapper">
        <div class="popup__header">
            <div class="popup__title">
                <?= $title ?>
            </div>
            <button class="popup__btn-close popup-close" data-popup="<?= $id ?>"><?= $icon ?></button>
        </div>
        <div class="popup__content">
            <?= $content ?>
        </div>
    </div>
</div>