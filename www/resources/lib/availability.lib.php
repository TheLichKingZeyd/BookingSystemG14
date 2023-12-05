<?php 

class Availability{

//    public $availabilityID;
    public $availabilityDate;
    public $availabilityStart;
    public $availabilityEnd;
    public $assistantID;
    public $availabilityID;


    function createNewAvailability(int $assistantID, string $availabilityStart, string $availabilityEnd){
        $this->assistantID = $assistantID;
        $this->availabilityStart = $availabilityStart;
        $this->availabilityEnd = $availabilityEnd;
    }
}

?>