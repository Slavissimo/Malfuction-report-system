<?php
require '../config/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
        <script src="https://kit.fontawesome.com/7a7a8f8bce.js" crossorigin="anonymous"></script>
        <link rel="icon" href="https://cdn.discordapp.com/attachments/670709218340241408/969608874011262976/logo_spse.png" type="image/icon type">
        <meta charset="UTF-8">
        <meta name="author" content="Slavomír Salončuk">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="SPŠE, ticket systém">
        <title>Ticketový systém</title>
  </head>
  <body class="kontainer">
    <div class="nav-bar">
      <div class="odkazy">
        <a class="odkaz" href="classrooms.php"><i class="fa-solid fa-people-group"></i></i> Moje učebne</a>
        <a class="odkaz" href="reportform.php"><i class="fa-solid fa-pen"></i> Nové nahlásenie</a>
      </div>
    </div>
    <div class="vypis mt-4">

        <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="card-body">
                <h2 class="text-center">Moje nahlásenia</h2>
            </div>
        </div>

        <table class="table table-striped table-hover mt-5 shadow p-3 mb-5 bg-body rounded">
            <thead>
                <tr>
                    <th>Číslo nahlásenia</th>
                    <th>Číslo miestnosti</th>
                    <th>Správa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT classrooms.number, reports.message FROM reports LEFT JOIN classrooms ON reports.classroom_id = classrooms.id";
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
                                <td><?= $data['message']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> There are no users in your database <p>';
                    }
                    $cislo +=1;
                ?>
            </tbody>
        </table>

    </div>
  </body>
</html>