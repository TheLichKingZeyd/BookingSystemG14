<?php  

// Get user from database
function getOtherUserprofile($userID, $pdo){
   $sql = "SELECT u.FirstName, u.LastName, u.Email, u.IsAssistant, p.ProfileExperience
   FROM users AS u
   LEFT JOIN profileinfo AS p ON p.UserID=u.UserID
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