<?php

/**
 * A simple PHP MVC skeleton
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the (optional) Composer auto-loader

/*
function __autoload($classname) {
    $dirs = array("application/libs/",
        "application/controller/",
        "application/models/");

    foreach($dirs as $val){
        $file = $val . strtolower($classname) . ".php";
        if(file_exists($file)){
            require_once $file;
            return;
        }
    }
}
*/
// load application config (error reporting etc.)
require 'application/config/config.php';
require "vendor/autoload.php";

// start the application
$app = new Main\Application();
