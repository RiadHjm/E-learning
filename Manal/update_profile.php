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


if (isset($_POST['update_profile'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $address = $_POST['c_address'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $etab = $_POST['etab'];

    $query = "UPDATE internship_managers SET `first_name`='$fname',`last_name`='$lname',`age`='$age',`id_etablissement`=(SELECT id FROM etablissement WHERE nom = '$etab'),`phone`='$phone',`c_address`='$address',`c_email`='$email',`username`='$username',`password`='$pass' WHERE username = '$user' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "<script type=\"text/javascript\">
                    alert(\"Profile updated successfully.\");
                    window.location = \"profile.php\"
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
        <section class="Contact section ">
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            My Profile
                        </h2>
                    </div>
                </div>
                <div>
                    <?php

                    $sql = "SELECT * FROM internship_managers as s JOIN etablissement as e ON s.id_etablissement = e.id WHERE s.username= '$user' LIMIT 1";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <form method="POST" action="">
                        <div class="form first">
                            <div class="details personal">
                                <span class="title"> Personal Details : </span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>First Name :</label>
                                        <input type="text" name="fname" value="<?php echo $row['first_name'] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Last Name :</label>
                                        <input type="text" name="lname" value="<?php echo $row['last_name'] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>E-mail :</label>
                                        <input type="text" name="email" value="<?php echo $row['c_email'] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Phone :</label>
                                        <input type="text" name="phone" value="<?php echo $row['phone'] ?> ">
                                    </div>
                                    <div class="input-field">
                                        <label>Age :</label>
                                        <input type="text" name="age" value="<?php echo $row['age'] ?> ">
                                    </div>
                                    <div class="input-field">
                                        <label>Address :</label>
                                        <input type="text" name="c_address" value="<?php echo $row['c_address'] ?> ">
                                    </div>
                                    <div class="input-field">
                                        <label>Establishment :</label>
                                        <input type="text" name="etab" value="<?php echo $row['nom'] ?> ">
                                    </div>
                                    <div class="input-field">
                                        <label>Username :</label>
                                        <input type="text" name="username" value="<?php echo $row['username'] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Password :</label>
                                        <input type="text" name="password" value="<?php echo $row['password'] ?>">
                                    </div>

                                </div>

                                <div class="btns">
                                    <button class="confirmBtn" type="submit" name="update_profile">
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
            </div>

        </section>
        <!-- js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="js/script.js"></script>

</body>

</html>