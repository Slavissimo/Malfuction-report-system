<?php
session_start();
require_once("../config/config.php");
require_once("../backend/loginconfirm.php");
include('../frontend/components/alertDanger.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
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