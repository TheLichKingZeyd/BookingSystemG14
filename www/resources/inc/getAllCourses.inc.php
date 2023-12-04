<?php  

// Get courses from database
function getAllCourses($pdo){
    $sql = "SELECT * FROM courses";

   $stmt = $pdo->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() > 0) {
   	 $course = $stmt->fetchAll();
   	 return $course;
   }else {
   	$course = [];
   	return $course;
   }
}
?>