<?php
$formError = renderTemplate(
    './templates/UI/FormError.php',
    [
        'error' => $error
    ]
);
$oldPassword = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'oldPassword',
        'type' => 'password',
        'placeholder' => 'Старый пароль',
        'error' => $validationErrors['oldPassword']
    ]
);
$newPassword = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'newPassword',
        'type' => 'password',
        'placeholder' => 'Новый пароль',
        'error' => $validationErrors['newPassword']
    ]
);
$confirmPassword = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'confirmPassword',
        'type' => 'password',
        'placeholder' => 'Потвердите новый пароль',
        'error' => $validationErrors['confirmPassword']
    ]
);
$submitInput = renderTemplate(
    './templates/UI/FormInputSubmit.php',
    [
        'name' => 'submit',
        'value' => 'Сменить пароль'
    ]
);
?>
<div class="edit__form-wrapper">
    <form action="" method="post" class="edit__form">
        <div class="edit__form__title">
            Сменить пароль
        </div>
        <div class="edit__row">
            <div class="edit__avatar">
                <img src="/api/images/avatars/<?= $_SESSION['user']['avatar'] ?>" alt="avatar">
            </div>
            <div class="edit__nickname"><?= $_SESSION['user']['nickname'] ?></div>
        </div>
        <?= $oldPassword ?>
        <?= $newPassword ?>
        <?= $confirmPassword ?>
        <?= $formError ?>
        <?= $submitInput ?>
    </form>
</div>