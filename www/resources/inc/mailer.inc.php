<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../lib/PHPMailer/src/Exception.php';
require __DIR__ . '/../lib/PHPMailer/src/PHPmailer.php';
require __DIR__ . '/../lib/PHPMailer/src/SMTP.php';

include_once __DIR__ . '/../lib/booking.lib.php';
//include_once __DIR__ . '/../lib/PHPMailer/src/Exception.php';
//include_once __DIR__ . '/../lib/PHPMailer/src/PHPmailer.php';
//include_once __DIR__ . '/../lib/PHPMailer/src/SMTP.php';


// initialize PHPMailer and add variables that should be included for all mails
function sendMails(array $mailInfo){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "noreply.bsg14@gmail.com";
    $mail->Password = "viioirzzdspumbob";

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
        $studMessage = "Hello " . $mailInfo['studName'] . ".<br><br>";
        $studMessage .= "We have recieved your request for help from an assistant teacher. <br>br>";
        $studMessage .= "You've chosen assistant teacher, " . $mailInfo['assistName'] . " , in " . $mailInfo['course'] . ". <br>";
        $studMessage .= "The booking has been registered in the system.";
    
        // send email to student
        $mail->Body = $studMessage;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

?>