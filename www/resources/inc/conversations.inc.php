<?php 

// Get conversations where session id (logged in user) == user_1 or user_2 in database
function getConversation($userID, $pdo){

    $sql = "SELECT * FROM conversations
            WHERE user_1=? OR user_2=?
            ORDER BY conversation_id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID, $userID]);

    if($stmt->rowCount() > 0){
        $conversations = $stmt->fetchAll();

        $user_data = [];
        
        // loop through the conversations 
        foreach($conversations as $conversation){
            // if conversations user_1 row equal to userID
            if ($conversation['User_1'] == $userID) {
            	$sql2  = "SELECT *
            	          FROM users WHERE UserID=?";
            	$stmt2 = $pdo->prepare($sql2);
            	$stmt2->execute([$conversation['User_2']]);
            }else {
            	$sql2  = "SELECT *
            	          FROM users WHERE UserID=?";
            	$stmt2 = $pdo->prepare($sql2);
            	$stmt2->execute([$conversation['User_1']]);
            }

            $allConversations = $stmt2->fetchAll();

            // pushing the data into the array
            array_push($user_data, $allConversations[0]);
        }

        return $user_data;

    }else {
    	$conversations = [];
    	return $conversations;
    }  

}

?>