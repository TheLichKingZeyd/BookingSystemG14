<?php  



// If POST DELETE availability
if(isset($_POST['delete_avail'])) {

    $ID = $_POST['deleteAvailability'];
    // Query for updateing bookingstatus to 0
    $deleteQ = "DELETE FROM Availabilities WHERE AvailabilityID=$ID";
    $d = $pdo->prepare($deleteQ);

    // Execute
    try {
        $d->execute();
    } catch(PDOException){
        
    }
}

// If POST update TIME
if(isset($_POST['assistant_submit_change'])) {

    $ID = $_GET['AvailabilityID'];
    
    // If not empty
    if(!empty($_POST['editFrom']) && !empty($_POST['editTo'])) {
        // If bigger than current date
        if($date_now < $_POST['editFrom']) {

            if ($_POST['editFrom'] < $_POST['editTo']) {
                $newStartTime = test_input($_POST['editFrom']);
                $newEndTime = test_input($_POST['editTo']);
                
                $oldStart = $_POST['availStart'];
                $oldEnd = $_POST['availEnd'];
                $sqlDeleteOld = "DELETE * FROM availabilities WHERE (AvailabilityStart >= $oldStart AND AvailabilityEnd <= $oldEnd AND AssistantID=$userID)";
                $query = $pdo->prepare($sqlDeleteOld);

                try {
                    $query->execute();
                    //echo '<script>window.location.href = "availabilityEdit.php";</script>';                    
                } catch (PDOException) {
    
                }
                
            
                for ($newStartTime; $newStartTime < $newEndTime; date("Y-m-d H:i:s", strtotime("+30 minutes $newStartTime"))){
                    $newAvailability = new Availability();
                    $periodEnd = date('Y-m-d H:i:s', strtotime("+30 minutes $newStartTime"));
                    $date = date('Y-m-d', strtotime($newStartTime));
                    $newAvailability->createNewAvailability($userID, $newStartTime, $periodEnd);


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
                    $newStartTime = date('Y-m-d H:i:s', strtotime("+30 minutes $newStartTime"));                    
                }
                
            } else {
                $_messageOutput['message'] ="From must be before to";
            }
        } else {
            $_messageOutput['message'] ="Must be after current date";
        }
    } else {
        $_messageOutput['message'] ="Input fields are required";
    }
}


// Clean data
function test_input($data) {
    $data = trim($data);  
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>