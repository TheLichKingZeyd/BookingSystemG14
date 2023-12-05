<?php  

// Get courses from database
function getCourses($userID, $pdo){
    $sql = "SELECT * 
    FROM courseaccess AS a
    LEFT JOIN courses s ON s.CourseID=a.CourseID
    WHERE a.UserID=?";

   $stmt = $pdo->prepare($sql);
   $stmt->execute([$userID]);

   if ($stmt->rowCount() > 0) {
   	 $course = $stmt->fetchAll();
   	 return $course;
   }else {
   	$course = [];
   	return $course;
   }
}
?>