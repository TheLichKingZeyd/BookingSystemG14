<?php

//Includes
include_once __DIR__ . '/../lib/validator.lib.php';
$_messageOutput['message'] = "";

// If POST update user data
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

// If POST update user password
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

// If POST update courses
if(isset($_POST['update_course_access'])) {

    // DELETE COURSEACCESS
    if(!empty($_POST['delete'])) {
        foreach($_POST['delete'] as $courseID) {
            $courseQuery = "DELETE FROM courseaccess WHERE UserID='$userID' AND CourseID='$courseID'"; //sql
            $cq = $pdo->prepare($courseQuery);

            // Execute
            try {
                $cq->execute();
            } catch(PDOException){
                $_messageOutput['message'] ="Something Failed";
            }
        }
    }

    // ADD COURSEACCESS
    if(!empty($_POST['insert'])) {
        foreach($_POST['insert'] as $insertCourseID) {
            $courseQuery2 = "INSERT INTO courseaccess (CourseID, UserID, AsAssistant) VALUES ('$insertCourseID','$userID','0') "; //sql
            $cq2 = $pdo->prepare($courseQuery2);

            // Execute
            try {
                $cq2->execute();
            } catch(PDOException){
                $_messageOutput['message'] ="Something Failed";
            }
        }
    }

    // ADD TEACHING ASSISTANT
    if(!empty($_POST['addAssistant'])) {
        foreach($_POST['addAssistant'] as $addCID) {
            $courseQuery3 = "UPDATE courseaccess SET AsAssistant=1 WHERE UserID='$userID' AND CourseID='$addCID'"; //sql
            $cq3 = $pdo->prepare($courseQuery3);

            // Execute
            try {
                $cq3->execute();
            } catch(PDOException){
                $_messageOutput['message'] ="Something Failed";
            }
        }
    }

    // REMOVE TEACHING ASSISTANT
    if(!empty($_POST['removeAssistant'])) {
        foreach($_POST['removeAssistant'] as $removeCID) {
            $courseQuery4 = "UPDATE courseaccess SET AsAssistant=0 WHERE UserID='$userID' AND CourseID='$removeCID'"; //sql
            $cq4 = $pdo->prepare($courseQuery4);

            // Execute
            try {
                $cq4->execute();
            } catch(PDOException){
                $_messageOutput['message'] ="Something Failed";
            }
        }
    }
}

// If POST
if(isset($_POST['update_allow_email'])) {

    // Query for updateing AllowEmail to allow
    $emailQuery = "UPDATE users SET AllowEmail=1 WHERE UserID=$userID";
    $e = $pdo->prepare($emailQuery);

    // Execute
    try {
        $e->execute();
    } catch(PDOException){
        $_messageOutput['message'] ="Something Failed";
    }
}

// If POST
if(isset($_POST['update_disallow_email'])) {

    // Query for updateing AllowEmail to not allow
    $emailQuery2 = "UPDATE users SET AllowEmail=0 WHERE UserID=$userID";
    $e2 = $pdo->prepare($emailQuery2);

    // Execute
    try {
        $e2->execute();
    } catch(PDOException){
        $_messageOutput['message'] ="Something Failed";
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