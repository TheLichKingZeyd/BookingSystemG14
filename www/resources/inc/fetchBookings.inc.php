<?php      
// Include database configuration file
include('connection.inc.php');
include('login.inc.php');

session_start();
$userID = $_SESSION['userID'];
// Fetch events from database
$sql = "SELECT * FROM bookings WHERE CreatorID = $userID";
$result = $pdo->prepare($sql);

// Kjør
try {
    $result->execute();
} catch (PDOException) {
    
}
 
$response = array();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $response[] = array(
		"id" => $row['BookingID'],
		"courseID" => $row['CourseID'],
		"start" => $row['BookingStart'],
		"end" => $row['BookingEnd'],
		"description" => $row['BookingDescr'],
		"creatorID" => $row['CreatorID'],
		"title" => $row['BookingTitle'],
		"assistantID" => $row['AssistantID'],
	);
}
 
// Render event data in JSON format 
echo json_encode($response);
?>