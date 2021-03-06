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
require_once('model/dating-validations.php');

//start session
session_start();


//instantiate Fat-free
$f3 = Base::instance();


//set debug level
$f3->set('DEBUG', 3);

//define controller
$controller = new MemberController($f3);

//define database
$db = new DatingDatabase();

//define array for gender
$f3->set('genders', array('male', 'female'));

//define array for states
$f3->set('states', array('washington', 'oregon', 'california'));

//define array for indoor interests
$f3->set('indoors', array('tv', 'puzzle', 'movies', 'reading',
    'cooking', 'playing cards', 'board games', 'video games'));

//define array for outdoor interests
$f3->set('outdoors', array('hiking', 'walking', 'biking',
    'climbing', 'swimming', 'collecting stones'));


//default route
$f3->route('GET /', function ($f3)
{
    $GLOBALS['controller']->home();

});

//Define a route that displays member detail
$f3->route('GET /detail/@member_id', function($f3, $params){

    $GLOBALS['controller']->detail($params['member_id']);
});

//Define a route that displays the admin page
$f3->route('GET /member.html', function ($f3) {
    $GLOBALS['controller']->admin();
});

//Define personal information default route
$f3->route('GET|POST /information', function ($f3)
{

    $GLOBALS['controller']->information();

});


//default profile route
$f3->route('GET|POST /profile', function ($f3)
{

    $GLOBALS['controller']->profile();
});

//default interests route
$f3->route('GET|POST /interests', function ($f3)
{
    $GLOBALS['controller']->interests();
});

//Define a summary route
$f3->route('GET|POST /summary', function($f3) {

    global $db;
    global $controller;
    $controller->summary($db, $_SESSION['Member']);
   /* $GLOBALS['controller']->summary($db, $_SESSION['Member']);*/

    session_destroy();
    $_SESSION = array();
});


//run fat free
$f3->run();

