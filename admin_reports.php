<?php
require './backend/middleware/isLogged.php';
require './backend/config/config.php';

if($_SESSION['userid'] != 1){
  header("Location: ../classrooms.php");
}

$uid = $_SESSION['userid'];
$query = "SELECT reports.id, classrooms.number, reports.pcnumber, reports.message, reports.report_status FROM reports LEFT JOIN classrooms ON classrooms.id = reports.classroom_id";
$result = mysqli_query($conn, $query);
$cislo = 1;
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7a7a8f8bce.js" crossorigin="anonymous"></script>
  <link rel="icon" href="https://cdn.discordapp.com/attachments/670709218340241408/969608874011262976/logo_spse.png"
    type="image/icon type">
  <meta charset="UTF-8">
  <meta name="author" content="Slavomír Salončuk">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="SPŠE, ticket systém">
  <title>Ticketový systém</title>
</head>

<body class="container-fluid">
  <?php include('./components/Navbar.php'); ?>

  <div class="mt-4">
    <div class="p-1 m-5">
      <div>
        <h2 class="text-center mt-5">Nahlásenia</h2>
        <?php include('./components/alertDanger.php'); ?>
        <?php include('./components/alertSuccess.php'); ?>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Miestnosť</th>
            <th scope="col">Zariadenie</th>
            <th scope="col">Správa</th>
            <th scope="col">Stav</th>
          </tr>
        </thead>
        <tbody>
          <?php 
                    if(mysqli_num_rows($result) > 0)
                    {
                        foreach($result as $data):
                            ?>
          <tr id="<?= $data['id']; ?>">
            <td id="<?= $data['id']; ?>cislo"><?= $cislo; ?></td>
            <td id="<?= $data['id']; ?>num"><?= $data['number']; ?></td>
            <td id="<?= $data['id']; ?>pcnum"><?= $data['pcnumber']; ?></td>
            <td id="<?= $data['id']; ?>note"><?= $data['message']; ?></td>
            <td>
              <?php  if($data['report_status'] == 1){echo 'Nahlásené';} else if($data['report_status'] == 2){echo 'Robí sa na tom';} else if($data['report_status'] == 3){echo 'Vyriešené';} else{echo 'Nedá sa vyriešiť';}; ?>
            </td>
            <td><button class="btn btn-success" onclick="editReport(<?= $data['id']; ?>);">Upraviť</button></td>
            <td><a href="./backend/deletereport.php?id=<?= $data['id']; ?>"><button class="btn btn-danger"
                  onClick='javascript:return confirm("Naozaj to chceš zmazať?");'>Zmazať</button></a></td>
          </tr>
          <?php
                            $cislo = $cislo +1;
                        endforeach;
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> Nie sú vytvorené žiadne nahlásenia <p>';
                    }
                    
                ?>
          <script>
          function editReport(id) {
            var report = document.getElementById(id);
            var num = document.getElementById(id + "cislo").innerHTML;
            var classnum = document.getElementById(id + "num").innerHTML;
            var pcnum = document.getElementById(id + "pcnum").innerHTML;
            var message = document.getElementById(id + "note").innerHTML;
            report.innerHTML = `
                        <td>` + num + `</td>
                        <td>` + classnum + `</td>
                        <td>` + pcnum + `</td>
                        <td>` + message + `</td>
                        <td><form id="admin_edit"action="./backend/update.php" method="POST">
                        <select class="form-control" name="reportStatus">
                        <option id="1" value="1">Nahlásené</option>
                        <option id="2" value="2">Robí sa na tom</option>
                        <option id="3" value="3">Vyriešené</option>
                        <option id="4" value="4">Nedá sa vyriešiť</option>
                        </select></td>
                        <td>
                        <input form="admin_edit" type="hidden" name="report_id" value="` + id + `">
                        <button form="admin_edit" name="admin_update" class="btn"><i class='fa-solid fa-check'></i></button>
                        </td>
                        </form>
                    `;
          };
          </script>
        </tbody>
      </table>
    </div>

  </div>
</body>

</html>