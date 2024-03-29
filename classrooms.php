<?php
require './backend/middleware/isLogged.php';
require './backend/config/config.php';

$uid = $_SESSION['userid'];
$query = "SELECT classrooms.id,classrooms.number,classrooms.note FROM classrooms LEFT JOIN classrooms_admins ON classrooms.id = classrooms_admins.classroom_id  WHERE classrooms_admins.user_id = $uid";
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
        <script type="text/javascript">
            function editText(id) {
                let row = document.getElementById("row" + id);
                let classnum = document.getElementById(id+"num").innerHTML;
                let textfield = document.getElementById(id+"note").innerHTML;
                row.innerHTML = `
                    <td>`+id+`</td>
                    <td>`+classnum+`</td>
                    <td>
                        <textarea class='form-control' name='notes' form="note">`+textfield+`</textarea>
                        <input form="note" type="hidden" name="classRoom" value="`+classnum+`"/></td>
                    <td>
                        <button class='btn btn-dark' name='notesubmit' form="note">
                        <i class='fa-solid fa-check'></i></button></td>
                `
            };
            </script>
        <title>Ticketový systém</title>
  </head>
  <body class="container-fluid">

   <?php include('./components/Navbar_user.php'); ?>

   <div class="mt-4">
    <div class="p-1 m-5">
      <div>
        <h2 class="text-center mt-5">Moje učebne</h2>
        <?php include('./components/alertDanger.php'); ?>
        <?php include('./components/alertSuccess.php'); ?>
      </div>
    </div>

        <div class="table-responsive">
        <form id="note" action='./backend/update.php' method='POST'></form>
        <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Miestnosť</th>
                    <th scope="col">Poznámka</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $cislo = 1;

                    if(mysqli_num_rows($result) > 0)
                    {
                        foreach($result as $data):
                            $classid = $data['id'];
                            $note = $data['note'];
                            $classnum = $data['number'];
                            ?>
                            <tr id="row<?= $cislo?>">
                                <td><?= $cislo; ?></td>
                                <td id="<?= $cislo?>num"><?= $data['number']; ?></td>
                                <td id="<?= $cislo?>note"><?= $note?></td>
                                <td><button class="btn btn-dark ml-3" id="btnok" onclick="editText(<?= $cislo?>);"><i class="fa-solid fa-pen"></i></button></td>
                                <td><a href="/selectedclassroom.php?id=<?= $data['id']; ?>" class="btn btn-info">Ďalej</a></td>
                                <td><?php
                                $count = "SELECT COUNT(reports.report_status) AS pocet FROM reports WHERE reports.classroom_id = $classid AND reports.report_status = 1 ";
                                $res = mysqli_query($conn, $count);
                                $pocet = mysqli_fetch_assoc($res);
                                if($pocet['pocet'] > 0){
                                    echo '<span class="badge bg-danger rounded-pill">Nové nahlásenie!</span>';
                                }
                                else{
                                    null;
                                }
                                 ?></td>
                            </tr>
                            <?php
                            $cislo = $cislo +1;
                            endforeach;
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> Nespravuješ žiadne miestnosti <p>';
                    }
                ?>
            </tbody>
        </table>
        </div>
    </div>
  </body>
</html>