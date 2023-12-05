<?php 

// Get all chats where session id and user_2 id match
// Runs pdo to connect to database and returns in array
function getChats($id_1, $id_2, $pdo){
   
   $sql = "SELECT * FROM chats
           WHERE (From_id=? AND To_id=?)
           OR    (To_id=? AND From_id=?)
           ORDER BY Chat_ID ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_1, $id_2, $id_1, $id_2]);

    if ($stmt->rowCount() > 0) {
    	$chats = $stmt->fetchAll();
    	return $chats;
    }else {
    	$chats = [];
    	return $chats;
    }

}

?>