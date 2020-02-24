<?php

class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * PremiumMember constructor.
     * @param $fname
     * @param $lname
     * @param $age
     * @param $gender
     * @param $phone
     * @param $inDoorInterests
     * @param $outDoorInterests
     */
    public function __construct($fname, $lname, $age, $gender, $phone, $inDoorInterests, $outDoorInterests)
    {
        parent::_construct($fname, $lname, $age, $gender, $phone);
        $this->_inDoorInterests = $inDoorInterests;
        $this->_outDoorInterests = $outDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

}