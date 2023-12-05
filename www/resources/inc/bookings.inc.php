<?php

include_once 'connection.inc.php';
include_once 'session.inc.php';
include_once 'mailer.inc.php';
include_once __DIR__ . '/../lib/booking.lib.php';

$sqlCourses = "SELECT * FROM courseaccess AS a LEFT JOIN courses c ON c.CourseID=a.CourseID WHERE a.UserID= {$_SESSION['userID']}";
$coursesQuery = $pdo->prepare($sqlCourses);

try {
    $coursesQuery->execute();
} catch(PDOException $exc){
    $errormsg = $exc;
}

$courses = $coursesQuery->fetchAll(PDO::FETCH_OBJ);

$assistantFetchString = "";
for ($i = 0; $i < sizeof($courses); $i++){
    if ($i == sizeof($courses) - 1){
        $assistantFetchString .= $courses[$i]->CourseID;
    } else {
        $assistantFetchString .= $courses[$i]->CourseID . ",";
    }
}

$sqlAssistants = "SELECT * FROM users AS a RIGHT JOIN courseaccess c ON c.UserID=a.UserID WHERE c.CourseID IN ($assistantFetchString) AND c.AsAssistant = 1";
$assistantsQuery = $pdo->prepare($sqlAssistants);

try {
    $assistantsQuery->execute();
} catch(PDOException $exc){
    $errormsg = $exc;
}

$assistants = $assistantsQuery->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submitBooking']) && is_string($_POST['bookingTitle']) && is_string($_POST['bookingDescription']) && is_string($_POST['bookingDate']) && is_string($_POST['bookingTime']) && is_numeric($_POST['bookingAssistant']) && is_numeric($_POST['bookingCourse']) && ($_POST['bookingTime'] > date("Y-m-d h:m:s"))){
    include_once 'connection.inc.php';
    $validator = new Validator();
    $bookingAssistant = $_POST['bookingAssistant'];
    $bookingCourse = $_POST['bookingCourse'];
    $bookingTitle = $validator->cleanString($_POST['bookingTitle']);
    $bookingDescription = $validator->cleanString($_POST['bookingDescription']);
    $startDate = $validator->cleanString($_POST['bookingDate']);
    $startTime = $validator->cleanString($_POST['bookingTime']);
    
    $bookingStart = date('Y-m-d H:i:s', strtotime("$startDate $startTime"));
    $endTime = date("H:i:s", strtotime("+30 minutes $startTime"));
    $bookingEnd = date('Y-m-d H:i:s', strtotime("$startDate $endTime"));

    $newBooking = new Booking();
    $newBooking->createNewBooking($userID, $bookingAssistant, $bookingCourse, $bookingTitle, $bookingDescription, $bookingStart, $bookingEnd);

    $sqlInsertBooking = "INSERT INTO bookings (CreatorID, AssistantID, CourseID, BookingTitle, BookingDescr, BookingStart, BookingEnd) VALUES (:creatorID, :assistantID, :courseID, :title, :description, :startTime, :endTime)";
    $query = $pdo->prepare($sqlInsertBooking);
    $query->bindParam(":creatorID", $newBooking->creatorID, PDO::PARAM_INT);
    $query->bindParam(":assistantID", $newBooking->assistantID, PDO::PARAM_INT);
    $query->bindParam(":courseID", $newBooking->courseID, PDO::PARAM_INT);
    $query->bindParam(":title", $newBooking->title, PDO::PARAM_STR);
    $query->bindParam(":description", $newBooking->description, PDO::PARAM_STR);
    $query->bindParam(":startTime", $newBooking->startTime, PDO::PARAM_STR);
    $query->bindParam(":endTime", $newBooking->endTime, PDO::PARAM_STR);

    try {
        $query->execute();
        $booked = true;
        
        // echo '<script>window.location.href = "booking.php"; alert("Assistant teacher booked.")</script>';
    } catch(PDOException $exc){
        $errormsg = $exc;
    }

    if ($booked){
        $sqlFetchAssistant = "SELECT * FROM users WHERE UserID = $newBooking->assistantID";
        $assistQuery = $pdo->prepare($sqlFetchAssistant);

        try {
            $assistQuery->execute();
        } catch(PDOException $exc){
            $errormsg = $exc;
        }

        $assistant = $assistQuery->fetch(PDO::FETCH_OBJ);

        $sqlFetchCourse = "SELECT * FROM courses WHERE CourseID = $newBooking->courseID";
        $courseQuery = $pdo->prepare($sqlFetchCourse);

        try {
            $courseQuery->execute();
        } catch(PDOException $exc){
            $errormsg = $exc;
        }

        $course = $courseQuery->fetch(PDO::FETCH_OBJ);

        $mailInfo = array();
        $mailInfo = ["mailType" => "booking",
                     "studName" => $_SESSION['firstname'] . " " . $_SESSION['lastname'],
                     "studEmail" => $_SESSION['email'],
                     "assistName" => $assistant->FirstName . " " . $assistant->LastName,
                     "assistEmail" => $assistant->Email,
                     "course" => $course->CourseCode . " - " . $course->CourseName];
        sendMails($mailInfo);
    }
}

?>