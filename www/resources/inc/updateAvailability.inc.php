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
if(isset($_POST['user_submit_change'])) {

    $ID = $_GET['AvailabilityID'];
    
    // If not empty
    if(!empty($_POST['editFrom']) && !empty($_POST['editTo'])) {
        // If bigger than current date
        if($date_now < $_POST['editFrom']) {

            if ($_POST['editFrom'] < $_POST['editTo']) {
                $newStartTime = test_input($_POST['editFrom']);
                $newEndTime = test_input($_POST['editTo']);

                // QUERY DATABASE TO UPDATE USER INFORMATION
                $query = "UPDATE Availabilities SET AvailabilityStart=:newstart, AvailabilityEnd=:newend WHERE AvailabilityID=$ID";
            
                // Prepare the statements
                $statement = $pdo->prepare($query);

                // Pass variables into data
                $data = [
                    ':newstart' => $newStartTime,
                    ':newend' => $newEndTime
                ];
                
                // Excecute and pass data into database
                try {
                    $execute = $statement->execute($data);
                    echo '<script>window.location.href = "availabilityEdit.php";</script>';
                
                } catch (PDOException) {

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