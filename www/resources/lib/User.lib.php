<?php 

class User{

    public $UserID;
    public $FirstName;
    public $LastName;
    public $IsStaff;

    function __construct($UserID,$FirstName,$LastName,$IsStaff,){
        $this->UserID = $UserID;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->IsStaff = $IsStaff;
    }

};

?>