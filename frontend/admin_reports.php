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
        <title>Ticketový systém</title>
  </head>
  <body class="container-fluid">
  <nav class="nav fixed-top navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand mb-0 h1" href="admin_classrooms.php"><i class="fa-solid fa-people-group"></i>Učebne</a>
        <a class="odhlasenie"href="../backend/logout.php"><button class="btn btn-dark" name="logout"><i class="fa-solid fa-power-off"></i>Logout</button></a>
   </nav>
   <div class="mt-4">

        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div>
                <h2 class="text-center">Nahlásenia</h2>
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
                    $uid = $_SESSION['userid'];
                    $query = "SELECT classrooms.number, reports.pcnumber, reports.message, reports.report_status FROM reports LEFT JOIN classrooms ON classrooms.id = reports.classroom_id";
                    $result = mysqli_query($conn, $query);
                    $cislo = 1;

                    if(mysqli_num_rows($result) > 0)
                    {
                        foreach($result as $data)
                        {
                            ?>
                            <tr>
                                <td><?= $cislo; ?></td>
                                <td><?= $data['number']; ?></td>
                                <td><?= $data['pcnumber']; ?></td>
                                <td><?= $data['message']; ?></td>
                                <td><?php  if($data['report_status'] == 1){echo 'Nahlásené';} else if($data['report_status'] == 2){echo 'Robí sa na tom';} else if($data['report_status'] == 3){echo 'Vyriešené';} else{echo 'Nedá sa vyriešiť';}; ?></td>
                            </tr>
                            <?php
                            $cislo = $cislo +1;
                        }
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> There are no reports in your database <p>';
                    }
                ?>
            </tbody>
        </table>
        </div>

    </div>
  </body>
</html>