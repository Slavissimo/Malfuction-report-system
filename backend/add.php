<?php

require '../config/config.php';
require '../backend/loggedinstatus.php';
require '../backend/loginconfirm.php';
require '../backend/PHPMailer/src/PHPMailer.php';
require '../backend/PHPMailer/src/SMTP.php';
require '../backend/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Mailer = "smtp";
$mail->Host = "";
$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Port = "465";
$mail->Username = "";
$mail->Password = "";
$mail->IsHTML(true);

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
    $mailrecipt = "SELECT users.email FROM users LEFT JOIN classrooms_admins ON users.id = classrooms_admins.user_id LEFT JOIN classrooms on classrooms.id = classrooms_admins.classroom_id WHERE users.id = classrooms_admins.user_id AND classrooms.id = $id";
    $mailque = mysqli_query($conn, $mailrecipt);
    $patch = mysqli_fetch_array($mailque);

    $mail->Subject = "New report in your classroom";
    $mail->setFrom("");
    $mail->Body = "There is a new report in your classroom ".$classrooms." <br>You should check it out!";
    $mail->addAddress($patch['email']);
    if ($mail->Send()) {
        $_SESSION['messageSuccess'] = "Your report has been submited and email was sent";
        header("Location: ../frontend/reports.php");
        exit(0);
    } else {
        $_SESSION['messageDanger'] = "Your report has been submited however a mail was not sent";
        header("Location: ../frontend/reports.php");
        exit(0);
    }
}
if(isset($_POST['add'])){
    $id = $_POST['teacher'];
    $classnum = $_POST['classnum'];
    $addclass = "INSERT INTO classrooms (number) VALUES ($classnum)";
    $add = mysqli_query($conn,$addclass);
    $getidofclass = "SELECT classrooms.id FROM classrooms WHERE number = $classnum";
    $result = mysqli_query($conn, $getidofclass);
    $numpre = mysqli_fetch_array($result);
    $num = $numpre['id'];
    $addadmin = "INSERT INTO classrooms_admins (user_id, classroom_id) VALUES ($id,$num)";
    $queue = mysqli_query($conn, $addadmin);
    if($queue){
        $_SESSION['messageSuccess'] = "Admin and classroom added!";
        header("Location: ../frontend/admin_classrooms.php");
    }
    else{
        $_SESSION['messageDanger'] = "Admin and classroom not added!";
        header("Location: ../frontend/admin_classrooms.php");
    }
}
if(isset($_POST['add_user'])){
    $fname = $_POST['meno'];
    $lname = $_POST['priezvisko'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $password = password_hash($pass, PASSWORD_BCRYPT);
    $adduser = "INSERT INTO users (fname, lname, email, username, password_hash) VALUES ('$fname', '$lname', '$email', '$username', '$password')";
    $query = mysqli_query($conn, $adduser);
    if($query){
        $_SESSION['messageSuccess'] = "Admin added!";
        header("Location: ../frontend/admin_users.php");
    }
    else{
        $_SESSION['messageDanger'] = "Admin not added!";
        header("Location: ../frontend/admin_users.php");
    }
}
?>