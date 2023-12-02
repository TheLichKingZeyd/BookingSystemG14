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
  CREATE TABLE IF NOT EXISTS Threads (
    ThreadID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
  );
  CREATE TABLE IF NOT EXISTS Messages (
    MsgID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    MsgTimeStamp DATETIME,
    ThreadID INT UNSIGNED NOT NULL,
    SenderID INT UNSIGNED NOT NULL,
    CONSTRAINT FK_MessageThreadID FOREIGN KEY (ThreadID) REFERENCES Threads(ThreadID) ON DELETE CASCADE,
    CONSTRAINT FK_MessageSenderID FOREIGN KEY (SenderID) REFERENCES Users(UserID) ON DELETE CASCADE
  );
  CREATE TABLE IF NOT EXISTS ThreadAccess (
    ThreadID INT UNSIGNED NOT NULL ,  
    ParticipantID INT UNSIGNED NOT NULL,
    CONSTRAINT FK_AccessThreadID FOREIGN KEY (ThreadID) REFERENCES Threads(ThreadID) ON DELETE CASCADE,
    CONSTRAINT FK_AccessParticipantID FOREIGN KEY (ParticipantID) REFERENCES Users(UserID) ON DELETE CASCADE

  );
  CREATE TABLE IF NOT EXISTS Courses (
    CourseID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    CourseCode VARCHAR(50) Not NULL,
    CourseName VARCHAR(150) NOT NULL
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
    CONSTRAINT FK_CalendarCreaterID FOREIGN KEY (CreatorID) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_BookingAssistantID FOREIGN KEY (AssistantID) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_BookingCourseID FOREIGN KEY (CourseID) REFERENCES Courses(CourseID) ON DELETE CASCADE

  );
  CREATE TABLE IF NOT EXISTS Availabity(
    AvailibilityID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    AvailibilityStart DATETIME,
    AvailibilityEnd DATETIME,
    AssistantID INT UNSIGNED NOT NULL,
    CONSTRAINT FK_AvailibilityUserID FOREIGN KEY (AssistantID) REFERENCES Users(UserID) ON DELETE CASCADE
  );
  CREATE TABLE IF NOT EXISTS CourseAccess(
    CourseID INT UNSIGNED NOT NULL,
    UserID INT UNSIGNED NOT NULL,
    CONSTRAINT FK_AccessUserID FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
    CONSTRAINT FK_AccessCourseID FOREIGN KEY (CourseID) REFERENCES Courses(CourseID) ON DELETE CASCADE
  )
  CREATE TABLE IF NOT EXISTS ProfileInfo(
    UserID INT UNSIGNED NOT NULL,
    ProfileExperience VARCHAR(256)
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
