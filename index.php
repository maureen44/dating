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

//start session
session_start();

//default route
$f3->route('GET /', function ()
{
    $view = new Template();
    echo $view->render('views/home.html');

});

//Define personal information default route
$f3->route('GET /personalInfo', function () {
    $view = new Template();
    echo $view->render('views/personalinfo.html');
});


//default profile route
$f3->route('GET /profile', function ()
{
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
    $view = new Template();
    echo $view->render('views/profile.html');
});

//default interests route
$f3->route('GET /interests', function ()
{
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['input'] = $_POST['input'];
    $view = new Template();
    echo $view->render('views/interests.html');
    // echo "Cake Lovers Dating!";
});

//run fat free
$f3->run();
?>
