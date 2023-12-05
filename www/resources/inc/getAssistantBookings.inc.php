<?php  

// Get bookings where AssistantID = userID
function getAssistantBookings($userID, $pdo){
   $sql = "SELECT b.BookingID, b.CourseID, b.BookingStart, b.BookingEnd, b.BookingDescr, b.CreatorID, b.BookingTitle, b.AssistantID, b.BookingStatus, u.FirstName, u.LastName,
   c.CourseCode, c.CourseName
   FROM bookings AS b
   LEFT JOIN users u ON u.UserID=b.CreatorID
   LEFT JOIN courses c ON c.CourseID=b.CourseID
   WHERE b.AssistantID=?
   ORDER BY b.BookingStart ASC";

   $stmt = $pdo->prepare($sql);
   $stmt->execute([$userID]);

   if ($stmt->rowCount() > 0) {
   	 $user = $stmt->fetchAll();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}
?>