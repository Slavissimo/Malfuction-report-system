<?php
require '../config/config.php';

if(isset($_POST['update'])){
    $status = $_POST['reportStatus'];
    $id = $_GET['id'];
    $query = "UPDATE reports SET report_status = $status  WHERE classroom_id = $id";
    $result = mysqli_query($conn, $query);
    header("Location: ../frontend/classrooms.php");
}
?>