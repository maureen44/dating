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
$f3->route('GET /', function ()
{
    $GLOBALS['controller']->home();

});

//Define personal information default route
$f3->route('GET|POST /information', function ($f3)
{

    $GLOBALS['controller']->information();

});


//default profile route
$f3->route('GET|POST /profile', function ($f3)
{


});

//default interests route
$f3->route('GET|POST /interests', function ($f3)
{
    $selectedIndoors = array();
    $selectedOutdoors = array();

    //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //get data from indoor
        if (!empty($_POST['indoors'])) {
            foreach ( $_POST['indoors'] as $value) {
                array_push($selectedIndoors, $value);
            }
        }

        //get data from outdoor
        if (!empty($_POST['outdoors'])) {
            foreach ( $_POST['outdoors'] as $value) {
                array_push($selectedOutdoors, $value);
            }
        }

        //Add data to hive
        $f3->set('inInterests', $selectedIndoors);
        $f3->set('outInterests', $selectedOutdoors);

        if (validInterests()) {
            $_SESSION['indoors'] = $selectedIndoors;
            $_SESSION['outdoors'] = $selectedOutdoors;

            //Redirect to Summary
            $f3->reroute('/summary');
        }

    }
    $view = new Template();
    echo $view->render('views/interests.html');
    // echo "Cake Lovers Dating!";
});

//Define a summary route
$f3->route('GET /summary', function() {

    //Display summary
    $view = new Template();
    echo $view->render('views/summary.html');
});


//run fat free
$f3->run();

