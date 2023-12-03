<?php

// Start session
session_start();

// Include
include("resources/inc/login.inc.php");
include("resources/inc/language.inc.php");
include("resources/inc/session.inc.php");

// If user is logged in
if (isset($_SESSION['userID'])) {

	include 'resources/inc/chat.inc.php';
    include 'resources/inc/user.inc.php';
	
	// If user is not set in the header
	if (!isset($_GET['user'])) {
  		header("Location: message.php");
  		exit;
  	}

  	// get user data (who we are messeging)
  	$chatWith = getUser($_GET['user'], $pdo);

	// If no return exit
  	if (empty($chatWith)) {
  		header("Location: messages.php");
  		exit;
  	}

	// Get chatlog with current session user and second user
  	$chats = getChats($_SESSION['userID'], $chatWith['UserID'], $pdo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Chatroom</title>
</head>
<body>

    <div class="w-400 shadow p-4 rounded">
    	<a href="messages.php" class="fs-4 link-dark"><?= __('exit')?></a>
		
		<div class="d-flex align-items-center">
			<h3 class="display-4 fs-sm m-2"><?=$chatWith['FirstName'] ." ".$chatWith['LastName']?> <br></h3>
		</div>
		<!--CHATBOX-->
		<div class="shadow p-4 rounded d-flex flex-column mt-2 chat-box" id="chatBox">
			<?php 
			// If chat is not empty, write messages out
			if (!empty($chats)) {
				foreach($chats as $chat){
					// If from id is current session id, display on the right
					if($chat['From_id'] == $_SESSION['userID'])
					{ ?>
					<p class="rtext align-self-end border rounded p-2 mb-1" style="background-color: lightblue;">
						<?=$chat['Content']?>
						<small class="d-block">
							<?=$chat['MsgTimeStamp']?>
						</small>
					</p>
                    <?php }
					// If from id is second user, display on the left
					else{ ?>
						<p class="ltext align-self-start border rounded p-2 mb-1">
							<?=$chat['Content']?> 
					    	<small class="d-block">
					    	<?=$chat['MsgTimeStamp']?>
					    	</small>	
						</p>
                    	<?php } 
					}
					
					// If no chat messages, display
					}else{ ?>
					<div class="alert alert-info text-center">
						<i class="fa fa-comments d-block fs-big"></i> <?= __('No messages yet, Start the conversation')?>
					</div>
					<?php } ?>
				</div>
				<!--INPUT FIELD -->
				<div class="input-group mb-3">
					<textarea cols="3" id="content" class="form-control"></textarea>
					<button class="btn btn-primary" id="sendBtn">
						<i class="fa fa-send-o"></i>
					</button>
				</div>
	</div>
	
	<!--SCRIPT FOR SCROLL, BUTTON SUBMIT -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

	var scrollDown = function() {
		let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
	}

	scrollDown();

	$(document).ready(function(){
      
      $("#sendBtn").on('click', function(){
      	content = $("#content").val();
      	if (content == "") return;

      	$.post("resources/inc/sendChat.inc.php",
      		   {
      		   	content: content,
      		   	to_id: <?=$chatWith['UserID']?>
      		   },
      		   function(data, status){
                  $("#content").val("");
                  $("#chatBox").append(data);
                  scrollDown();
      		   });
      });

	/*
	  // auto refresh / reload
      let fechData = function(){
      	$.post("resources/inc/getAllMessages.inc.php",
      		   {
      		   	id_2: <?=$chatWith['UserID']?>
      		   },
      		   function(data, status){
                  $("#chatBox").append(data);
                  if (data != "") scrollDown();
      		    });
      }

      fechData();

      auto update last seen 
      every 0.5 sec
      setInterval(fechData, 1000);
	*/
    
    });
</script>
</body>
</html>
<?php
  }
  // If user is not logged in
  else{
  	header("Location: messages.php");
   	exit;
  }
 ?>