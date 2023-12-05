<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../lib/PHPMailer/src/Exception.php';
require __DIR__ . '/../lib/PHPMailer/src/PHPmailer.php';
require __DIR__ . '/../lib/PHPMailer/src/SMTP.php';


// initialize PHPMailer and add variables that should be included for all mails
function sendMails(array $mailInfo){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "noreply.bsg14@gmail.com";
    $mail->Password = "dvjkvwwjybujcnpc";
    $mail->Encoding = "base64";
    $mail->CharSet = "UTF-8";
    $mail->From = "noreply.bsg14@gmail.com";
    $mail->FromName = "Noreply";

    // Send mails confirming a new booking has been made
    if ($mailInfo['mailType'] == "booking"){
        sendBookingConfirmationMailsStudent($mail, $mailInfo);
        sendBookingConfirmationMailsAssistant($mailInfo);
    } 
    
    // send mail confirming new user account has been registered
    if ($mailInfo['mailType'] == "accountRegister"){
        sendUserRegistrationMail($mail, $mailInfo);
    }

    // send mail to assistant when student cancels booking
    if ($mailInfo['mailType'] == "studCanceledBooking"){
        sendBookingCancelationMailToAssistant($mail, $mailInfo);
    }

    // send mail to student when assistant cancels booking
    if ($mailInfo['mailType'] == "assistCanceledBooking"){
        sendBookingCancelationMailToStudent($mail, $mailInfo);
    }

    // send mail to assistant when student moves booking
    if ($mailInfo['mailType'] == "assistMovedBooking"){
        sendBookingMovedMailToStudent($mail, $mailInfo);
    }

    // send mail to student when assistant moves booking
    if ($mailInfo['mailType'] == "studMovedBooking"){
        sendBookingMovedMailToAssistant($mail, $mailInfo);
    }

}

// finalize user registration mail and send to user
function sendUserRegistrationMail(PHPMailer $mail, array $mailInfo){
    try {
        // add variables to PHPMailer about the student
        $mail->addAddress($mailInfo['userEmail'], $mailInfo['userName']);
        $mail->Subject = "New User";

        // construct email message for user about newly registered account
        $message = "Hello " . $mailInfo['userName'] . ".\n\n";
        $message .= "Your new user has been registered. \n";
        $message .= "You will now be able to log in with your e-mail and your password. \n";
        $message .= "Once you've logged in, we recommend you to go to your user profile and \n" . "add the classes you are taking. \n\n";
        $message .= "Good luck, and have fun!";
    
        // send email to new user
        $mail->Body = $message;
        $mail->send();
    } catch(Exception $exc){
        // echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

function sendBookingConfirmationMailsStudent(PHPMailer $mail, array $mailInfo){
    try {
        // add variables to PHPMailer about the student
        $mail->addAddress($mailInfo['studEmail'], $mailInfo['studName']);
        $mail->Subject = "Booking confirmation";

        // construct email message for student about confirmed booking
        $message = "Hello " . $mailInfo['studName'] . ".\n\n";
        $message .= "We have recieved your request for help from an assistant teacher. \n";
        $message .= "You've chosen assistant teacher, " . $mailInfo['assistName'] . ", in " . $mailInfo['course'] . ". \n";
        $message .= "The booking has been registered in the system.";
        
    
        // send email to student
        $mail->Body = $message;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

function sendBookingConfirmationMailsAssistant(array $mailInfo){
    try {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "noreply.bsg14@gmail.com";
        $mail->Password = "dvjkvwwjybujcnpc";
        $mail->Encoding = "base64";
        $mail->CharSet = "UTF-8";

        // add variables to PHPMailer about the assistent
        $mail->addAddress($mailInfo['assistEmail'], $mailInfo['assistName']);
        $mail->Subject = "Booking confirmation";

        // construct email message for assistant about new booking
        $message = "Hello " . $mailInfo['assistName'] . ".\n\n";
        $message .= "A student, " . $mailInfo['studName'] . " in " . $mailInfo['course'] . " has booked you for help.\n";
        $message .= "You can find the booking in your calendar.";
    
        // send email to assistant
        $mail->Body = $message;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

function sendBookingCancelationMailToStudent(PHPMailer $mail, array $mailInfo){
    try {
        // add variables to PHPMailer about the student
        $mail->addAddress($mailInfo['studEmail'], $mailInfo['studName']);
        $mail->Subject = "Booking canceled";

        // construct email message for student about confirmed booking
        $message = "Hello " . $mailInfo['studName'] . ".\n\n";
        $message .= "One of your bookings in " . $mailInfo['course'] . ", \n";
        $message .= "Yhas been canceled by the assistant, " . $mailInfo['assistName'] . ". \n";
        $message .= ""; // ADD BOOKING INFO HERE
        
    
        // send email to student
        $mail->Body = $message;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

function sendBookingCancelationMailToAssistant(PHPMailer $mail, array $mailInfo){
    try {
        // add variables to PHPMailer about the student
        $mail->addAddress($mailInfo['assistEmail'], $mailInfo['assistName']);
        $mail->Subject = "Booking canceled";

        // construct email message for student about confirmed booking
        $message = "Hello " . $mailInfo['assistName'] . ".\n\n";
        $message .= $mailInfo['studName'] . "has moved one of their bookings in " . $mailInfo['course'] . ". \n";
        $message .= ""; // ADD BOOKING INFO HERE
        
    
        // send email to student
        $mail->Body = $message;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

function sendBookingMovedMailToStudent(PHPMailer $mail, array $mailInfo){
    try {
        // add variables to PHPMailer about the student        
        $mail->addAddress($mailInfo['studEmail'], $mailInfo['studName']);
        $mail->Subject = "Booking moved";

        // construct email message for student about confirmed booking
        $message = "Hello " . $mailInfo['studName'] . ".\n\n";
        $message .= $mailInfo['assistName'] . " has moved one of your bookings in " . $mailInfo['course'] . ". \n";
        $message .= ""; // ADD BOOKING INFO HERE
        
    
        // send email to student
        $mail->Body = $message;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

function sendBookingMovedMailToAssistant(PHPMailer $mail, array $mailInfo){
    try {
        // add variables to PHPMailer about the student
        $mail->addAddress($mailInfo['assistEmail'], $mailInfo['assistName']);
        $mail->Subject = "Booking moved";

        // construct email message for student about confirmed booking
        $message = "Hello " . $mailInfo['assistName'] . ".\n\n";
        $message .= $mailInfo['studName'] . " has moved one of their bookings in " . $mailInfo['course'] . ". \n";
        $message .= ""; // ADD BOOKING INFO HERE
        
    
        // send email to student
        $mail->Body = $message;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

?>
