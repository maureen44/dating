<?php

class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;
    private $_imageUpload;



    /**
     * PremiumMember constructor.
     * @param $fname
     * @param $lname
     * @param $age
     * @param $gender
     * @param $phone
     * @param $image
     * @param $inDoorInterests
     * @param $outDoorInterests
     */
    public function __construct($fname, $lname, $age, $gender, $phone, $image = "?", $inDoorInterests = "?", $outDoorInterests = "?")
    {
        parent::__construct($fname, $lname, $age, $gender, $phone, $image);
        $this->_inDoorInterests = $inDoorInterests;
        $this->_outDoorInterests = $outDoorInterests;
        $this->_imageUpload = $image;
    }

    /**
     * @return string
     */
    public function getImageUpload()
    {
        return $this->_imageUpload;
    }

    /**
     * @param string $imageUpload
     */
    public function setImageUpload($imageUpload)
    {
        $this->_imageUpload = $imageUpload;
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