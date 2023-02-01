<?php
require '../backend/loggedinstatus.php';
require '../config/config.php';
include '../backend/update.php';


$uid = $_SESSION['userid'];
$query = "SELECT classrooms.id,classrooms.number FROM classrooms";
$result = mysqli_query($conn, $query);

$teachersQuery = "SELECT users.fname, users.lname FROM users";
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
        <script>
        const addClassroom = () => {
            let newclass=document.getElementById("classroom_add");
            newclass.innerHTML = `
            <form action="../backend/add.php" method="POST"></td>
                <td></td>

                <td>
                    <input type="text" id="classnum" placeholder="Číslo učebne" name="classnum">
                </td>

                <td>
                    <select class="form-control">
                        <?php foreach($teachers as $teacher):?> 
                            <option> <?= $teacher['fname']?> </option>
                        <?php endforeach?>
                    </select>
                </td>

                <td>
                    <button name="add" class="btn">ADD</button>
                </td>

            </form>
          `
        };
        </script>
        <title>Ticketový systém</title>
  </head>
  <body class="container-fluid">
    <nav class="nav fixed-top navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand mb-0 h1" href="admin_reports.php"><i class="fa-solid fa-list-ul"></i>Nahlásenia</a>
        <a class="odhlasenie"href="../backend/logout.php"><button class="btn btn-dark" name="logout"><i class="fa-solid fa-power-off"></i>Logout</button></a>
   </nav>
   <div class="card shadow p-3 mb-5 bg-body rounded">
            <div class="mt-5">
                <h2 class="text-center">Učebne</h2>
            </div>
        </div>
        <div class="table-responsive">
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
                        foreach($result as $data)
                        {
                            $classnum = $data['number'];
                            ?>
                            <tr id="<?= $data['number']; ?>">
                                <td><?= $cislo; ?></td>
                                <td><?= $data['number']; ?></td>
                                <td></td>
                                <td><button class="btn btn-success" onclick="editClassroom(<?= $data['number']; ?>);">Edit</button></td>
                            </tr>
                            <script>
                                const editClassroom = (id) => {
                                    let newclass=document.getElementById(id);
                                    newclass.innerHTML = `
                                    <form action="../backend/add.php" method="POST"></td>
                                        <td></td>

                                        <td>
                                            <input type="text" id="classnum" placeholder="Číslo učebne" name="classnum">
                                        </td>

                                        <td>
                                            <select class="form-control">
                                                <?php foreach($teachers as $teacher):?> 
                                                    <option> <?= $teacher['fname']?> </option>
                                                <?php endforeach?>
                                            </select>
                                        </td>

                                        <td>
                                            <button name="edit" class="btn"><i class='fa-solid fa-check'></i></button>
                                        </td>

                                    </form>
                                `
                                };
                            </script>
                            <?php
                            $cislo = $cislo +1;
                        }
                    }
                    else
                    {
                        echo '<p class="alert alert-danger mt-1"> There are no reports in your database <p>';
                    }
                ?>
                <tr id="classroom_add">
                </tr>
                <td>
                    <button class="btn btn-dark" id="btnok" onclick="addClassroom()"><i class="fa-solid fa-plus"></i></button>
                </td>
            </tbody>
        </table>
        </div>

    </div>
  </body>
</html>