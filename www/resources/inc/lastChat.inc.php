<?php 

// Get last chat from conversation
// Check where session id is equal to either from or to id in database
function lastChat($id_1, $id_2, $pdo){
   
   $sql = "SELECT * FROM chats
           WHERE (From_id=? AND To_id=?)
           OR    (To_id=? AND From_id=?)
           ORDER BY chat_id DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_1, $id_2, $id_1, $id_2]);

    // If there is a result return content of message
    if ($stmt->rowCount() > 0) {
    	$chat = $stmt->fetch();
    	return $chat['Content'];
    }else {
    	$chat = '';
    	return $chat;
    }

}
?>