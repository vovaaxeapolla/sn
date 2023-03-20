<?php
function renderTemplate()
{
    if (func_num_args() > 1)
        extract(func_get_arg(1));
    ob_start();
    if (file_exists(func_get_arg(0)))
        require func_get_arg(0);
    else
        echo 'Template not found!';
    return ob_get_clean();
}

function print_array($array)
{
    echo '<pre>' . print_r($array, true) . '</pre>';
}

function bundler($array)
{
    $css = '';
    foreach ($array as $a) {
        if (file_exists($a)) {
            $css .= require $a;
            echo PHP_EOL;
        }
    }
    return $css;
}

function validateLength($input, $min, $max)
{
    $len = strlen($input);
    if ($len >= $min && $len <= $max)
        return true;
    return false;
}

function validate($name)
{
    if (empty($name) || trim($name) === '') {
        return '';
    }
    return $name;
}

function chechValivation($errors)
{
    foreach ($errors as $error) {
        if ($error)
            return false;
    }
    return true;
}

?>