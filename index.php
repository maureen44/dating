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

//start session
session_start();

//Turn on error reporting -- this is critical
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require ("vendor/autoload.php");
require_once('model/dating-validations.php');

//instantiate Fat-free
$f3 = Base::instance();

//set debug level
$f3->set('DEBUG', 3);

//define array for gender
$f3->set('gender', array('male', 'female'));

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
    $view = new Template();
    echo $view->render('views/home.html');

});

//Define personal information default route
$f3->route('GET|POST /information', function ($f3)
{
   //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Get data from form
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $age = $_POST['age'];
        $phoneNumber = $_POST['phoneNumber'];
        $gender = $_POST['gender'];

        //Add data to hive
        $f3->set('firstName', $firstName);
        $f3->set('lastName', $lastName);
        $f3->set('age', $age);
        $f3->set('phoneNumber', $phoneNumber);
        $f3->set('gender', $gender);

        //If data is valid
        if (validForm()) {

            //Write data to Session
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['age'] = $age;
            $_SESSION['phoneNumber'] = $phoneNumber;
            $_SESSION['gender'] = $gender;

            //redirect to profile page
            $f3->reroute('/profile');
        }

    }

    $view = new Template();
    echo $view->render('views/information.html');
});


//default profile route
$f3->route('GET|POST /profile', function ($f3)
{

    //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Get data from form
        $email = $_POST['email'];
        $state = $_POST['state'];
        $gender = $_POST['gender'];
        $notice = $_POST['notice'];

        //Add data to hive
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('gender', $gender);
        $f3->set('notice', $notice);

         //If data is valid
        if (validProfileForm()) {

            //Write data to Session
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            $_SESSION['gender'] = $gender;
            $_SESSION['notice'] = $notice;

            //redirect to interests page
            $f3->reroute('/interests');
        }

    }
    $view = new Template();
    echo $view->render('views/profile.html');
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

