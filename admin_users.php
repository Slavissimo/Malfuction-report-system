<?php
require './backend/middleware/isLogged.php';
require './backend/config/config.php';

if($_SESSION['userid'] != 1){
  header("Location: ../classrooms.php");
}

$uid = $_SESSION['userid'];
$query = "SELECT users.id, users.fname, users.lname, users.email, users.username FROM users WHERE users.id >=2";
$result = mysqli_query($conn, $query);

$teachersQuery = "SELECT users.id, users.fname, users.lname FROM users";
$teachers = mysqli_query($conn, $teachersQuery);
?>
<!DOCTYPE html>
<html>
  <head>
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        <script src="https://kit.fontawesome.com/7a7a8f8bce.js" crossorigin="anonymous"></script>
        <link rel="icon" href="https://cdn.discordapp.com/attachments/670709218340241408/969608874011262976/logo_spse.png" type="image/icon type">
        <meta charset="UTF-8">
        <meta name="author" content="Slavomír Salončuk">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="SPŠE, ticket systém">
        <title>Ticketový systém</title>
        <script>
          function editUser(id){
            var newclass= document.getElementById(id);
            var fname = document.getElementById(id+"fname").innerHTML;
            var lname = document.getElementById(id+"lname").innerHTML;
            var email = document.getElementById(id+"email").innerHTML;
            var username = document.getElementById(id+"username").innerHTML;
            newclass.innerHTML = `
            <td></td>
            <td>`+fname+`</td>
            <td>`+lname+`</td>
            <td>`+email+`</td>
            <td>`+username+`</td>
            <td>
            <td><input class="form-control" form="edit_user" id="password" type="password" name="pass_update" placeholder="Zadaj nové heslo"></td>
            <td><i class="bi bi-eye" onclick="show()"></i></td>
            <td>
            <input form="edit_user" type="hidden" name="id" value="`+id+`">
            <button form="edit_user" name="edit_user" class="btn"><i class='fa-solid fa-check'></i></button>
            </td>
            </form>
            `;
          };
          function addUser(id){
            var div1=document.getElementById("user_add");
            div1.innerHTML=`
            <td>`+id+`</td>
            <td><input class="form-control" placeholder="Meno" type="text" name="meno" form="add_user"></td>
            <td><input class="form-control" placeholder="Priezvisko" type="text" name="priezvisko" form="add_user"></td>
            <td><input class="form-control" placeholder="E-mail" type="text" name="email" form="add_user"></td>
            <td><input class="form-control" placeholder="Prihlasovacie meno" type="text" name="username" form="add_user"></td>
            <td><input class="form-control" placeholder="Heslo" id="password" type="password" name="password" form="add_user"></td>
            <td><i class="bi bi-eye" onclick="show()"></i></td>
            <td><button class="btn" name="add_user" form="add_user">ADD</button></td>
            `
      };
        function show(){
            var password = document.getElementById('password');
            if(password.type==="password"){
                password.type="text";
            }
            else{
                password.type="password";
            }
        };
        </script>
  </head>
  <body class="container-fluid">
   <?php include('./components/Navbar.php'); ?>

    <div class="p-1 m-5">
      <div class="mt-5">
          <h2 class="text-center">Používatelia</h2>
          <?php include('./components/alertDanger.php'); ?>
          <?php include('./components/alertSuccess.php'); ?>
      </div>
      </div>

        <div class="table-responsive">
        <form id="edit_user" action="./backend/update.php" method="POST"></form>
        <form id="add_user" action='./backend/add.php' method='POST'></form>
        <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Meno</th>
                    <th scope="col">Priezvisko</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Prihlasovacie meno</th>
                </tr>
            </thead>
            <tbody>
  <?php 
    $cislo = 1;

    if(mysqli_num_rows($result) > 0)
    {
      foreach($result as $data):
  ?>
        <tr id="<?= $data['id']; ?>">
          <td><?= $cislo; ?></td>
          <td id="<?= $data['id']; ?>fname"><?= $data['fname']; ?></td>
          <td id="<?= $data['id']; ?>lname"><?= $data['lname']?></td>
          <td id="<?= $data['id']; ?>email"><?= $data['email']?></td>
          <td id="<?= $data['id']; ?>username"><?= $data['username']?></td>
          <td><button class="btn btn-success" onclick="editUser(<?= $data['id']; ?>);">Upraviť</button></td>
          <td><a href="./backend/deleteuser.php?id=<?= $data['id']; ?>"><button class="btn btn-danger" onClick='javascript:return confirm("Naozaj to chceš zmazať?");'>Zmazať</button></a></td>
        </tr>
  <?php
        $cislo = $cislo +1;
      endforeach;
    }
    else
    {
      echo '<p class="alert alert-danger mt-1"> Nie sú vytvorený žiadny používatelia <p>';
    }
  ?>
  <tr id="user_add"></tr>
  <td>
    <button class="btn btn-dark" id="btnok" onclick="addUser(<?= $cislo; ?>)"><i class="fa-solid fa-plus"></i></button>
  </td>
</tbody>
        </table>
        </div>

    </div>
  </body>
</html>