<?php
require '../config/config.php';

    if(isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user_logins WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) { 
            $userData = mysqli_fetch_array($result);

            $dbPass = $userData['password_hash'];
                if (password_verify($password, $dbPass)) {
                    header("Location: ../frontend/classrooms.php");
                } else {
                    $_SESSION['message'] = "Wrong password";
                    header("Location: ../frontend/login.php");
                }

        } else {
            $_SESSION['message'] = "Wrong Username";
            header("Location: ../frontend/login.php");
        }
    }
?>