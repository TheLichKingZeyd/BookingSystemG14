<?php

$_messageOutput['message'] = "";
$date_now = date("Y-m-d h:m:s");

// If POST update TIME
if(isset($_POST['submitChange'])) {

    $ID = $_GET['bookingID'];
    
    // If not empty
    if(!empty($_POST['editFrom']) && !empty($_POST['editTo'])) {
        // If bigger than current date
        if($date_now < $_POST['editFrom']) {

            if ($_POST['editFrom'] < $_POST['editTo']) {
                $newStartTime = test_input($_POST['editFrom']);
                $newEndTime = test_input($_POST['editTo']);

                // QUERY DATABASE TO UPDATE USER INFORMATION
                $query = "UPDATE bookings SET BookingStart=:newstart, BookingEnd=:newend WHERE BookingID=$ID";
            
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
                    echo '<script>window.location.href = "admin.booking.php";</script>';
                
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

// If POST update TIME
if(isset($_POST['user_submit_change'])) {

    $ID = $_GET['bookingID'];
    
    // If not empty
    if(!empty($_POST['editFrom']) && !empty($_POST['editTo'])) {
        // If bigger than current date
        if($date_now < $_POST['editFrom']) {

            if ($_POST['editFrom'] < $_POST['editTo']) {
                $newStartTime = test_input($_POST['editFrom']);
                $newEndTime = test_input($_POST['editTo']);

                // QUERY DATABASE TO UPDATE USER INFORMATION
                $query = "UPDATE bookings SET BookingStart=:newstart, BookingEnd=:newend WHERE BookingID=$ID";
            
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
                    echo '<script>window.location.href = "mybooking.php";</script>';
                
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


// If POST cancel booking
if(isset($_POST['cancelBook'])) {

    $bookID = $_POST['cancelBookID'];
    // Query for updateing bookingstatus to 0
    $bookQ = "UPDATE bookings SET BookingStatus=0 WHERE BookingID=$bookID";
    $b = $pdo->prepare($bookQ);

    // Execute
    try {
        $b->execute();
    } catch(PDOException){
        
    }
}

// If POST DELETE booking
if(isset($_POST['delete_entry'])) {

    $bookID = $_POST['cancelBookID'];
    // Query for updateing bookingstatus to 0
    $deleteQ = "DELETE FROM bookings WHERE BookingID=$bookID";
    $d = $pdo->prepare($deleteQ);

    // Execute
    try {
        $d->execute();
    } catch(PDOException){
        
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