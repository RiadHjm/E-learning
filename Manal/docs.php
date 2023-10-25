<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["chief_name"])){
    header("Location: login.php");
    exit(); 
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
                </li>               <li>
          <a href="profile.php" class="active">
            <i class="fa-solid fa-user">
                
            </i>
            My profile
          </a>
        </li>
        <li>
          <a href="logout.php" class="active" id="logout" >
            <i class="fa-solid fa-right-from-bracket">
            </i>
            Log out
          </a>
        </li>
            </ul>

        </div>
    <!-- Create student section Start -->
        <section class="documents section ">
        <?php 
        require 'connexion.php';
        $id = $_GET['id'];
        $query = "SELECT first_name, last_name FROM students where id= '$id'";
        $result = mysqli_query($con,$query);
        if($res = mysqli_fetch_array($result))
        {
            $fname = $res['first_name'];   
            $lname = $res['last_name']; 
}
        ?>
            <div class="container">
                <div class="row">
                    <div class="section-title padd-15">
                        <h2>
                            <?php echo $fname . " " . $lname; ?> documents
                        </h2>
                    </div>
                </div>
    <!--display documents-->
                <div class="row">
                    <div class="form-item col-6 padd-15">
                        <div class="form-group">
                            <div class="form-item col-6 padd-15">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Documents</th>
                                            <th>uploaded on</th>
                                            <th>action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT document,uploaded_on FROM documents where student_id = $id ORDER BY `uploaded_on` DESC";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $doc) {
                                          $fileURL = 'uploads/'.$doc["document"];
                                    ?>
                                            <tr>
                                                <td><a href="uploads/<?php echo $doc['document']; ?>" target="_blank"><?php echo $doc['document']; ?></a></td>
                                                <td><?php echo $doc['uploaded_on']; ?></td>
                                                <td><a href="download.php?path=uploads/<?php echo $doc['document']; ?>"><i class="fa-solid fa-download"></i></a></td>
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
                </div>
            </div>
    </section>
    <!-- js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>

</html>