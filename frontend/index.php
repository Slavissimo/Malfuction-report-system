<?php
require_once("../config/config.php");
require_once("../backend/loginconfirm.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="87852869300-s9eeq1np92i30h8o4mqm3casog852em4.apps.googleusercontent.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        <script src="https://kit.fontawesome.com/7a7a8f8bce.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="penguin.css">
    <link rel="icon" href="https://cdn.discordapp.com/attachments/670709218340241408/969608874011262976/logo_spse.png" type="image/icon type">
    <meta charset="UTF-8">
    <meta name="author" content="Slavomír Salončuk">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="SPŠE, ticket systém">
    <title>Ticketový systém</title>
  </head>
  <body class="login_kontainer">
      <div class="h1_welcoming">
        <h1 class="text-center nadpis">Vitajte!</h1>
      </div>
      <div id="login">
      <?php include('../frontend/components/alertDanger.php'); ?>
        <h1 class="text-center text">Login</h1>
        <form method="POST" action="../backend/loginconfirm.php">
          <div class="text">
            <input class="form-control" type="text" name="username" required>
            <span></span>
            <label>Prihlasovacie meno</label>
        </div>
        <div class="text">
            <input class="form-control" type="password" name="password" required>
            <span></span>
            <label>Heslo</label>
        </div>
        <div>
        <button class="btn btn-primary" name="login"> LOGIN </button>
        <p></p>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
        </form>
        <div class="tucniak">
          <div class="penguin">
            <div class="penguin-bottom">
              <div class="right-hand"></div>
              <div class="left-hand"></div>
              <div class="right-feet"></div>
              <div class="left-feet"></div>
            </div>
            <div class="penguin-top">
              <div class="right-cheek"></div>
              <div class="left-cheek"></div>
              <div class="belly"></div>
              <div class="right-eye">
                <div class="sparkle"></div>
              </div>
              <div class="left-eye">
                <div class="sparkle"></div>
              </div>
              <div class="blush-right"></div>
              <div class="blush-left"></div>
              <div class="beak-top"></div>
              <div class="beak-bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrightankle">
        <a class="logo" href="https://www.spseke.sk/skola/" target="_blank"><img id="logo_skoly"src="https://cdn.discordapp.com/attachments/670709218340241408/969608874011262976/logo_spse.png"></a>
      </div>
  </body>
</html>