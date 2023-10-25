<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["chief_name"])) {
    header("Location: login.php");
    exit();
}
require_once('connexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsable</title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/skins/color1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./schedule/css/bootstrap.min.css">
    <link rel="stylesheet" href="./schedule/fullcalendar/lib/main.min.css">

    <link rel="stylesheet" href="./schedule/css/custom_bootstrap.css">

    <script src="./schedule/js/jquery-3.6.0.min.js"></script>
    <script src="./schedule/js/bootstrap.min.js"></script>
    <script src="./schedule/fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            /*font-family: Apple Chancery, cursive;*/
            font-family: "Poppins" sans-serif;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style>


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
        <!-- meeting section Start -->
        <section class="contact section ">
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            Meetings
                        </h2>
                    </div>
                </div>
            </div>
            <!-- calendar Start -->
            <div class="container py-5" id="page-container">
                <div class="row">
                    <div class="col-md-9">
                        <div id="calendar"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="cardt rounded-0 shadow">
                            <div class="card-header bg-gradient bg-primary text-light">
                                <h5 class="card-title">Schedule Meeting</h5>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <form action="save_schedule.php" method="post" id="schedule-form">
                                        <input type="hidden" name="id" value="">
                                        <div class="form-group mb-2">
                                            <label for="title" class="control-label">Title</label>
                                            <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="description" class="control-label">Description</label>
                                            <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description"></textarea>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="start_datetime" class="control-label">Start</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                    <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Event Details Modal -->
            <div class="modal fade" tabstage_chief="-1" data-bs-backdrop="static" id="event-details-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0">
                        <div class="modal-header rounded-0">
                            <h5 class="modal-title">Meeting Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body rounded-0">
                            <div class="container-fluid">
                                <dl>
                                    <dt class="text-muted">Title</dt>
                                    <dd id="title" class="fw-bold fs-4"></dd>
                                    <dt class="text-muted">Description</dt>
                                    <dd id="description" class=""></dd>
                                    <dt class="text-muted">Start</dt>
                                    <dd id="start" class=""></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="modal-footer rounded-0">
                            <div class="text-end">
                                <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                                <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Event Details Modal -->
            <?php
            $schedules = $con->query("SELECT * FROM `schedule_list`");
            $sched_res = [];
            foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
                $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
                $sched_res[$row['id']] = $row;
            }
            ?>
            <?php
            if (isset($con)) $con->close();
            ?>
        </section>
        <!-- js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="schedule/js/script.js"></script>

        <script>
            var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
        </script>
        <script src="./schedule/js/script.js"></script>

</body>

</html>