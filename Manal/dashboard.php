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
                            Dasboard
                        </h2>
                    </div>
                </div>
                <main>
                    <div class="cards">
                        <div class="card-single">
                            <div>
                                <h1>
                                    <?php
                                    $query = "SELECT id FROM students";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_num_rows($result);
                                        if ($result) {
                                            echo "$row";
                                        }
                                        mysqli_free_result($result);
                                    }
                                    ?>
                                </h1>
                                <span>
                                    Student
                                </span>
                            </div>
                            <div>
                                <span class="fa-solid fa-user-group"></span>
                            </div>
                        </div>

                        <div class="card-single">
                            <div>
                                <h1>
                                    <?php
                                    $query = "SELECT * FROM doc_deadline JOIN documents ON doc_deadline.id = documents.deadline_id WHERE doc_deadline.deadline > documents.uploaded_on AND doc_deadline.deadline = (SELECT deadline FROM doc_deadline ORDER BY deadline DESC LIMIT 1)";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_num_rows($result);
                                        if ($result) {
                                            echo "$row";
                                        }
                                        mysqli_free_result($result);
                                    }
                                    ?>
                                </h1>
                                <span> Respect last deadline </span>
                            </div>
                            <div>
                                <span class="fa-solid fa-circle-check"></span>
                            </div>
                        </div>

                        <div class="card-single">
                            <div>
                                <h1>
                                    <?php
                                    $query = "SELECT * FROM doc_deadline JOIN documents ON doc_deadline.id = documents.deadline_id WHERE doc_deadline.deadline < documents.uploaded_on AND doc_deadline.deadline = (SELECT deadline FROM doc_deadline ORDER BY deadline DESC LIMIT 1)";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_num_rows($result);
                                        if ($result) {
                                            echo "$row";
                                        }
                                        mysqli_free_result($result);
                                    }
                                    ?>
                                </h1>
                                <span>Overdue the deadline</span>
                            </div>
                            <div>
                                <span class="fa-solid fa-circle-xmark"></span>
                            </div>
                        </div>

                        <div class="card-single">
                            <div>
                                <h1>
                                    <?php
                                    $query = "SELECT DISTINCT personal_teacher FROM students;";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        $row = mysqli_num_rows($result);
                                        if ($result) {
                                            echo "$row";
                                        }
                                        mysqli_free_result($result);
                                    }
                                    ?>
                                </h1>
                                <span> Superviser </span>
                            </div>
                            <div>
                                <span class="fa-solid fa-user-tie"></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    include 'connexion.php';

                    if (isset($_POST['submit'])) {
                        $search = $_POST['valueToSearch'];
                        $query = "SELECT * FROM students WHERE first_name like '%$search%' or last_name like '%$search%' or level like '%$search%' or field like '%$search%' or personal_teacher like '%$search%' or internship_status like '%$search%' ";
                        $search_result = mysqli_query($con, $query);
                    } else {
                        $query = "SELECT * FROM students";
                        $search_result = mysqli_query($con, $query);
                    }
                    ?>
                    <div class="recent-grid">
                        <div class="projects">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        List
                                    </h3>
                                    <form class="form-horizontal" action="" method="post">
                                        <div class="search-wrapper">
                                            <span class="fa-solid fa-magnifying-glass"></span>
                                            <input type="text" name="valueToSearch" placeholder="Search here...">
                                            <input type="submit" name="submit" value="Filter">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <td>Student name</td>
                                                <td>Student id</td>
                                                <td>Field</td>
                                                <td>Level</td>
                                                <td>Internship</td>
                                                <td>Superviser</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($search_result)) : ?>
                                                <tr>
                                                    <td> <?php echo $row['first_name'] . " " . $row['last_name']; ?> </td>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['field']; ?></td>
                                                    <td><?php echo $row['level']; ?></td>
                                                    <td> <span class="status purple"></span> <?php echo $row['internship_status']; ?> </td>
                                                    <td> <?php echo $row['personal_teacher']; ?> </td>
                                                </tr>
                                            <?php endwhile;  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="recent-grid">
                        <div class="projects">
                            <div class="card">
                                <div class="card-header">
                                    <h3>
                                        List of students who respect deadline
                                    </h3>
                                    <form class="form-horizontal" action="" method="post">
                                        <div class="search-wrapper">
                                            <span class="fa-solid fa-magnifying-glass"></span>
                                            <input type="text" name="value" placeholder="Search document..">
                                            <input type="submit" name="doc_search" value="Filter">
                                        </div>
                                    </form>
                                </div>
                                <?php
                                include 'connexion.php';

                                if (isset($_POST['doc_search'])) {
                                    $searching = $_POST['value'];
                                    $req = "SELECT de.deadline as deadline, s.first_name as fname, s.last_name as lname, s.id as id, do.uploaded_on as upload, do.document as doc FROM documents as do Join students as s ON s.id = do.student_id JOIN doc_deadline as de On de.id = do.deadline_id where do.document like '%$searching%'";
                                    $output = mysqli_query($con, $req);
                                ?>
                                    <div class="card-body">
                                        <table width="100%">
                                            <thead>
                                                <tr>
                                                    <td>Student name</td>
                                                    <td>Student id</td>
                                                    <td>Respect deadline</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($rec = mysqli_fetch_array($output)) : ?>
                                                    <tr>
                                                        <td> <?php echo $rec['fname'] . " " . $rec['lname']; ?> </td>
                                                        <td><?php echo $rec['id']; ?></td>
                                                        <td><?php if ($rec['deadline'] > $rec['upload']) {
                                                                echo "yes";
                                                            } else {
                                                                echo "no";
                                                            }

                                                            ?>
                                                        </td>
                                                <?php endwhile; } ?>
                                                    </tr>
                                            </tbody>
                                        </table>
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