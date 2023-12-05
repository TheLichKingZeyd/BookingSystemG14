<?php 

include_once 'connection.inc.php';
include_once 'session.inc.php';
include_once __DIR__ . '/../lib/availability.lib.php';
//include('login.inc.php');






if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    
    $assistantID = $userID;
    $numberOfWeeks = $_POST["NumberOfWeeks"];
    $startDate = $_POST["Date1"];
    $availabilitiesAdded = 0;

    $startTimeArray = array($_POST["StartTime1"],$_POST["StartTime2"],$_POST["StartTime3"],$_POST["StartTime4"],$_POST["StartTime5"],$_POST["StartTime6"],$_POST["StartTime7"]);
    $endTimeArray = array($_POST["EndTime1"], $_POST["EndTime2"], $_POST["EndTime3"], $_POST["EndTime4"], $_POST["EndTime5"], $_POST["EndTime6"], $_POST["EndTime7"]);
    $skipDayArray = array('1',$_POST["SkipDay2"], $_POST["SkipDay3"], $_POST["SkipDay4"], $_POST["SkipDay5"], $_POST["SkipDay6"], $_POST["SkipDay7"] );



//might be unecessary, check later and remove if possible
    $currentDate = $startDate;

    for($i=0; $i < $numberOfWeeks;$i++){



        
        for($j= 0; $j < 7; $j++){


            if($skipDayArray[$j]){

                $availabilityStart = date('Y-m-d H:i:s', strtotime("$currentDate $startTimeArray[$j]"));
                $availabilityEnd = date('Y-m-d H:i:s', strtotime("$currentDate $endTimeArray[$j]"));
                

                $newAvailability = new Availability();
                $newAvailability->createNewAvailability($assistantID, $availabilityStart, $availabilityEnd);


                $sqlInsertAvailability = "INSERT INTO Availabilities (AssistantID, AvailabilityStart, AvailabilityEnd) VALUES (:assistantID, :availablityStart, :availabilityEnd)";
                $query = $pdo->prepare($sqlInsertAvailability);

                $query->bindParam(":assistantID", $newAvailability->assistantID, PDO::PARAM_INT);
                $query->bindParam(":availablityStart", $newAvailability->availabilityStart, PDO::PARAM_STR);
                $query->bindParam(":availabilityEnd", $newAvailability->availabilityEnd, PDO::PARAM_STR);


                try {
                    $query->execute();
// add some sort of feedback
                } catch(PDOException $exc){
                    $errormsg = $exc;
                }
                $availabilitiesAdded++;
            }

            $currentDate = date("Y-m-d",strtotime("1 day",strtotime($currentDate)));
        }
    }
    echo $availabilitiesAdded."availabilities added";
}



?>