<?php 

class Booking{

    public $creatorID;
    public $assistantID;
    public $courseID;
    public $title;
    public $description;
    public $startTime;
    public $endTime;

    function createNewBooking(int $creator, int $assistantID, int $courseID, string $title, string $description, string $startTime, string $endTime){
        $this->creatorID = $creator;
        $this->assistantID = $assistantID;
        $this->courseID = $courseID;
        $this->title = $title;
        $this->description = $description;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
}

?>