<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["chief_name"])) {
    header("Location: login.php");
    exit();
}

include "connexion.php";

if (isset($_POST['submit'])) {
    $doc = $_POST['doc'];
    $deadline = $_POST['deadline'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO doc_deadline(`id`, `document`, `deadline`,`description`) VALUES (NULL,'$doc','$deadline', '$desc')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script type=\"text/javascript\">
                        alert(\"Deadline added successfully.\");
                        window.location = \"documents.php\"
                  </script>";
    } else {
        echo "Failed : " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsable</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/skins/color1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->


</head>

<body>
    <!-- Main container Start -->

    <div class="main-container">

        <!-- Aside? Start -->


        <div class="aside">
            <!--aside-->

            <div class="logo">
                <a href="/projet_int/cheif_welcome.php" class="active">
                    <span>R</span>esponsable
                </a>
            </div>
            <div class="nav-toggler">
                <!-- toggler ??? -->
                <span></span>
            </div>

            <ul class="nav">
                <!--<li>
                    <a href="#welcome" class="active">
                        <i class="fa-solid fa-house-user"></i>
                        Welcome
                    </a>
                </li>-->
                <li>
                    <a href="students.php" class="active">
                        <i class="fa-solid fa-users"></i>
                        Students
                    </a>
                </li>
                <li>
                    <a href="documents.php" class="active">
                        <i class="fa-solid fa-folder-open"></i>
                        Documents
                    </a>
                </li>
                <li>
                    <a href="dashboard.php" class="active">
                        <i class="fa-solid fa-chart-line"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="meetings.php" class="active">
                        <i class="fa-solid fa-handshake"></i>
                        Meetings
                    </a>
                </li>
                <li>
                    <a href="contact.php" class="active">
                        <i class="fa-sharp fa-solid fa-comments"></i>
                        Contact
                    </a>
                </li>
                <li>
                    <a href="profile.php" class="active">
                        <i class="fa-solid fa-user">

                        </i>
                        My profile
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="active" id="logout">
                        <i class="fa-solid fa-right-from-bracket">
                        </i>
                        Log out
                    </a>
                </li>
            </ul>

        </div>
        <!-- Add deadline section Start -->
        <section class="Contact section ">
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            New document deadline
                        </h2>
                    </div>
                </div>

                <!-- Formulaire -->
                <form method="POST" action="">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title"> Choose new deadline : </span>
                            <div class="fields">
                                <div class="input-field">
                                    <label>Document name :</label>
                                    <input type="text" name="doc" class="form-control" placeholder="Document name..." autocomplete="off">
                                </div>

                                <div class="input-field">
                                    <label>Description :</label>
                                    <input type="text" name="desc" class="form-control" placeholder="Description..." autocomplete="off">
                                </div>
                                <div class="input-field">
                                    <label>Deadline :</label>
                                    <input type="datetime-local" name="deadline" class="form-control" placeholder="Daedline..." autocomplete="off">
                                </div>
                            </div>

                            <div class="btns">
                                <button class="confirmBtn" type="submit" name="submit">
                                    <span class="btnText"> Confirm </span>
                                    <i class="fa-regular fa-circle-check"></i>
                                </button>

                                <a href="stage_chief.php#documents">
                                    <button class="cancelBtn">
                                        <span class="btnText"> Cancel </span>
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="js/script.js"></script>

</body>

</html>