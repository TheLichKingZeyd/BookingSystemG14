<?php 

// Start session
session_start();
include("session.inc.php");

// Check if user is logged in, else return back to message site
if (isset($userID)) {

	if (isset($_POST['content']) &&
        isset($_POST['to_id'])) {

	// Get data from post and store them in variables
	$content = $_POST['content'];
	$to_id = $_POST['to_id'];

	// Session ID
	$from_id = $userID;

	$sql = "INSERT INTO 
	       chats (From_id, To_id, Content)
	       VALUES (?, ?, ?)";
	$stmt = $pdo->prepare($sql);
	$res  = $stmt->execute([$from_id, $to_id, $content]);
    
    // IF excecution went right, display our message to the user
    if ($res) {
       $sql2 = "SELECT * FROM conversations
               WHERE (User_1=? AND User_2=?)
               OR    (User_2=? AND User_1=?)";
       $stmt2 = $pdo->prepare($sql2);
	   $stmt2->execute([$from_id, $to_id, $from_id, $to_id]);
	   $time = date("Y-m-d h:i:s");
	   
	   // For first time message, insert into our conversation table, with User1 and User2
	   if ($stmt2->rowCount() == 0 ) { 
		$sql3 = "INSERT INTO conversations(User_1, User_2) VALUES (?,?)";
		$stmt3 = $pdo->prepare($sql3); 
		$stmt3->execute([$from_id, $to_id]);
		}
		?>
		<p class="rtext align-self-end border rounded p-2 mb-1" style="background-color: lightblue;">
			<?=$content?>
			<small class="d-block">
			<?=$time?>
			</small>
		</p>

    <?php 
     }
  }
}else {
	header("Location: messages.php");
	exit;
}

?>