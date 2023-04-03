<?php
$photoIcon = renderTemplate('./templates/UI/Icon.php', ['icon' => 'fullscreen']);
if (!isset($src))
    $src = '';
if (!isset($alt))
    $src = '';
?>
<div class="Img">
    <img src="<?= $src ?>" alt="<?= $alt ?>">
    <div class="Img__overlay">
        <?= $photoIcon ?>
    </div>
    <div class="Img__fullscreen">
        <img src="<?= $src ?>" alt="<?= $alt ?>">
    </div>
</div>