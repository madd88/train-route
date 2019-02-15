<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('LOGIN', 'test');
define('PASSWD', 'bYKoDO2it');
define('TERMINAL', 'htk_test');
define('REPRESENT', '22400');

spl_autoload_register(function ($name) {
    try{
        require_once(ROOT . "/" .  str_replace("\\", "/", $name) . ".php");
    }
    catch (Exception $e){
        die($e->getMessage());
    }
});


