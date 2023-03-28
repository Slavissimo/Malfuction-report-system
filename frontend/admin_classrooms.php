<?php
require '../backend/loggedinstatus.php';
require '../config/config.php';
include '../backend/Helper.php';

$uid = $_SESSION['userid'];
$query = "SELECT classrooms.id,classrooms.number, users.fname, users.lname FROM classrooms LEFT JOIN classrooms_admins ON classrooms.id = classrooms_admins.classroom_id LEFT JOIN users ON users.id = classrooms_admins.user_id";
$result = mysqli_query($conn, $query);

$teachersQuery = "SELECT users.id, users.fname, users.lname FROM users";
$teachers = mysqli_query($conn, $teachersQuery);
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
        <script>
          function editClassroom(id){
            var newclass= document.getElementById(id);
            var classnum = document.getElementById(id+"num").innerHTML;
            newclass.innerHTML = `
            <td>`+id+`</td>
            <td>`+classnum+`</td>
            <td><form id="edit_class" action="../backend/update.php?id=`+id+`" method="POST">
                  <select class="form-control" name="teacher">
                    <?php foreach($teachers as $teacher):?> 
                      <option id="<?= $teacher['id']?>" value="<?= $teacher['id']?>"> <?= $teacher['fname']." ".$teacher['lname']?> </option>
                    <?php endforeach?>
                  </select></td>
                  <td>
                  <button form="edit_class" name="edit" class="btn"><i class='fa-solid fa-check'></i></button>
                </td>
              </form>
            `;
          };
          function addClassroom(id){
            var div1=document.getElementById("classroom_add");
            div1.innerHTML=`
            <td>`+id+`</td>
            <td><input type="text" name="classnum" form="add_class"></td>
            <td>
            <select class="form-control" name="teacher" form="add_class">
            <?php foreach($teachers as $teacher):?> 
              <option id="<?= $teacher['id']?>" value="<?= $teacher['id']?>"> <?= $teacher['fname']." ".$teacher['lname']?> </option>
            <?php endforeach?>
            </option>
            </select></td>
            <td><button class="btn" name="add" form="add_class">ADD</button></td>
            `
      };
        </script>
  </head>
  <body class="container-fluid">
    <nav class="nav fixed-top navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand mb-0 h1" href="admin_reports.php"><i class="fa-solid fa-list-ul"></i>Nahlásenia</a>
        <a class="navbar-brand mb-0 h1" href="admin_users.php"><i class="fa-solid fa-person"></i>Používatelia</a>
        <a class="odhlasenie"href="../backend/logout.php"><button class="btn btn-dark" name="logout"><i class="fa-solid fa-power-off"></i>Logout</button></a>
   </nav>
   <?php include('../frontend/components/alertDanger.php'); ?>
   <?php include('../frontend/components/alertSuccess.php'); ?>
   <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="mt-5">
                <h2 class="text-center">Učebne</h2>
            </div>
        </div>
        <div class="table-responsive">
        <form id="add_class" action='../backend/add.php' method='POST'></form>
        <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Miestnosť</th>
                    <th scope="col">Správca</th>
                </tr>
            </thead>
            <tbody>
  <?php 
    $cislo = 1;

    if(mysqli_num_rows($result) > 0)
    {
      foreach($result as $data):
        $classnum = $data['number'];
  ?>
        <tr id="<?= $data['id']; ?>">
          <td><?= $cislo; ?></td>
          <td id="<?= $data['id']; ?>num"><?= $data['number']; ?></td>
          <td><?= $data['fname']. " ".$data['lname']?></td>
          <td><button class="btn btn-success" onclick="editClassroom(<?= $data['id']; ?>);">Edit</button></td>
          <td><a href="../backend/deleteclass.php?id=<?= $data['id']; ?>"><button class="btn btn-danger" onClick='javascript:return confirm("are you sure you want to delete this?");'>Remove</button></a></td>
        </tr>
  <?php
        $cislo = $cislo +1;
      endforeach;
    }
    else
    {
      echo '<p class="alert alert-danger mt-1"> There are no reports in your database <p>';
    }
  ?>
  <tr id="classroom_add"></tr>
  <td>
    <button class="btn btn-dark" id="btnok" onclick="addClassroom(<?= $cislo+1; ?>)"><i class="fa-solid fa-plus"></i></button>
  </td>
</tbody>
        </table>
        </div>

    </div>
  </body>
</html>