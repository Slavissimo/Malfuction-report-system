<?php
require './backend/middleware/isLogged.php';
require './backend/config/config.php';

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

  <?php include('./components/Navbar_user.php'); ?>

  <div class="p-1 m-5">
      <div class="mt-5">
          <h2 class="text-center">Zmena Hesla</h2>
          <?php include('./components/alertDanger.php'); ?>
          <?php include('./components/alertSuccess.php'); ?>
      </div>
    </div>

  <form method="POST" action="./backend/update.php">
  <div class="d-flex flex-column gap-2" style="margin: 5rem;">
  <label for="old_pass" class="form-label">Staré heslo</label>
  <div class="input-group">
    <input id="old_pass" type="password" class="form-control" name="old_password">
    <button class="btn btn-outline-secondary" type="button" onclick="show_old_pass()">Zobraziť heslo</button>
  </div>
</div>

<div class="d-flex flex-column gap-2" style="margin: 5rem;">
  <label for="new_pass" class="form-label">Nové heslo</label>
  <div class="input-group">
    <input id="new_pass" type="password" class="form-control" name="new_password">
    <button class="btn btn-outline-secondary" type="button" onclick="show_new_pass()">Zobraziť heslo</button>
  </div>
</div>

<div class="d-flex flex-column gap-3 " style="margin: 5rem;">
  <label for="new_pass_verify" class="form-label">Zopakujte heslo</label>
  <div class="input-group">
    <input id="new_pass_verify" type="password" class="form-control" name="new_password_verify">
    <button class="btn btn-outline-secondary" type="button" onclick="show_new_pass_verify()">Zobraziť heslo</button>
  </div>
</div>

    <div class="d-flex justify-content-center">
        <button class="btn btn-block btn-primary mt-3" style="max-width: 300px" name="change">Potvrdiť</button>
    </div>

</form>
    </div>
  </body>
</html>