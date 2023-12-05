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

    // Send mails confirming a new booking
    if ($mailInfo['mailType'] == "Booking"){
        sendBookingConfirmationMails($mail, $mailInfo);
    }

}

function sendBookingConfirmationMails(PHPMailer $mail, array $mailInfo){
    print_r($mailInfo);
    try {
        // add variables to PHPMailer about the student
        $mail->From = "noreply.bsg14@gmail.com";
        $mail->FromName = "Noreply";
        $mail->addAddress($mailInfo['studEmail'], $mailInfo['studName']);
        $mail->Subject = "Booking confirmation";

        // construct email message for student about confirmed booking
        $studMessage = "Hello " . $mailInfo['studName'] . ".\n\n";
        $studMessage .= "We have recieved your request for help from an assistant teacher. \n";
        $studMessage .= "You've chosen assistant teacher, " . $mailInfo['assistName'] . " , in " . $mailInfo['course'] . ". \n";
        $studMessage .= "The booking has been registered in the system.";
    
        // send email to student
        $mail->Body = $studMessage;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
    try {
        // add variables to PHPMailer about the assistent
        $mail->From = "noreply.bsg14@gmail.com";
        $mail->FromName = "Noreply";
        $mail->addAddress($mailInfo['assistEmail'], $mailInfo['assistName']);
        $mail->Subject = "Booking confirmation";

        // construct email message for assistant about new booking
        $assistMessage = "Hello " . $mailInfo['assistName'] . ".\n\n";
        $assistMessage .= "A student, " . $mailInfo['studName'] . " in " . $mailInfo['course'] . " has booked you for help.";
        $assistMessage .= "You can find the booking in your calendar.";
    
        // send email to assistant
        $mail->Body = $assistMessage;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

?>
