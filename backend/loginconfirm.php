<?php
session_start();
require '../config/config.php';

    if(isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user_logins WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) { 
            $userData = mysqli_fetch_array($result);
            $uid = $userData['id'];
            $dbPass = $userData['password_hash'];
                if (password_verify($password, $dbPass)) {
                    $_SESSION['userid'] = $uid;
                    if($uid == "1"){
                      header("Location: ../frontend/admin_classrooms.php");
                    }
                    else{
                      header("Location: ../frontend/classrooms.php");
                    }
                } else {
                    $_SESSION['messageDanger'] = "Wrong password";
                    header("Location: ../frontend/index.php");
                }

        } else {
            $_SESSION['messageDanger'] = "Wrong Username";
            header("Location: ../frontend/index.php");
        }
    }
?>