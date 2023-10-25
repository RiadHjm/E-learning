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
        <section class="documents section " id="documents">
            <?php include('connexion.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            Documents
                        </h2>
                    </div>
                </div>

                <div>
                    <div class="customers">
                        <div class="card">
                            <form method="POST" action="upload_file.php" enctype="multipart/form-data">
                                <div class="card-header">
                                    <h3>
                                        SHARE A FILE :
                                    </h3>
                                    <button type="submit" name="submit">
                                        Submit <span class=""></span>
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

                        <main>
                            <div class="recent-grid1">
                                <div class="projects">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>
                                                List
                                            </h3>
                                            <a href="New_deadline.php">
                                                <button>
                                                    Add Deadline <span class="fa-solid fa-plus"></span>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <table width="100%">
                                                <thead>
                                                    <tr>
                                                        <td>Documents</td>
                                                        <td>Deadline</td>
                                                        <td>Upload</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $query = "SELECT * FROM doc_deadline WHERE deadline> NOW() ORDER BY deadline ";
                                                        $query_run = mysqli_query($con, $query);
                                                        #$date = new DateTime(date('Y-m-d H:i:s'));

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            foreach ($query_run as $deadline) {

                                                                $sql = "DELETE FROM `doc_deadline` WHERE deadline < NOW() - INTERVAL 6 MONTH";
                                                                $res = mysqli_query($con, $sql);
                                                                if (!$res) {
                                                                    echo "Failed : " . mysqli_error($con);
                                                                }
                                                        ?>
                                                        <td><?= $deadline['document']; ?></td>
                                                        <td><?= $deadline['deadline']; ?></td>
                                                        <td>
                                                            <div class="contact">
                                                                <a href="delete_deadline.php?id=<?= $deadline['id']; ?>" title="Update deadline" data-toggle="tooltip"><span class="fa-solid fa-trash"></span></a>
                                                                <a href="update_deadline.php?id=<?= $deadline['id']; ?>" title="Update deadline" data-toggle="tooltip"><span class="fa-solid fa-pen-to-square"></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                        } else {
                                                            echo "<h5> No Record Found </h5>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <td>Student name</td>
                                                <td>Student id</td>
                                                <td>Supervisor</td>
                                                <td>Documents</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $results_per_page = 5;
                                            $query = "SELECT * FROM students";
                                            $query_run = mysqli_query($con, $query);
                                            $number_of_result = mysqli_num_rows($query_run);
                                            $number_of_page = ceil($number_of_result / $results_per_page);

                                            //determine which page number visitor is currently on  
                                            if (!isset($_GET['page'])) {
                                                $page = 1;
                                            } else {
                                                $page = $_GET['page'];
                                            }
                                            $page_first_result = ($page - 1) * $results_per_page;
                                            $sql = "SELECT * FROM students LIMIT " . $page_first_result . ',' . $results_per_page;
                                            $result = mysqli_query($con, $sql);

                                            while ($student = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?= $student['last_name'] . " " . $student['first_name']; ?></td>
                                                    <td><?= $student['id']; ?></td>
                                                    <td><?= $student['personal_teacher']; ?></td>
                                                    <td>
                                                        <div class="contact">
                                                            <a href="docs.php?id=<?= $student['id']; ?>" title="View documents" data-toggle="tooltip"><span class="fa-regular fa-eye"> </span> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php for ($page = 1; $page <= $number_of_page; $page++) {
                                        echo '<a href = "documents.php?page=' . $page . '">' . $page . ' </a>';
                                    } ?>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </section>
        <!-- js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="js/script.js"></script>

</body>

</html>