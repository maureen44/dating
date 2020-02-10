<?php
/**
 * A validation file that contains
 * validation functions for a dating applicTION
 *
 * @author Maureen Kariuki
 * @version IT 328 02/09/2020 01
 */

function validForm()
{
    global $f3;
    $isValid = true;

    if (!validFirstName($f3->get('firstName'))) {
        $isValid = false;
        $f3->set("errors['firstName']", "Please enter a first name");
    }
    if (!validLastName($f3->get('lastName'))) {
        $isValid = false;
        $f3->set("errors['lastName']", "Please enter a last name");
    }
    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter an age");
    }
    if (!validPhone($f3->get('phoneNumber'))) {
        $isValid = false;
        $f3->set("errors['phoneNumber']", "Please enter a phone number");
    }
    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter an email address");
    }
    if (!validIndoor($f3->get('indoorss'))) {
        $isValid = false;
        $f3->set("errors['indoors']", "Please select indoor interests");
    }

    if (!validOutdoor($f3->get('outdoors'))) {
        $isValid = false;
        $f3->set("errors['outdoors']", "Please select outdoor interests");
    }

    return $isValid;
}

/**
 * validating first name
 * @param $firstName
 * @return bool returns true if first name is entered
 * and is valid. Otherwise returns false.
 */
function validFirstName($firstName)
{
    if (!empty($firstName) && ctype_alpha($firstName) ) {
        return true;
    } else {
        return false;
    }
}

/**
 * validating the last name
 * @param $lastName
 * @return bool returns true if last name is entered
 * and is valid. Otherwise returns false
 */
function validLastName($lastName) {
    if (!empty($lastName) && ctype_alpha($lastName)) {
        return true;
    } else {
        return false;
    }
}

/**
 * validating age
 * @param $age
 * @return bool returns true if age entered
 * is a number and is between 18 and 118 years.
 * Otherwise returns false.
 */
function validAge($age) {
    if (!empty($age) && ctype_digit($age) && $age >= 18 && $age <= 118) {
        return true;
    } else {
        return false;
    }

}

/**
 * validates the phone number entered
 * @param $phoneNumber
 * @return bool returns true if phone number is a number
 * and is a valid phone number. Otherwise returns false.
 */
function validPhone($phoneNumber) {
    if (!empty($phoneNumber) && ctype_digit($phoneNumber) && strlen($phoneNumber) == 10) {
        return true;
    } else {
        return false;
    }
}

/**
 * validates the email address entered
 * @param $email
 * @return bool returns true if email is valid. Otherwise
 * returns false.
 *
 */
function validEmail($email) {
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

/**
 * validating indoor interests
 * @param $in_interests
 * @return bool returns true if a valid selection is made
 * and false if otherwise.
 */
function validIndoor($in_interests) {
    global $f3;
    return true;
    /*if (!empty($in_interests)) {
        return true;
    } else {
        return false;
    }
    foreach ($in_interests as $indoor) {
        if (in_array($indoor, $f3->get('in-interests'))) {
            return true;
        } else {
            return false;
        }
    }*/

}

function validOutdoor($out_interests) {
    global $f3;
    return true;
}