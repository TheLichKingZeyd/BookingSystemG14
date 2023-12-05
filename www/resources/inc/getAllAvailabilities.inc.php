<?php

$_messageOutput['message'] = "";
$date_now = date("Y-m-d h:m:s");
$int = "";
//retrieves all availabilities related to an assistant using a UserID

function getAllAvailabilities($userID, $pdo) {

    $sql = "SELECT AvailabilityStart, AvailabilityEnd, AvailabilityID  
    FROM Availabilities 
    WHERE AssistantID=?";

 
    $querry = $pdo->prepare($sql);
    $querry->execute([$userID]);
 
    if ($querry->rowCount() > 0) {
         $user = $querry->fetchAll();
         return $user;
    }else {
        $user = [];
        return $user;
    }
}


















?>