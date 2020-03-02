<?php

class MemberController
{
    private $_f3;

    /**
     * MemberController constructor.
     * @param $f3
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {

        $view = new Template();
        echo $view->render('views/home.html');
    }

    function information()
    {
        //If form has been submitted, validate
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get data from form
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $phoneNumber = $_POST['phoneNumber'];
            $image = $_POST['imageUpload'];

            //Add data to hive
            $this->_f3->set('firstName', $firstName);
            $this->_f3->set('lastName', $lastName);
            $this->_f3->set('age', $age);
            $this->_f3->set('gender', $gender);
            $this->_f3->set('phoneNumber', $phoneNumber);
            $this->_f3->set('checkbox1', checkbox);
            $this->_f3->set('imageUpload', $image);


            $checkbox1 = isset($_POST['checkbox']);
            $_SESSION['checkbox'] = $checkbox1;

            if (isset($_POST['checkbox'])) {
                $member = new PremiumMember($firstName, $lastName, $age, $gender, $phoneNumber, $image);
            } else {
                $member = new Member($firstName, $lastName, $age, $gender, $phoneNumber);
            }
            //If data is valid
            if (validForm()) {

                //Write data to Session
                $_SESSION['Member'] = $member;
                //redirect to profile page
                $this->_f3->reroute('/profile');
            }

        }
        $view = new Template();
        echo $view->render('views/information.html');

    }

    function profile()
    {
        //If form has been submitted, validate
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Get data from form
            $email = $_POST['email'];
            $state = $_POST['state'];
            $seek = $_POST['seekGender'];
            $notice = $_POST['notice'];

            //Add data to hive
            $this->_f3->set('email', $email);
            $this->_f3->set('state', $state);
            $this->_f3->set('seek', $seek);
            $this->_f3->set('notice', $notice);


            //If data is valid
            if (validProfileForm()) {

                //Write data to Session
                $_SESSION['Member']->setEmail($email);
                $_SESSION['Member']->setState($state);
                $_SESSION['Member']->setSeeking($seek);
                $_SESSION['Member']->setBio($notice);

                if ($_SESSION['checkbox'] == 1) {
                    //redirect to interests page
                    $this->_f3->reroute('/interests');
                } else {
                    //redirect to summary page
                    $this->_f3->reroute('/summary');
                }
            }
        }
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
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
            $this->_f3->set('inInterests', $selectedIndoors);
            $this->_f3->set('outInterests', $selectedOutdoors);

            if (validInterests()) {
                $_SESSION['indoor'] = $selectedIndoors;
                $_SESSION['outdoor'] = $selectedOutdoors;
                $_SESSION['Member']->setInDoorInterests($selectedIndoors);
                $_SESSION['Member']->setOutDoorInterests($selectedOutdoors);

                //Redirect to Summary
                $this->_f3->reroute('/summary');
            }

        }
        $view = new Template();
        echo $view->render('views/interests.html');
        // echo "Cake Lovers Dating!";
    }

    function summary($db, $member)
    {
        $db->insertMember($member);
        //Display summary
        $view = new Template();
        echo $view->render('views/summary.html');
    }

}
