<?php
require '../config/config.php';
require '../backend/loggedinstatus.php';

$suid = $_SESSION['userid'];
$class_id = $_GET['id'];
$query = "SELECT reports.id, classrooms.number, reports.pcnumber, reports.message, reports.report_status FROM reports LEFT JOIN classrooms ON reports.classroom_id = classrooms.id LEFT JOIN classrooms_admins ON classrooms_admins.classroom_id = reports.classroom_id  WHERE reports.classroom_id = $class_id AND (reports.report_status = 1 OR reports.report_status = 2)";
$result = mysqli_query($conn, $query);
$cislo = 1;
$queue = "SELECT reports.id, classrooms.number, reports.pcnumber, reports.message, reports.report_status FROM reports LEFT JOIN classrooms ON reports.classroom_id = classrooms.id LEFT JOIN classrooms_admins ON classrooms_admins.classroom_id = reports.classroom_id  WHERE reports.classroom_id = $class_id AND (reports.report_status = 3 OR reports.report_status = 4)";
$outcome = mysqli_query($conn, $queue);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        <script src="https://kit.fontawesome.com/7a7a8f8bce.js" crossorigin="anonymous"></script>
    <link rel="icon" href="https://cdn.discordapp.com/attachments/670709218340241408/969608874011262976/logo_spse.png" type="image/icon type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Slavomír Salončuk">
    <title>Ticketový systém</title>
</head>
<body>
<nav class="nav fixed-top navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand mb-0 h1" href="reports.php"><i class="fa-solid fa-list-ul"></i>Moje nahlásenia</a>
        <a class="navbar-brand mb-0 h1" href="classrooms.php"><i class="fa-solid fa-people-group"></i>Moje učebne</a>
        <a class="navbar-brand mb-0 h1" href="reportform.php"><i class="fa-solid fa-pen"></i>Nové nahlásenie</a>
        <a class="odhlasenie"href="../backend/logout.php"><button class="btn btn-dark" name="logout"><i class="fa-solid fa-power-off"></i>Logout</button></a>
</nav>
<div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="mt-5">
                <h2 class="text-center">Pending</h2>
            </div>
        </div>
<div class="table-responsive">
        <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Miestnosť</th>
                    <th scope="col">Č.PC</th>
                    <th scope="col">Správa</th>
                </tr>
            </thead>
            <tbody>
            <?php 
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
                                <td>
                                    <form method="POST" action="../backend/update.php?id=<?= $data['id']; ?>">
                                    <select name="reportStatus" class="form-control" required>
                                    <option value="<?= $data['report_status']?>"><?php if($data['report_status'] == 1){ echo '';} else {echo 'Robím na tom';}?></option>
                                    <option value="2">Robím na tom</option>
                                    <option value="3">Vyriešené</option>
                                    <option value="4">Nedá sa opraviť</option>
                                    </select>
                                    <button class="btn" name="update"><i class="fa-solid fa-check"></i></button>
                                    </form></td>
                            </tr>
                            <?php
                            $cislo = $cislo +1;
                        }
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> There are no pending reports <p>';
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="mt-5">
                <h2 class="text-center">Done</h2>
            </div>
        </div>
<div class="table-responsive">
        <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Miestnosť</th>
                    <th scope="col">Č.PC</th>
                    <th scope="col">Správa</th>
                </tr>
            </thead>
            <tbody>
            <?php 

                    if(mysqli_num_rows($outcome) > 0)
                    {
                        foreach($outcome as $data)
                        {
                            ?>
                            <tr>
                                <td><?= $cislo; ?></td>
                                <td><?= $data['number']; ?></td>
                                <td><?= $data['pcnumber']; ?></td>
                                <td><?= $data['message']; ?></td>
                                <td>
                                    <form method="POST" action="../backend/update.php?id=<?= $data['id']; ?>">
                                    <select name="reportStatus" class="form-control" required>
                                    <option value="<?= $data['report_status']?>"><?php if($data['report_status'] == 3){ echo 'Vyriešené';} else {echo 'Nedá sa opraviť';}?></option>
                                    <option value="2">Robím na tom</option>
                                    <option value="3">Vyriešené</option>
                                    <option value="4">Nedá sa opraviť</option>
                                    </select>
                                    <button class="btn" name="update"><i class="fa-solid fa-check"></i></button>
                                    </form></td>
                            </tr>
                            <?php
                            $cislo = $cislo +1;
                        }
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> There are no finished reports <p>';
                    }
                ?>
            </tbody>
        </table>
        </div>
                
</body>
</html>