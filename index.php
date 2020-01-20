<?php
//This is our Controller!
//Turn on error reporting -- this is critical
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require ("vendor/autoload.php");

//instantiate Fat-free
$f3 = Base:: instance();

//default route
$f3->route('GET /', function ()
{
    $view = new Template();
    echo $view->render('views/home.html');
});

//run fat free
$f3-> run();
