<?php

spl_autoload_register("mvc_autoloader");
require_once(ROOT . DS . "app" . DS . "config" . DS . "config.php");
require_once(ROOT . DS . "app" . DS . "lib" . DS . "helpers.php");

function mvc_autoloader($className)
{

    $arrayPath[] = ROOT . DS . "app" . DS . "lib" . DS . strtolower($className) . ".class.php";
    $arrayPath[] = ROOT . DS . "app" . DS . "controllers" . DS . $className . ".php";
    $arrayPath[] = ROOT . DS . "app" . DS . "models" . DS . $className . ".php";


    array_walk($arrayPath, function ($classPath) {
        if (file_exists($classPath)) {
            require_once($classPath);
            return;
        }
    });

}



