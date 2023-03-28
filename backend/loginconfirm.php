<?php
session_start();
require '../config/config.php';
    if(isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username='$username'";
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
    if(isset($_POST['email']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        
        $queue = "SELECT users.id FROM users WHERE email = $email";
        $answer = mysqli_query($conn, $queue);
        if(mysqli_num_rows($answer) > 1){
            $userData = mysqli_fetch_array($answer);
            $_SESSION['userid'] = $userData['id'];
            header("Location: ../frontend/classrooms.php");
        }
        else{
            $insert = "INSERT INTO users (fname, lname, email) VALUES ('$firstName', '$lastName', '$email')";
            $send = mysqli_query($conn, $insert);
            $getid = "SELECT users.id FROM users WHERE email = $email";
            $ans = mysqli_query($conn, $getid);
            $userData = mysqli_fetch_array($ans);
            $_SESSION['userid'] = $userData['id'];
            header("Location: ../frontend/classrooms.php");
        }
    
    }
?>