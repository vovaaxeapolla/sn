<?php
if (!isset($type))
    $type = 'text';
if (!isset($name))
    $name = '';
if (!isset($placeholder))
    $placeholder = '';
if (!isset($error))
    $error = '';
?>
<div class="FormInputText">
    <input type="<?= $type ?>" name="<?= $name ?>" placeholder="<?= $placeholder ?>">
    <div class="FormInputText__placeholder">
        <?= $placeholder ?>
    </div>
    <?php if ($error) { ?>
        <div class="FormInputText__error">
            <?= renderTemplate('./templates/UI/Icon.php', ['icon' => $error ? 'close' : '']) ?>
            <div class="FormInputText__info">
                <?= $error ?>
            </div>
        </div>
    <?php } ?>
</div>