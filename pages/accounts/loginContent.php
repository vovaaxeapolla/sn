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
        'value' => 'Войти'
    ]
);
echo renderTemplate(
    './templates/AccountsBody/AccountsBody.php',
    [
        'action' => '',
        'method' => 'post',
        'icon' => 'login',
        'title' => 'Логин',
        'content' => $emailInput . $passwordInput . $formError . $submitInput . '<a class="underline-anim" href="' . $GLOBALS['URLS']['reset'] . '">Забыли пароль?</a>',
        'error' => $error,
        'extraSection' => "У вас ещё нет аккаунта? <a class='underline-anim' href='" . $GLOBALS['URLS']['signup'] . "'>Зарегистрироваться</a>"
    ]
);
?>