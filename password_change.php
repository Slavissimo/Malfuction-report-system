<?php
require '../backend/loggedinstatus.php';
require '../config/config.php';

?>
<!DOCTYPE html>
<html>
  <head>
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        <script src="https://kit.fontawesome.com/7a7a8f8bce.js" crossorigin="anonymous"></script>
        <link rel="icon" href="https://cdn.discordapp.com/attachments/670709218340241408/969608874011262976/logo_spse.png" type="image/icon type">
        <meta charset="UTF-8">
        <meta name="author" content="Slavomír Salončuk">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="SPŠE, ticket systém">
         <script>
        function show_old_pass(){
            var old_pass = document.getElementById('old_pass');
            if(old_pass.type==="password"){
                old_pass.type="text";
            }
            else{
                old_pass.type="password";
            }
        };
        function show_new_pass(){
            var new_pass = document.getElementById('new_pass');
            if(new_pass.type==="password"){
                new_pass.type="text";
            }
            else{
                new_pass.type="password";
            }
        };
        function show_new_pass_verify(){
            var new_pass_verify = document.getElementById('new_pass_verify');
            if(new_pass_verify.type==="password"){
                new_pass_verify.type="text";
            }
            else{
                new_pass_verify.type="password";
            }
        };
    </script>
        <title>Ticketový systém</title>
  </head>
  <body class="container-fluid">
    <nav class="nav fixed-top navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand mb-0 h1" href="reports.php"><i class="fa-solid fa-list-ul"></i>Moje nahlásenia</a>
        <a class="navbar-brand mb-0 h1" href="classrooms.php"><i class="fa-solid fa-people-group"></i>Moje učebne</a>
        <a class="navbar-brand mb-0 h1" href="reportform.php"><i class="fa-solid fa-pen"></i>Nové nahlásenie</a>
        <a class="odhlasenie"href="../backend/logout.php"><button class="btn btn-dark" name="logout"><i class="fa-solid fa-power-off"></i>Odhlásiť sa</button></a>
   </nav>
    <div class="mt-4">
    <div class="card shadow p-3 mb-5">
            <div>
                <h2 class="text-center">Zmena hesla</h2>
            </div>
        </div>
    <?php include('./components/alertDanger.php'); ?>
    <?php include('./components/alertSuccess.php'); ?>
  <form method="POST" action="../backend/update.php">
    <div class="col-xs-3">
    <label for="old_pass">Staré heslo</label>
    <input id="old_pass" type="password" class="form-control" name="old_password">
    <span onclick="show_old_pass()"><input class="btn-check" type="checkbox"> Zobraziť heslo</span>
</div>
  <div class="col-xs-3">
    <label for="new_pass">Nové heslo</label>
    <input id="new_pass" type="password" class="form-control" name="new_password">
    <span onclick="show_new_pass()"><input class="btn-check" type="checkbox"> Zobraziť heslo</span>
</div>
  <div class="col-xs-3">
  <label for="new_pass_verify">Zoapkujte heslo</label>
  <input id="new_pass_verify" type="password" class="form-control" name="new_password_verify">
  <span onclick="show_new_pass_verify()"><input class="btn-check" type="checkbox"> Zobraziť heslo</span>
</div>
  <button class="btn btn-block btn-primary mt-3" name="change">Potvrdiť</button>
</form>
    </div>
  </body>
</html>