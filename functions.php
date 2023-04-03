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

class Bundler
{
    private static $_instance;
    private static $css = '';
    private static $js = '';
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    public static function add_text($text = '', $category = 'css')
    {
        if ($category === 'css')
            self::$css .= PHP_EOL . $text;
        if ($category === 'js')
            self::$js .= PHP_EOL . $text;
        return self::getInstance();
    }
    public static function add($path, $category = 'css')
    {
        if (file_exists($path)) {
            ob_start();
            require $path;
            if ($category === 'css')
                self::$css .= PHP_EOL . ob_get_clean();
            if ($category === 'js')
                self::$js .= PHP_EOL . ob_get_clean();
        }
        return self::getInstance();
    }


    private static function minifyCSS()
    {
        $css = self::$css;
        $css = preg_replace('#(\s)\s+#', ' ', $css);
        $css = preg_replace('#([\(\)\{\}:;,])\s+#', '$1', $css);
        return $css;

    }
    public static function final ($category = 'css')
    {
        if ($category === 'css')
            return self::minifyCSS();
        if ($category === 'js')
            return self::$js;

    }
}

class DB
{
    private static $connection = null;
    private static $config = null;
    private static $_instance;
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public static function config($config)
    {
        self::$config = $config;
        return self::getInstance();
    }
    public static function connect()
    {
        try {
            self::$connection = new mysqli
            (
                self::$config['hostname'],
                self::$config['username'],
                self::$config['password'],
                self::$config['database']
            );
            self::$connection->query("SET NAMES 'utf8'");
        } catch (Throwable $th) {
            echo $th;
        }
        return self::getInstance();
    }
    public static function request($query)
    {
        try {
            $result = self::$connection->query($query);
            if ($result instanceof mysqli_result) {
                $data = [];
                $data = $result->fetch_all(MYSQLI_ASSOC);
                return $data;
            }
            return $result;

        } catch (Throwable $th) {
            echo $th;
        }
    }
    public static function insert($table, $columns, $values)
    {
        $temp = [];
        foreach ($columns as $c) {
            $temp[] = "`" . $c . "`";
        }
        $columns = join(',', $temp);
        $temp = [];
        foreach ($values as $value) {
            $tempInner = [];
            foreach ($value as $v) {
                $tempInner[] = "'" . $v . "'";
            }
            $temp[] = '(' . join(',', $tempInner) . ')';
        }
        $values = join(',', $temp);
        $query = "INSERT INTO `$table` ($columns) VALUES $values";
        return self::request($query);
    }
    public static function id()
    {
        return self::$connection->insert_id;
    }
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

function checkValidation($errors)
{
    foreach ($errors as $error) {
        if ($error)
            return false;
    }
    return true;
}

function write_log($content)
{
    file_put_contents('log.txt', $content, FILE_APPEND);
}

?>