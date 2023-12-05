<?php  

// Get bookings where AssistantID = userID
function getAllBookings($userID, $pdo){
   $sql = "SELECT b.BookingID, b.CourseID, b.BookingStart, b.BookingEnd, b.BookingDescr, b.BookingTitle, b.AssistantID, b.BookingStatus, u.FirstName, u.LastName,
   c.CourseCode, c.CourseName
   FROM bookings AS b
   LEFT JOIN users u ON u.UserID=b.AssistantID
   LEFT JOIN courses c ON c.CourseID=b.CourseID
   WHERE b.CreatorID=?
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