<?php


require '../config/config.php';
require '../backend/loggedinstatus.php';
require '../backend/loginconfirm.php';

if(isset($_POST['send'])) {
    $classrooms = $_POST['inputClassroom'];
    $pcnumber = $_POST['ComputerNumber'];
    $description = $_POST['Description'];
    $suid = $_SESSION['userid'];
    $classrooms = (int)$classrooms;
    $cislo = "SELECT classrooms.id FROM classrooms WHERE number = $classrooms";
    $sql = mysqli_query($conn, $cislo);
    $fetch = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    $id = $fetch['id'];
    $query = "INSERT INTO reports (classroom_id, pcnumber, message, user_id) VALUES ('$id', '$pcnumber', '$description', '$suid')";
    $result = mysqli_query($conn, $query);



    if ($result) {
        $_SESSION['message'] = "Report has been sent";
        header("Location: ../frontend/reports.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Report was not send! Try again";
        header("Location: ../frontend/reports.php");
        exit(0);
    }
}


?>