<?php

//Includes
include_once __DIR__ . '/../lib/validator.lib.php';
$_messageOutput['message'] = "";

// If POST
if(isset($_POST['update_user_data'])) {

    // Clean data and pass into variables
    $firstNameEdit = test_input($_POST['editFirstName']);
    $lastNameEdit = test_input($_POST['editLastName']);
    $emailEdit = test_input($_POST['editEmail']);
    $expEdit = test_input($_POST['editExp']);

    try {
        // QUERY DATABASE TO UPDATE USER INFORMATION
        $query = "UPDATE users SET FirstName=:firstname, LastName=:lastname, Email=:email WHERE UserID=$userID";
        $query2 = "SELECT * FROM profileinfo WHERE UserID=$userID";

        // Prepare the statements
        $statement = $pdo->prepare($query);
        $statement2 = $pdo->prepare($query2);

        // Pass variables into data
        $data = [
            ':firstname' => $firstNameEdit,
            ':lastname' => $lastNameEdit,
            ':email' => $emailEdit
        ];
        $data2 = [
            ':info' => $expEdit
        ];

        // Excecute and pass data into database
        $execute = $statement->execute($data);
        $statement2->execute();

        // IF user exists in profileinfo table update, if first time entry insert
        if($statement2->rowCount() == 1){
            $query3 = "UPDATE profileinfo SET ProfileExperience=:info WHERE UserID=$userID";
            $statement3 = $pdo->prepare($query3);
            $execute3 = $statement3->execute($data2);
        } else {
            $query4 = "INSERT INTO profileinfo (UserID, ProfileExperience) VALUES ('$userID', '$expEdit')";
            $statement4 = $pdo->prepare($query4);
            $execute4 = $statement4->execute();
        }
        
        // If they passed send back
        if($execute && $execute3)
        {
            $_messageOutput['message'] ="Profile was updated";
            //echo "<script>alert('Updated');</script>";
        }
        else if ($execute4) {
            $_messageOutput['message'] ="Inforamtion was inserted";
            //echo "<script>alert('Inserted');</script>";
        }
        else
        {
            $_messageOutput['message'] ="An error occured";
            //echo "<script>alert('Error');</script>";
        }

    } catch (PDOException) {
    }
}

// If POST
if(isset($_POST['update_user_password'])) {

    // Start new validator
    $validator = new Validator;
    // Clean data and pass into variables
    $oldPassword = test_input($_POST['editOldPassword']);
    $newPassword = test_input($_POST['editNewPassword']);

    // Fetch user information
    $fetchUser = "SELECT * FROM users WHERE UserID=$userID";
    $q = $pdo->prepare($fetchUser);
    
    // Execute
    try {
        $q->execute();
    } catch(PDOException){
    }
    
    // Fetch object
    $user = $q->fetch(PDO::FETCH_OBJ);

    // If one instance in row
    if($q->rowCount() == 1){
        if (password_verify($oldPassword, $user->Password)){ //verify that password matches the database
            if ($validator->validatePassword($newPassword)){ //verify that the password is strong enough
                $hashedPass = password_hash($newPassword, PASSWORD_DEFAULT); //hash the password
                $passQuery = "UPDATE users SET Password='$hashedPass' WHERE UserID='$userID'"; //sql
                $passtatement = $pdo->prepare($passQuery);
                $passtatement->execute();
                $_messageOutput['message'] ="Password changed successfully"; //success message
            } else {
                $_messageOutput['message'] ="Password is too weak"; //password failed validation
            }
        } else {
            $_messageOutput['message'] ="Old password wrong"; //password failed password verify
        }
    } else {
        $_messageOutput['message'] ="Could not connect to database"; //could not find entry in database
    }
}

// Clean data
function test_input($data) {
    $data = trim($data);  
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>