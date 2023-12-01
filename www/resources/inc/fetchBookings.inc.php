<?php      
// Include database configuration file
include('connection.inc.php');
include('login.inc.php');
 
// Fetch events from database 
$sql = "SELECT * FROM bookings";
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