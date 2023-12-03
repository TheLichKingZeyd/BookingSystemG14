<?php
// THIS FILE IS NOT CURRENTLY USED
// THIS IS FOR POTENTIAL STATUS ON MESSAGES

// Start session
session_start();
include("session.inc.php");

// RUN only if user is logged in 
if (isset($userID)) {

	if (isset($_POST['id_2'])) {

	$id_1  = $userID;
	$id_2  = $_POST['id_2'];

	$sql = "SELECT * FROM chats
	        WHERE To_id=?
	        AND   From_id= ?
	        ORDER BY Chat_ID ASC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id_1, $id_2]);

	if ($stmt->rowCount() > 0) {
	    $chats = $stmt->fetchAll();

	    // Looping through
	    foreach ($chats as $chat) {
	            ?>
                  <p class="ltext border 
					        rounded p-2 mb-1">
					    <?=$chat['Content']?> 
					    <small class="d-block">
					    	<?=$chat['MsgTimeStamp']?>
					    </small>      	
				  </p>    
	            <?php
	    }
	}

 }

}else {
	header("Location: messages.php");
	exit;
}

?>