<?php  

// Get user from database
function getUser($username, $pdo){
   $sql = "SELECT * FROM users 
           WHERE UserID=?";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([$username]);

   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}
?>