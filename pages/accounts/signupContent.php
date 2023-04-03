<?php
$emailInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'Почта',
        'error' => $validationErrors['email']
    ]
);
$fullnameInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'fullname',
        'type' => 'text',
        'placeholder' => 'Имя и фамилия',
        'error' => $validationErrors['fullname']
    ]
);
$nicknameInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'nickname',
        'type' => 'text',
        'placeholder' => 'Имя пользователя',
        'error' => $validationErrors['nickname']
    ]
);
$passwordInput = renderTemplate(
    './templates/UI/FormInputText.php',
    [
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'Пароль',
        'error' => $validationErrors['password']
    ]
);
$formError = renderTemplate(
    './templates/UI/FormError.php',
    [
        'error' => $error
    ]
);
$submitInput = renderTemplate(
    './templates/UI/FormInputSubmit.php',
    [
        'name' => 'submit',
        'value' => 'Регистрация'
    ]
);
echo renderTemplate(
    './templates/AccountsBody/AccountsBody.php',
    [

        'action' => '',
        'method' => 'post',
        'icon' => 'person_add',
        'title' => 'Регистрация',
        'content' => $emailInput . $fullnameInput . $nicknameInput . $passwordInput . $formError . $submitInput,
        'extraSection' => 'Есть аккаунт?<a class="underline-anim" href="' . $GLOBALS['URLS']['login'] . '">Вход</a>'
    ]
);
?>