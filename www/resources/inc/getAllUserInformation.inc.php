<?php  

// Get user from database
function getAllUserInformation($userID, $pdo){
   $sql = "SELECT * 
   FROM users AS u
   LEFT JOIN profileinfo p ON p.UserID=u.UserID
   WHERE u.UserID=?";

   $stmt = $pdo->prepare($sql);
   $stmt->execute([$userID]);

   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}
?>