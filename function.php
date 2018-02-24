<?php 
    require_once './vendor/autoload.php';

    use M1\Env\Parser;

    function env($key, $default = false) {
        $env = new Parser(file_get_contents('.env'));
        $config = $env->getContent();
        return ! empty($config[$key]) ? $config[$key] : $default;
    }