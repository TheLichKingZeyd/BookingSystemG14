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
                
                for ($availabilityStart; $availabilityStart < $availabilityEnd; date("Y-m-d H:i:s", strtotime("+30 minutes $availabilityStart"))){
                    $newAvailability = new Availability();
                    $periodEnd = date('Y-m-d H:i:s', strtotime("+30 minutes $availabilityStart"));
                    $date = date('Y-m-d', strtotime($availabilityStart));
                    $newAvailability->createNewAvailability($assistantID, $availabilityStart, $periodEnd);


                    $sqlInsertAvailability = "INSERT INTO availabilities (AssistantID, AvailabilityDate, AvailabilityStart, AvailabilityEnd) VALUES (:assistantID, :availabilityDate, :availablityStart, :availabilityEnd)";
                    $query = $pdo->prepare($sqlInsertAvailability);

                    $query->bindParam(":assistantID", $newAvailability->assistantID, PDO::PARAM_INT);
                    $query->bindParam(":availabilityDate", $date, PDO::PARAM_STR);
                    $query->bindParam(":availablityStart", $newAvailability->availabilityStart, PDO::PARAM_STR);
                    $query->bindParam(":availabilityEnd", $newAvailability->availabilityEnd, PDO::PARAM_STR);


                    try {
                        $query->execute();
                        // add some sort of feedback
                    } catch(PDOException $exc){
                        $errormsg = $exc;
                    }
                    $availabilityStart = date('Y-m-d H:i:s', strtotime("+30 minutes $availabilityStart"));                    
                }
                $availabilitiesAdded++;
                
            }

            $currentDate = date("Y-m-d",strtotime("1 day",strtotime($currentDate)));
        }
    }
    echo $availabilitiesAdded."availabilities added";
}



?>