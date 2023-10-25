<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["chief_name"])) {
    header("Location: login.php");
    exit();
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
        <section class="contact section" id="contact">
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            Contact Admin
                        </h2>
                    </div>
                </div>
                <h3 class="contact-title padd-15">
                    At Your Service
                </h3>
                <div class="row">
                    <!-- Contact info item start -->
                    <div class="contact-info-item padd-15">
                        <div class="icon">
                            <i class="fa-solid fa-phone">

                            </i>
                        </div>
                        <h4>
                            Call On
                        </h4>
                        <p>
                            +212 611 111 111
                        </p>
                    </div>
                    <!-- Contact info item end -->

                    <!-- Contact info item start -->
                    <div class="contact-info-item padd-15">
                        <div class="icon">
                            <i class="fa-solid fa-briefcase">

                            </i>
                        </div>
                        <h4>
                            Bureau
                        </h4>
                        <p>
                            E111
                        </p>

                    </div>
                    <!-- Contact info item end -->

                    <!-- Contact info item start -->
                    <div class="contact-info-item">
                        <div class="icon">
                            <i class="fa-solid fa-envelope-circle-check">

                            </i>
                        </div>
                        <h4>
                            E-mail
                        </h4>
                        <p>
                            contact@uir.ac.ma
                        </p>

                    </div>
                    <!-- Contact info item end -->
                </div>

                <!-- Contact form -->
                <form method="post" action="contact_back.php">
                    <div class="row">
                        <div class="contact-form padd-15">
                            <div class="row">
                                <div class="form-item col-6 padd-15">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name..." name="name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-item col-6 padd-15">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="E-mail..." name="email" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-item col-12 padd-15">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Subject..." name="subject" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-item col-12 padd-15">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message..." name="message" required autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-item col-12 padd-15">
                                    <button type="submit" class="btn" name="sendmail">
                                        Send Message
                                    </button>
                                </div>
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