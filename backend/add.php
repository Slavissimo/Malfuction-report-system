<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'https://ticketsystemspseke.sk/web/config/config.php';
require 'https://ticketsystemspseke.sk/web/backend/loggedinstatus.php';
require 'https://ticketsystemspseke.sk/web/backend/loginconfirm.php';
require 'https://ticketsystemspseke.sk/web/backend/PHPMailer/src/PHPMailer.php';
require 'https://ticketsystemspseke.sk/web/backend/PHPMailer/src/SMTP.php';
require 'https://ticketsystemspseke.sk/web/backend/PHPMailer/src/Exception.php';

if(isset($_POST['send'])) {
    $classrooms = $_POST['inputClassroom'];
    $pcnumber = $_POST['ComputerNumber'];
    $description = $_POST['Description'];
    $date = date('Y-m-d H:i:s');
    $suid = $_SESSION['userid'];
    $classrooms = (int)$classrooms;
    $cislo = "SELECT classrooms.id FROM classrooms WHERE number = $classrooms";
    $sql = mysqli_query($conn, $cislo);
    $fetch = mysqli_fetch_array($sql);
    $id = $fetch['id'];
    $query = "INSERT INTO reports (classroom_id, pcnumber, message, user_id, date_of_report) VALUES ('$id', '$pcnumber', '$description', '$suid','$date')";
    $result = mysqli_query($conn, $query);
    $mailrecipt = "SELECT users.email FROM users LEFT JOIN classrooms_admins ON users.id = classrooms_admins.user_id LEFT JOIN classrooms ON classrooms.id=classrooms_admins.classroom_id WHERE classrooms_admins.user_id = $suid";
    $mailque = mysqli_query($conn, $mailrecipt);
    $patch = mysqli_fetch_array($mailque);

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Mailer = "smtp";
    $mail->Host = "mail.ticketsystemspseke.sk";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "salysaloncuk@gmail.com";
    $mail->Password = "vrdwfxoraxbwgvgy";
    $mail->IsHTML(true);
    $mail->Subject = "New report in your classroom";
    $mail->setFrom("salysaloncuk@gmail.com");
    $mail->Body = "There is a new report in your classroom. 
    You should check it out!";
    $mail->addAddress($patch['email']);
    if ($mail->Send()) {
        smtpClose();
        header("Location: https://ticketsystemspseke.sk/web/frontend/reports.php");
        exit(0);
        // email sent successfully
    } else {
        // email sending failed
        $_SESSION['messageDanger'] = "Mailer Error: " . $mail->ErrorInfo;
        header("Location: https://ticketsystemspseke.sk/web/frontend/reports.php");
        exit(0);
    }
}
if(isset($_POST['add'])){

}


?>