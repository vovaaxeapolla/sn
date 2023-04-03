<?php
$formError = renderTemplate(
    './templates/UI/FormError.php',
    [
        'error' => $error
    ]
);
$password = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'Пароль',
        'error' => $validationErrors['password']
    ]
);
$submitInput = renderTemplate(
    './templates/UI/FormInputSubmit.php',
    [
        'name' => 'submit',
        'value' => 'Удалить аккаунт'
    ]
);
?>
<div class="edit__form-wrapper">
    <h1 class="edit__form__title">
        Удалить аккаунт
    </h1>
    <form action="" method="post" class="edit__form">
        <?= $password ?>
        <?= $submitInput ?>
    </form>
</div>