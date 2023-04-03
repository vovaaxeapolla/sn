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
            <?php
echo Bundler::
    add('assets/css/body.css')::
    add('assets/css/UI.css')::
    add('assets/css/reset.css')::
    add('assets/css/general.css')::
    add('assets/css/popups.css')::final ();
?>
    </style>
    <title>
        <?= $title ?>
    </title>
</head>

<body>
    <div class="__class"></div>
    <?= $content ?>
    <script>
        <?= Bundler::add('assets/js/navmenu.js', 'js')::add('assets/js/UI.js', 'js')::final ('js') ?>
    </script>
</body>

</html>