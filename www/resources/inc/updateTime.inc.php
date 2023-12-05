<?php

include 'mailer.inc.php';

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
                $updated = null;
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
                    $updated = true;
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

    if ($updated){
        $sqlGetStudentInfo = "SELECT * FROM bookings As b
                              LEFT JOIN users u ON u.UserID=b.CreatorID
                              LEFT JOIN courses c ON c.CourseID=b.CourseID
                              WHERE b.BookingID=$ID";
        $query = $pdo->prepare($sqlGetStudentInfo);

        try {
            $query->execute();
        } catch(PDOException $exc){
            $errormsg = $exc;
        }

        $studentBooking = $query->fetch(PDO::FETCH_OBJ);
        $mailInfo = array();
        $mailInfo = ["mailType" => "assistMovedBooking",
                     "assistName" => $_SESSION['firstname'] . " " . $_SESSION['lastname'],
                     "studName" => $studentBooking->FirstName . " " . $studentBooking->LastName,
                     "studEmail" => $studentBooking->Email,
                     "course" => $studentBooking->CourseCode . " - " . $studentBooking->CourseName];
        sendMails($mailInfo);
        // echo '<script>window.location.href = "admin.booking.php";</script>';
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
                $updated = null;
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
                    $updated = true;
                    //echo '<script>window.location.href = "mybooking.php";</script>';
                
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

    if ($updated){
        $sqlGetAssistantInfo = "SELECT * FROM bookings As b
                              LEFT JOIN users u ON b.AssistantID=u.UserID
                              LEFT JOIN courses c ON c.CourseID=b.CourseID
                              WHERE b.BookingID=$ID";
        $query = $pdo->prepare($sqlGetAssistantInfo);

        try {
            $query->execute();
        } catch(PDOException $exc){
            $errormsg = $exc;
        }

        $assistantBooking = $query->fetch(PDO::FETCH_OBJ);

        $mailInfo = array();
        $mailInfo = ["mailType" => "studMovedBooking",
                     "assistName" => $assistantBooking->FirstName . " " . $assistantBooking->LastName,
                     "assistEmail" => $assistantBooking->Email,
                     "studName" => $_SESSION['firstname'] . " " . $_SESSION['lastname'],
                     "course" => $assistantBooking->CourseCode . " - " . $assistantBooking->CourseName];
        sendMails($mailInfo);
        // echo '<script>window.location.href = "admin.booking.php";</script>';
    }
}


// If POST cancel booking
if(isset($_POST['assistantCancelBook'])) {
    $deleted = null;
    $bookID = $_POST['cancelBookID'];

    $sqlGetStudentInfo = "SELECT * FROM bookings As b
                              LEFT JOIN users u ON b.CreatorID=u.UserID
                              LEFT JOIN courses c ON c.CourseID=b.CourseID
                              WHERE b.BookingID=$bookID";
    $query = $pdo->prepare($sqlGetStudentInfo);

    try {
        $query->execute();
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    $studentBooking = $query->fetch(PDO::FETCH_OBJ);
    // Query for updateing bookingstatus to 0
    $bookQ = "UPDATE bookings SET BookingStatus=0 WHERE BookingID=$bookID";
    $b = $pdo->prepare($bookQ);

    // Execute
    try {
        $b->execute();
        $deleted = true;
    } catch(PDOException){
        
    }

    if ($deleted){
        $mailInfo = array();
        $mailInfo = ["mailType" => "assistCanceledBooking",
                     "assistName" => $_SESSION['firstname'] . " " . $_SESSION['lastname'],
                     "studName" => $studentBooking->FirstName . " " . $studentBooking->LastName,
                     "studEmail" => $studentBooking->Email,
                     "course" => $studentBooking->CourseCode . " - " . $studentBooking->CourseName];
        sendMails($mailInfo);
    }
}

// If POST DELETE booking
if(isset($_POST['delete_entry'])) {
    $deleted = null;
    $bookID = $_POST['cancelBookID'];

    $sqlGetAssistantInfo = "SELECT * FROM bookings As b
    LEFT JOIN users u ON b.AssistantID=u.UserID
    LEFT JOIN courses c ON c.CourseID=b.CourseID
    WHERE b.BookingID=$bookID";
    $query = $pdo->prepare($sqlGetAssistantInfo);

    try {
        $query->execute();
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    $assistantBooking = $query->fetch(PDO::FETCH_OBJ);

    // Query for updateing bookingstatus to 0
    $deleteQ = "DELETE FROM bookings WHERE BookingID=$bookID";
    $d = $pdo->prepare($deleteQ);

    // Execute
    try {
        $d->execute();
        $deleted = true;
    } catch(PDOException){
        
    }

    if ($deleted){
        $mailInfo = array();
        $mailInfo = ["mailType" => "studCanceledBooking",
                     "assistName" => $assistantBooking->FirstName . " " . $assistantBooking->LastName,
                     "assistEmail" => $assistantBooking->Email,
                     "studName" => $_SESSION['firstname'] . " " . $_SESSION['lastname'],                     
                     "course" => $assistantBooking->CourseCode . " - " . $assistantBooking->CourseName];
        sendMails($mailInfo);
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