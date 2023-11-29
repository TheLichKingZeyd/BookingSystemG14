<?php 

class User{

    public $userID;
    public $firstName;
    public $lastName;
    public $isAssistant;
    public $email;

    function __construct(int $userID, string $firstName, string $lastName, string $email, bool $isAssistant){
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->isAssistant = $isAssistant;
    }

};

?>