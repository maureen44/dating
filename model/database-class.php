<?php
require_once ("config-dating.php");
class DatingDatabase
{
    //Connection object or PDO object
    private $_dbh;

    function __construct()
    {
        try {
            //Create a new PDO connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected!";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function connect()
    {

    }

    function getMembers()
    {
        //1. Define the query
        $sql = "SELECT * FROM member
                ORDER BY lname, fname ASC";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameter

        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getMember($member_id)
    {
        //1. Define the query
        $sql = "SELECT * 
                FROM member, member_interest
                WHERE member.member_id = member_interest.member_id
                AND member_id = :member_id";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameter
        $statement->bindParam(':member_id', $member_id);
        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getIntersts($member_id)
    {
        //1. Define the query
        $sql = "SELECT * 
                FROM interest, member
                WHERE interest.member_id = member.member_id
                AND member_id = :member_id";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameter
        $statement->bindParam(':member_id', $member_id);
        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function insertMember($member)
    {
        //1. Define the query
        $sql = "INSERT INTO member(fname, lname, age, gender, phone, email, state, seeking, bio, premium, image)
                VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameter
        $statement->bindParam(':fname', $member->getFName());
        $statement->bindParam(':lname', $member->getLName());
        $statement->bindParam(':age', $member->getAge());
        $statement->bindParam(':gender', $member->getGender());
        $statement->bindParam(':phone', $member->getPhone());
        $statement->bindParam(':email', $member->getEmail());
        $statement->bindParam(':state', $member->getState());
        $statement->bindParam(':seeking', $member->getSeeking());
        $statement->bindParam(':bio', $member->getBio());
        $statement->bindParam(':premium', $member->getPremium());
        $statement->bindParam(':image', $member->getImageUpload());



        //4. Execute the statement
        $statement->execute();

        //5. Get the result
        $id = $this->_dbh->lastInsertId();
    }


}