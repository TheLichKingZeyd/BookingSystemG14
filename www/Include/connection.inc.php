<?php
//Connection for database
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "bookingsystem";
$conn = new mysqli($servername, $username, $password, $db_name, 3306);

//Check if connection failed or succeeded
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
} else {
    echo "DB Connection: Success";
}

?>