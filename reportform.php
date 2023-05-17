<?php
require './backend/loggedinstatus.php';
require './backend/config/config.php';

$query = "SELECT number FROM classrooms";
$result = mysqli_query($conn, $query);
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
        <title>Ticketový systém</title>
  </head>
  <body class="container-fluid">

   <?php include('./components/Navbar.php'); ?>

    <div class="mt-4">
    <div class="card shadow p-3 mb-5">
            <div>
                <h2 class="text-center">Nové nahlásenie</h2>
            </div>
        </div>
  <form method="POST" action="./backend/add.php">
  <div class="form-group">
  <label name="inputClassroom">Učebňa</label>
      <select name="inputClassroom" class="form-control" required>
    <?php
    if(mysqli_num_rows($result) > 0){
      foreach($result as $data):?>
        <option><?= $data['number']; ?></option>
        <?php
      endforeach;}
    else{
      echo '<p class="alert alert-danger mt-1"> Nie sú vytvorené žiadne miestnosti <p>';
    }
      ?>
      </select>
    </div>
  <div class="form-group">
    <label name="ComputerNumber">Zariadenie</label>
    <input class="form-control" name="ComputerNumber" placeholder="PC-13" required>
  </div>
  <div class="form-group">
    <label name="Description">Popis problému</label>
    <textarea class="form-control" name="Description" rows="3" required></textarea>
  </div>
  <button class="btn btn-block btn-primary" name="send">Odoslať</button>
</form>
    </div>
  </body>
</html>