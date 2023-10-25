<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["chief_name"])) {
    header("Location: login.php");
    exit();
}
$user = $_SESSION['chief_name'];

include 'connexion.php';
$findresult = mysqli_query($con, "SELECT * FROM internship_managers as s Join etablissement as e ON s.id_etablissement = e.id WHERE s.username= '$user'");
if ($res = mysqli_fetch_array($findresult)) {
    $username = $res['username'];
    $fname = $res['first_name'];
    $lname = $res['last_name'];
    $email = $res['c_email'];
    $profile = $res['profile'];
    $age = $res['age'];
    $phone = $res['phone'];
    $address = $res['c_address'];
    $pass = $res['password'];
    $name = $res['nom'];
}
?>
<!DOCTYPE html>
<html>
h

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsable</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/skins/color1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


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
        <!-- Profile section Start -->
        <section class="Contact section">
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            My Profile
                        </h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Personal Informations
                        </h3>
                        <button>
                            <a href="update_profile.php">
                                Update <span class="fa-solid fa-pen"></span>
                            </a>
                        </button>
                    </div>
                    <div class="card-body">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td>
                                        First name
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $fname ?>
                                    </td>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <td>
                                        Last name
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $lname ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Establishment
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $name ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        E-mail
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $email ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Phone
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $phone ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Address
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $address ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Age
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $age ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Profile
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $profile ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Username
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td class="answer">
                                        <?php echo $username ?>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
        </section>s
        </section>
        <!-- js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="js/script.js"></script>

</body>

</html>