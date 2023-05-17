<?php
require './backend/loggedinstatus.php';
require './backend/config/config.php';

$uid = $_SESSION['userid'];
$query = "SELECT classrooms.number, reports.id, reports.pcnumber, reports.message, reports.date_of_report, reports.date_of_completion  FROM reports LEFT JOIN classrooms ON classrooms.id = reports.classroom_id WHERE reports.user_id = $uid";
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
  <script>
  function editReport(id) {
    var div = document.getElementById(id);
    var classnum = document.getElementById(id + "num").innerHTML;
    var pcnum = document.getElementById(id + "pcnum").innerHTML;
    var message = document.getElementById(id + "message").innerHTML;
    var reportdate = document.getElementById(id + "reportdate").innerHTML;
    var findate = document.getElementById(id + "findate").innerHTML;
    div.innerHTML = `
                <td></td>
                <td>` + classnum + `</td>
                <td><textarea class='form-control' name='pcnum' form="report_edit">` + pcnum + `</textarea></td>
                <td><textarea class='form-control' name='message' form="report_edit">` + message + `</textarea></td>
                <td>` + reportdate + `</td>
                <td>` + findate + `</td>
                <td><input form="report_edit" type="hidden" name="report_id" value="` + id + `">
                <button class="btn" name="report_edit" form="report_edit"><i class='fa-solid fa-check'></i></button>
                </td>
                `
  };
  </script>
  <title>Ticketový systém</title>
</head>

<body class="container-fluid">

  <?php include('./components/Navbar.php'); ?>

  <div class="mt-4">

    <div class="card shadow p-3 mb-5 bg-body rounded">
      <div>
        <h2 class="text-center">Moje nahlásenia</h2>
      </div>
    </div>
    <form method="POST" id="report_edit" action="../backend/update.php"></form>
    <div class="table-responsive">
      <?php include('./components/alertDanger.php'); ?>
      <?php include('./components/alertSuccess.php'); ?>
      <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Miestnosť</th>
            <th scope="col">Zariadenie</th>
            <th scope="col">Správa</th>
            <th scope="col">Dátum nahlásenia</th>
            <th scope="col">Dátum uzatvorenia</th>
          </tr>
        </thead>
        <tbody>
          <?php 
                    if(mysqli_num_rows($result) > 0)
                    {
                        foreach($result as $data):
                          $date_of_report = strtotime($data['date_of_report']);
                          $date_of_completion = strtotime($data['date_of_completion']);
                            ?>
          <tr id="<?= $data['id']; ?>">
            <td><?= $cislo; ?></td>
            <td id="<?= $data['id']; ?>num"><?= $data['number']; ?></td>
            <td id="<?= $data['id']; ?>pcnum"><?= $data['pcnumber']; ?></td>
            <td id="<?= $data['id']; ?>message"><?= $data['message']; ?></td>
            <td id="<?= $data['id']; ?>reportdate"><?= date("H:i:s d.m.Y", $date_of_report); ?></td>
            <td id="<?= $data['id']; ?>findate"><?= is_null(($data['date_of_completion'])) ? NULL: date("H:i:s d.m.Y", $date_of_completion)  ?></td>
            <td><button class="btn btn-success" onclick="editReport(<?= $data['id']; ?>);">Upraviť</button></td>
            <td><a href="../backend/delete.php?id=<?= $data['id']; ?>"><button class="btn btn-danger"
                  onClick='javascript:return confirm("Naozaj to chceš zmazať?");'>Zmazať</button></a></td>
          </tr>
          <?php
                            $cislo = $cislo +1;
                        endforeach;
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> Nevytvoril si žiadne nahlásenie <p>';
                    }
                ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>