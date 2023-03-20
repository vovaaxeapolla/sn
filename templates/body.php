<html lang="en" theme="<?php
if (isset($_SESSION['theme']))
    echo $_SESSION['theme'];
else
    echo 'light'
        ?>">

    <head lang="ru">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
        <?= bundler(
    [
        'assets/css/body.css',
        'assets/css/navbar.css',
        'assets/css/AccountsBody.css',
        'assets/css/reset.css',
        'assets/css/UI.css',
        'assets/css/main.css',
        'assets/css/profile.css',
        'assets/css/popups.css',
    ]
); ?>
    </style>
    <title>
        <?= $title ?>
    </title>
</head>

<body>
    <?= $content ?>
    <script defer>
        <?= bundler(['assets/js/navmenu.js']); ?>
    </script>
</body>

</html>