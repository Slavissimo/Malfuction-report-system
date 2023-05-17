<?php
require 'config/config.php';
require 'loggedinstatus.php';
require 'loginconfirm.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

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

if(isset($_POST['update'])){
    $status = $_POST['reportStatus'];
    $id = $_POST['report_id'];
    $search = "SELECT classroom_id, date_of_completion, report_status FROM reports WHERE id = '$id'";
    $look = mysqli_query($conn, $search);
    $fix = mysqli_fetch_array($look);
    if($fix['report_status'] == 3 || $fix['report_status'] == 4 && $fix['date_of_completion'] != True){
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE reports SET report_status = '$status', date_of_completion = '$date'  WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
    }
    else{
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE reports SET report_status = '$status', date_of_completion = '$date'  WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $mailrecipt = "SELECT users.email FROM users LEFT JOIN reports ON users.id = reports.user_id WHERE reports.id = '$id'";
        $mailque = mysqli_query($conn, $mailrecipt);
        $patch = mysqli_fetch_array($mailque);
        $class_id = $fix['classroom_id'];
        $classfind = "SELECT number FROM classrooms WHERE id=$class_id";
        $take = mysqli_query($conn, $classfind);
        $classformat = mysqli_fetch_array($take);

        $mail->Subject = "State of your report has been changed!";
        $mail->setFrom("");
        $mail->Body = "Your report in classroom ".$classformat['number']." has been closed!";
        $mail->addAddress($patch['email']);
        if($mail->Send()){
            $_SESSION['messageSuccess'] = "Report updated and mail was sent!";
        }
        else{
            $_SESSION['messageDanger'] = "Report updated but email was not sent!". $mail->ErrorInfo;
        }
    }
    header("Location: ../classrooms.php");
}
if(isset($_POST['notesubmit'])){
    $note = $_POST['notes'];
    $classRoom = $_POST['classRoom'];
    $queue = "UPDATE classrooms SET note='$note' WHERE number='$classRoom'";
    $result = mysqli_query($conn, $queue);
    header("Location: ../classrooms.php");
}
if(isset($_POST['edit'])){
    $uid = $_POST['teacher'];
    $classid = $_GET['id'];
    $update = "UPDATE classrooms_admins SET user_id = '$uid' WHERE classroom_id = $classid";
    $send = mysqli_query($conn, $update);
    if($send){
        $_SESSION['messageSuccess'] = "Admin changed!";
        header("Location: ../admin_classrooms.php");
    }
    else{
        $_SESSION['messageDanger'] = "Admin not changed!";
        header("Location: ../admin_classrooms.php");
    }
}
if(isset($_POST['admin_update'])){
    $status = $_POST['reportStatus'];
    $id = $_POST['report_id'];
    $search = "SELECT classroom_id, date_of_completion, report_status FROM reports WHERE id = '$id'";
    $check = mysqli_query($conn, $search);
    $qfix = mysqli_fetch_array($check);
    if($qfix['report_status'] == 3 || $qfix['report_status'] == 4 && is_null($qfix['date_of_completion']) != True){
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE reports SET report_status = '$status', date_of_completion = '$date'  WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
    }
    else{
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE reports SET report_status = '$status', date_of_completion = '$date'  WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $mailrecipt = "SELECT users.email FROM users LEFT JOIN reports ON users.id = reports.user_id WHERE reports.id = '$id'";
        $mailque = mysqli_query($conn, $mailrecipt);
        $patch = mysqli_fetch_array($mailque);
        $adminclass_id = $fix['classroom_id'];
        $adminclassfind = "SELECT number FROM classrooms WHERE id=$adminclass_id";
        $take = mysqli_query($conn, $classfind);
        $classformat = mysqli_fetch_array($take);

        $mail->Subject = "State of your report has been changed!";
        $mail->setFrom("");
        $mail->Body = "Your report from classroom ".$classformat['number']." has been closed!";
        $mail->addAddress($patch['email']);
        if($mail->Send()){
            $_SESSION['messageSuccess'] = "Report updated and mail was sent!";
        }
        else{
            $_SESSION['messageDanger'] = "Report updated but email was not sent!". $mail->ErrorInfo;
        }
    }
header("Location: ../admin_reports.php");
}
if(isset($_POST['edit_user'])){
    $id = $_POST['id'];
    $password = $_POST['pass_update'];
    $pass = password_hash($password, PASSWORD_DEFAULT);
    $change = "UPDATE users SET password_hash = '$pass' WHERE id='$id'";
    $outcome = mysqli_query($conn, $change);
    if($outcome){
        $_SESSION['messageSuccess'] = "Password changed!";
        header("Location: ../admin_users.php");
    }
    else{
        $_SESSION['messageDanger'] = "Password not changed!";
        header("Location: ../admin_users.php");
    }
}
if(isset($_POST['change'])){
    $oldpass = $_POST['old_password'];
    $newpass = $_POST['new_password'];
    $newpassconfirm = $_POST['new_password_verify'];
    $suid = $_SESSION['userid'];
    $find = "SELECT password_hash FROM users WHERE id = '$suid'";
    $go = mysqli_query($conn, $find);
    $fetch = mysqli_fetch_array($go);
    if(password_verify($oldpass, $fetch['password_hash'])){
        if($newpass == $newpassconfirm){
            $passz = password_hash($newpass, PASSWORD_DEFAULT);
            $zmena = "UPDATE users SET password_hash = '$passz' WHERE id='$suid'";
            $do = mysqli_query($conn, $zmena);
            if($do){
                $_SESSION['messageSuccess'] = "Password changed!";
                header("Location: ../password_change.php");
            }
            else{
                $_SESSION['messageDanger'] = "Password not changed!";
                header("Location: ../password_change.php");
            }
        }
        else{
            $_SESSION['messageDanger'] = "Password not changed! Passwords don't match!";
            header("Location: ../password_change.php");
        }
    }
    else{
        $_SESSION['messageDanger'] = "Password not changed! Incorrect old password";
            header("Location: ../password_change.php");
    }
}
if(isset($_POST['report_edit'])){
    $pcnum = $_POST['pcnum'];
    $message = $_POST['message'];
    $id = $_POST['report_id'];
    $upquery = "UPDATE reports SET pcnumber = '$pcnum', message = '$message' WHERE id = '$id'";
    $push = mysqli_query($conn, $upquery);
    if($push){
        $_SESSION['messageSuccess'] = "Data successfully changed!";
        header("Location: ../reports.php");
    }
    else{
        $_SESSION['messageDanger'] = "Data not changed!";
        header("Location: ../reports.php");
    }
}
?>