<?php
if (!isset($name))
    $name = '';
if (!isset($placeholder))
    $placeholder = '';
if (!isset($error))
    $error = '';
if (!isset($value))
    $value = '';
?>
<div class="FormTextarea">
    <textarea name="<?= $name ?>" placeholder="<?= $placeholder ?>" value="<?= $value ?>"><?= $value ?></textarea>
    <?php if ($error) { ?>
        <div class="FormTextarea__error">
            <?= renderTemplate('./templates/UI/Icon.php', ['icon' => $error ? 'close' : '']) ?>
            <div class="FormTextarea__info">
                <?= $error ?>
            </div>
        </div>
    <?php } ?>
</div>