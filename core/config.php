<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('LOGIN', 'test');
define('PASSWD', '');
define('TERMINAL', '');
define('REPRESENT', '');

spl_autoload_register(function ($name) {
    try{
        require_once(ROOT . "/" .  str_replace("\\", "/", $name) . ".php");
    }
    catch (Exception $e){
        die($e->getMessage());
    }
});


