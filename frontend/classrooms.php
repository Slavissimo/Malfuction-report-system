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
        <a class="navbar-brand mb-0 h1" href="reports.php"><i class="fa-solid fa-list-ul"></i>Moje nahlásenia</a>
        <a class="navbar-brand mb-0 h1" href="reportform.php"><i class="fa-solid fa-pen"></i>Nové nahlásenie</a>
        <a class="odhlasenie"href="../backend/logout.php"><button class="btn btn-dark" name="logout"><i class="fa-solid fa-power-off"></i>Logout</button></a>
   </nav>
   <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="mt-5">
                <h2 class="text-center">Moje učebne</h2>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-dark table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Miestnosť</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $uid = $_SESSION['userid'];
                    $query = "SELECT classrooms.id,classrooms.number FROM classrooms LEFT JOIN classrooms_admins ON classrooms.id = classrooms_admins.classroom_id  WHERE classrooms_admins.user_id = $uid";
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
                                <td><a href="selectedclassroom.php?id=<?= $data['id']; ?>" class="btn btn-info">View</a></td>
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