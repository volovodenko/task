<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(dirname(__FILE__)));
define("VIEWS", ROOT . DS . 'app' . DS . "views");


session_save_path(ROOT . DS . "session" . DS);
session_start();

require_once(ROOT . DS . "app" . DS . "lib" . DS . "init.php");
App::run();



//define('CONFIG', ROOT . DS . 'app' . DS . 'config');
//define('LIB', ROOT . DS . 'Application' . DS . 'lib');
//define('CORE', ROOT . DS . 'Application' . DS . 'Core');
//define('CONTROLLERS', ROOT . DS . 'Application' . DS . 'Controllers');