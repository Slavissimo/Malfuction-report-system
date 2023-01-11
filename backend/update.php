<?php
require '../config/config.php';

if(isset($_POST['update'])){
    $status = $_POST['reportStatus'];
    $id = $_GET['id'];
    $query = "UPDATE reports SET report_status = $status  WHERE classroom_id = $id";
    $result = mysqli_query($conn, $query);
    header("Location: ../frontend/classrooms.php");
}
if(isset($_POST['notesubmit'])){
    $note = $_POST['notes'];
    $classRoom = $_POST['classRoom'];
    $queue = "UPDATE classrooms SET note='$note' WHERE number=$classRoom";
    $result = mysqli_query($conn, $queue);
    header("Location: ../frontend/classrooms.php");
}
?>