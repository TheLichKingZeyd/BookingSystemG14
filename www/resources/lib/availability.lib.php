<?php 

class availability{

//    public $availabilityID;
    public $availabilityStart;
    public $availabilityEnd;
    public $assistantID;



    function createNewAvailability(int $assistantID, string $availabilityStart, string $availabilityEnd){

        $this->assistantID = $assistantID;
        $this->availabilityStart = $availabilityStart;
        $this->availabilityEnd = $availabilityEnd;
    }
}

?>