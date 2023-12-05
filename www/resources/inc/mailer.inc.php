<?php

use PHPMailer\PHPMailer\PHPMailer;

include_once __DIR__ . '/../lib/booking.lib.php';
include_once __DIR__ . '/../lib/PHPMailer/src/Exception.php';
include_once __DIR__ . '/../lib/PHPMailer/src/PHPmailer.php';
include_once __DIR__ . '/../lib/PHPMailer/src/SMTP.php';

function sendMails(array $mailInfo){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "noreply.bsg14@gmail.com";
    $mail->Password = "hsqzespyrnhkesvn";
    if ($mailInfo['mailType'] == "Booking"){
        sendBookingConfirmationMails($mail, $mailInfo);
    }

}



function sendBookingConfirmationMails(PHPMailer $mail, array $mailInfo){
    try {
        $mail->From = "noreply.bsg14@gmail.com";
        $mail->FromName = "Noreply";
        $mail->addAddress($mailInfo['studEmail'], $mailInfo['studName']);
        $mail->Subject = "Booking confirmation";

        $studMessage = "Hello " . $mailInfo['studName'] . ".<br><br>";
        $studMessage .= "We have recieved your request for help from an assistant teacher. <br>br>";
        $studMessage .= "You've chosen assistant teacher, " . $mailInfo['assistName'] . " , in " . $mailInfo['course'] . ". <br>";
        $studMessage .= "The booking has been registered in the system.";
    
        $mail->Body = $studMessage;
        $mail->send();
    } catch(Exception $exc){
        echo "<script>window.location.href = 'booking.php'; alert('Mail not sent'" . $exc->getMessage() . ")</script>";
    }
}

?>