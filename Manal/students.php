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
        <section class="Contact section">
            <?php include('connexion.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            Student Management
                        </h2>
                    </div>
                </div>
                <div>
                    <div class="customers">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    ASSIGN STUDENT / SUPERVISOR :
                                </h3>
                                <a href="Assignment.php">
                                    <button>
                                        Assign <span class="fa-regular fa-square-check"></span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <main>
                    <div class="recent-grid">
                        <div class="projects">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        Students' List
                                    </h3>
                                    <div>
                                        <a href="NewStudent.php">
                                            <button>
                                                Add students <span class="fa-solid fa-user-plus"></span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <td>
                                                    Student name
                                                </td>
                                                <td>
                                                    Student id
                                                </td>
                                                <td>
                                                    Field
                                                </td>
                                                <td>
                                                    Level
                                                </td>
                                                <td>
                                                    Internship status
                                                </td>
                                                <td>
                                                    Superviser
                                                </td>

                                                <td>
                                                    Email
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $results_per_page = 10;
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
                                                    <td><?php echo $student['first_name'] . " " . $student['last_name']; ?></td>
                                                    <td><?php echo $student['id']; ?></td>
                                                    <td><?php echo $student['field']; ?></td>
                                                    <td><?php echo $student['level']; ?></td>
                                                    <td><span class="status purple"></span><?php echo $student['internship_status']; ?></td>
                                                    <td><?php echo $student['personal_teacher']; ?></td>
                                                    <td><?php echo $student['email']; ?></td>
                                                    <td><a href="delete_student.php?id=<?php echo $student['id'] ?>" title="Delete student" data-toggle="tooltip" style="color:#000;"><span class="fa-solid fa-trash"></span></a></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php for ($page = 1; $page <= $number_of_page; $page++) {
                                        echo '<a href = "students.php?page=' . $page . '">' . $page . ' </a>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </section>
        <!-- js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="js/script.js"></script>

</body>

</html>