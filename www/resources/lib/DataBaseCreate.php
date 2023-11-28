<?php

// Global variables

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "BSG14";

//end of global variables





try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // $SQL contains SQL code that is executed with exec()
  //Tables might need revisits as I have a lot of doubts regarding these unholy abominations that I created
  // calendar can be both used for booking and to when a TA would be available 
  // open this link to build the database
  //            http://localhost/BookingSystemG14/www/resources/lib/DataBaseCreate.php
  $sql = "CREATE TABLE IF NOT EXISTS User (
  UserID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  IsStaff BOOLEAN NOT NULL,
  ProfilePicture LONGBLOB,
  email VARCHAR(50) NOT NULL,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
  CREATE TABLE IF NOT EXISTS Thread (
    ThreadID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
  );
  CREATE TABLE IF NOT EXISTS Message (
    MsgID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    MsgTimeStamp DATETIME,
    ThreadID INT UNSIGNED NOT NULL,
    SenderID INT UNSIGNED NOT NULL,
    CONSTRAINT FK_MessageThreadID FOREIGN KEY (ThreadID) REFERENCES Thread(ThreadID) ON DELETE CASCADE,
    CONSTRAINT FK_MessageSenderID FOREIGN KEY (SenderID) REFERENCES User(UserID) ON DELETE CASCADE
  );
  CREATE TABLE IF NOT EXISTS ThreadAccess (
    ThreadID INT UNSIGNED NOT NULL ,  
    ParticipantID INT UNSIGNED NOT NULL,
    CONSTRAINT FK_AccessThreadID FOREIGN KEY (ThreadID) REFERENCES Thread(ThreadID) ON DELETE CASCADE,
    CONSTRAINT FK_AccessParticipantID FOREIGN KEY (ParticipantID) REFERENCES User(UserID) ON DELETE CASCADE

  );
  CREATE TABLE IF NOT EXISTS CALENDAR (
    SessionID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    SessionStart DATETIME NOT NULL,
    SessionEnd DATETIME NOT NULL,
    SessionDescr VARCHAR(1000) DEFAULT 'No-Description',
    CreatorID INT UNSIGNED NOT NULL,
    SessionTitle VARCHAR (150) NOT NULL,
    CONSTRAINT FK_CalendarCreaterID FOREIGN KEY (CreatorID) REFERENCES User(UserID) ON DELETE CASCADE



  );
";

  // the code inside $SQL will be executed and a message will pop up letting us know that it has be succesfful incase of errors
  //the $sql will be printed out, in addition to an error message.
  //might need changes so we don't create new tables everytime the server is launched.
  //This Frankenstein solution is not the best, but it'll do for now, could revisit later for more readable errors.
  $conn->exec($sql);
  echo "Tables created successfully without errors";
} catch(PDOException $e) {
  echo $sql . "<br><br><br>" . $e->getMessage();
}

$conn = null;

?>