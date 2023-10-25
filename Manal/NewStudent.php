<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["chief_name"])) {
    header("Location: login.php");
    exit();
}

require 'connexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

if (isset($_POST["Import"])) {
    //random password function

    function CreatePass($long_pass)
    {
        $consonnes = "bcdfghjklmnpqrstvwxz";
        $voyelles = "aeiouy";
        $mdp = '';
        for ($i = 0; $i < $long_pass; $i++) {
            if (($i % 2) == 0) {
                $mdp = $mdp . substr($voyelles, rand(0, strlen($voyelles) - 1), 1);
            } else {
                $mdp = $mdp . substr($consonnes, rand(0, strlen($consonnes) - 1), 1);
            }
        }

        return $mdp;
    }
    // end function

    //read excel   
    echo $filename = $_FILES["file"]["tmp_name"];


    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($Data = fgetcsv($file, 10000, ",")) !== FALSE) {
            $password = CreatePass(8);
            $student_mail = $Data[5];
            $student_fname = $Data[0];
            $student_lname = $Data[1];
            $username = $student_fname . ' ' . $student_lname;

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $to = 'manal.ch226@gmail.com';
            $from = 'bot.uir.ad@gmail.com';

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $from;
            $mail->Password = "tnluosbbmksvogep";
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($from);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = 'Mot de passe de votre compte';
            $mail->Body = 'Bonjour ' . $student_fname . ' ' . $student_lname . ',<br>Voici le mot de passe de votre compte : ' . $password . '.<br><br>Cordialement.';
            $mail->send();


            /*$sql = "INSERT INTO students(`id`, `first_name`, `last_name`, `level`, `field`, `superviser`, `internship_stat`, `email`, `password`) values(NULL,'$Data[0]','$Data[1]','$Data[2]','$Data[3]',NULL,'$Data[4]','$Data[5]','$password')";*/

            $sql = "INSERT INTO students(`id`, `username`, `password`, `first_name`, `last_name`, `email`, `personal_teacher`, `profile`, `field`, `description`, `day`, `month`, `year`, `nationality`, `faculty`, `phone_number`, `city`, `country`, `current_university`, `uni_loc`, `gpa`, `highschool`, `profile_pic`, `files`, `level`, `internship_status`) VALUES (NULL,'$username','$password','$Data[0]','$Data[1]','$Data[5]',NULL,'student','$Data[3]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$Data[2]','$Data[4]')";

            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "<script type=\"text/javascript\">
                            alert(\"Invalid File:Please Upload CSV File.\");
                      </script>";
            }
        }
        fclose($file);
        //throws a message if data successfully imported to mysql database from excel file
        echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"students.php\"
                    </script>";
    }
    mysqli_close($con);
}
?>
!DOCTYPE html>
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

                <a href="/projet_int/cheif_welcome.php" class="typing">
                    <span>R</span>esponsable
                </a>

            </div>
            <div class="nav-toggler">
                =<!-- toggler ??? -->
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
        <!-- Create student section Start -->
        <section class="Contact section ">

            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            Create students accounts
                        </h2>
                    </div>
                </div>
                <div class="card">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="card-header">
                            <h3>
                                Choose Excel File :
                            </h3>
                            <button type="submit" name="Import">
                                Create accounts <span class=""></span>
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="customer">
                                <div class="info">
                                    <div>
                                        <input type="file" name="file">
                                    </div>
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