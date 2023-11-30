<?php 

class User{

    public $userID;
    public $firstName;
    public $lastName;
    public $password;
    public $isAssistant;
    public $email;

    function __construct(int $userID, string $firstName, string $lastName, string $email, string $password, bool $isAssistant){
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->isAssistant = $isAssistant;
    }

}

?>