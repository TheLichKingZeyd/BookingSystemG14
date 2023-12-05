<?php

// Global variables

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bsg14";

//end of global variables





try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // $SQL string contains The SQL script that is executed with exec() through the database connection thanks to PDO
  //Tables might need revisits as I have a lot of doubts regarding these unholy abominations that I created
  // calendar can be both used for booking and to when a TA would be available 
  // open this link to build the database
  //            http://localhost/BookingSystemG14/www/resources/lib/DataBaseCreate.php
  $sql = "CREATE TABLE IF NOT EXISTS Users (
  UserID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  IsAssistant BOOLEAN NOT NULL,
  Password VARCHAR(256) NOT NULL,
  AllowEmail BOOLEAN DEFAULT 1

  );
  CREATE TABLE IF NOT EXISTS Conversations (
    Conversation_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    User_1 INT UNSIGNED NOT NULL,
    User_2 INT UNSIGNED NOT NULL,
    CONSTRAINT FK_UserOneID FOREIGN KEY (User_1) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_UserTwoID FOREIGN KEY (User_2) REFERENCES Users(UserID) ON DELETE CASCADE
  );
  CREATE TABLE IF NOT EXISTS Chats (
    Chat_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    From_id INT UNSIGNED NOT NULL,
    To_id INT UNSIGNED NOT NULL,
    Content TEXT NOT NULL,
    MsgTimeStamp DATETIME NOT NULL DEFAULT current_timestamp(),
    CONSTRAINT FK_MessageRecieverID FOREIGN KEY (To_id) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_MessageSenderID FOREIGN KEY (From_id) REFERENCES Users(UserID) ON DELETE CASCADE
  );
  CREATE TABLE IF NOT EXISTS Courses (
    CourseID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    CourseCode VARCHAR(50) Not NULL,
    CourseName VARCHAR(150) NOT NULL,
    CourseNameNo VARCHAR(150) NOT NULL
  );
  CREATE TABLE IF NOT EXISTS Bookings (
    BookingID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    CourseID INT UNSIGNED NOT NULL,
    BookingStart DATETIME NOT NULL,
    BookingEnd DATETIME NOT NULL,
    BookingDescr VARCHAR(1000) DEFAULT 'No-Description',
    CreatorID INT UNSIGNED NOT NULL,
    BookingTitle VARCHAR (150) NOT NULL,
    AssistantID INT UNSIGNED NOT NULL,
    BookingStatus BOOLEAN DEFAULT 1,
    CONSTRAINT FK_CalendarCreaterID FOREIGN KEY (CreatorID) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_BookingAssistantID FOREIGN KEY (AssistantID) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_BookingCourseID FOREIGN KEY (CourseID) REFERENCES Courses(CourseID) ON DELETE CASCADE

  );
  CREATE TABLE IF NOT EXISTS Availabilities(
    AvailabilityID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    AvailabilityStart DATETIME,
    AvailabilityEnd DATETIME,
    AssistantID INT UNSIGNED NOT NULL,
    CONSTRAINT FK_AvailibilityUserID FOREIGN KEY (AssistantID) REFERENCES Users(UserID) ON DELETE CASCADE
  );
  CREATE TABLE IF NOT EXISTS CourseAccess(
    CourseID INT UNSIGNED NOT NULL,
    UserID INT UNSIGNED NOT NULL,
    AsAssistant BOOLEAN NOT NULL,
    CONSTRAINT FK_AccessUserID FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_AccessCourseID FOREIGN KEY (CourseID) REFERENCES Courses(CourseID) ON DELETE CASCADE
  );
  CREATE TABLE IF NOT EXISTS ProfileInfo(
    UserID INT UNSIGNED NOT NULL,
    ProfileExperience VARCHAR(256),
    CONSTRAINT FK_ProfileUserID FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
  )
  

";

  //  $SQL will be executed and a message will pop up letting us know that it has been succesfful incase of errors
  //the $sql script will be printed out, in addition to an error message.
  //might need changes tables are dropped before creation, seeding also needs to be added soon.
  //This Frankenstein solution is not the best, but it'll do for now, could revisit later for more readable errors.
  $conn->exec($sql);
  echo "Tables created successfully without errors";
} catch(PDOException $e) {
  echo $sql . "<br><br><br>" . $e->getMessage();
}

$conn = null;

?>
