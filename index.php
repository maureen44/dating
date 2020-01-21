<?php
/**
 * Maureen Kariuki
 * 01/20/2020
 *
 * This is the controller
 * The base class is instantiated,
 * fat free route declared and fat free
 * is run.
 */

//Turn on error reporting -- this is critical
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require ("vendor/autoload.php");

//instantiate Fat-free
$f3 = Base::instance();

//default route
$f3->route('GET /', function ()
{
    $view = new Template();
    echo $view->render('views/home.html');
   // echo "Cake Lovers Dating!";
});

//run fat free
$f3->run();
?>
