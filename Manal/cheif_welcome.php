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

        <!-- Aside? End -->

        <!-- Main Content Start -->

        <div class="main-content">

            <!-- Home section Start -->

            <section class="service active section " id="welcome">

                <!-- Home -->
                <div class="container">
                    <div class="row">
                        <div class="section-title padd-15">
                            <h2>
                                Welcome
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Service item start -->
                        <div class="service-item padd-15">
                            <a href="/projet_int/students.php" class="active">
                                <div class="service-item-inner">
                                    <div class="icon">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <h4>
                                        Student Management
                                    </h4>
                                    <p></p>
                                </div>
                            </a>
                        </div>
                        <!-- Service item end -->
                        <!-- Service item start -->
                        <div class="service-item padd-15">
                            <a href="/projet_int/documents.php" class="active">
                                <div class="service-item-inner">
                                    <div class="icon">
                                        <i class=" fa-solid fa-folder-open "></i>
                                    </div>
                                    <h4>
                                        Documents Management
                                    </h4>
                                    <p></p>
                                </div>
                            </a>
                        </div>
                        <!-- Service item end -->
                        <!-- Service item start -->
                        <div class="service-item padd-15">
                            <a href="/projet_int/dashboard.php" class="active">
                                <div class="service-item-inner">
                                    <div class="icon">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <h4>
                                        Dashboard
                                    </h4>
                                    <p></p>
                                </div>
                            </a>
                        </div>
                        <!-- Service item end -->
                        <!-- Service item start -->
                        <div class="service-item padd-15">
                            <a href="/projet_int/meetings.php" class="active">
                                <div class="service-item-inner">
                                    <div class="icon">
                                        <i class="fa-solid fa-handshake"></i>
                                    </div>
                                    <h4>
                                        Meetings Management
                                    </h4>
                                    <p></p>
                                </div>
                            </a>
                        </div>
                        <!-- Service item end -->
                    </div>
                </div>

            </section>
        </div>
    </div>
</body>

</html>