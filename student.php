<?php
    @include 'config.php';
    session_start();
    
    $username = $_SESSION['student_name'];

    $req = "SELECT profile_pic FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $im_pth = $row['profile_pic'];

    $req = "SELECT description FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $description = $row['description'];

    $req = "SELECT personal_teacher FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $teacher = $row['personal_teacher'];

    $req = "SELECT field FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $field = $row['field'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0fb231b4af.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="studentt.css">
    <link rel="icon" type="image/x-icon" href="./Pics/logo-design.png">
    <title><?php echo $username; ?> / Student </title>
</head>
<body>
    <header class="header">
        <a href="student.php" class="logo">
            <i class="fa-solid fa-graduation-cap"></i> UIR
        </a>

        <div id="menuBtn" class="fas fa-bars"></div>       
        
        <nav class="navbar">
            <ul class="scrollable">
                <li class="sc"><a href="profile.php" class="lnk">Profile +</a></li>
                    <ul class="scroll">
                        <li class="scr"><a href="">Show Profile</a></li>
                        <li class="scr"><a href="">Manage Settings</a></li>
                    </ul>
                <li class="sc"><a href="docs.php" class="lnk">Docs</a></li>
                <li class="sc"><a href="internship_files.php" class="lnk">Internship Files</a></li>
                <li class="sc"><a href="about.html" class="lnk">About</a></li>
                <li class="sc"><a href="contact.php" class="lnk">Contact Us</a></li>
            </ul>   
        </nav>
    </header>

    <section class="home">
        <div class="image">
            <img src="Pics/home-img.png" alt="">
        </div>
        <div class="content">
            <h3>Get your Docs</h3>
            <p>Here is the place so you can download every doc sent by your stage chief.. </p>
            <a href="docs.php" class="btn">Get My Docs</a>
        </div>
    </section>

    <div class="bod">
        <div class="container">
            <div class="drop">
                <div class="cont">
                    <h2><?php echo $username; ?></h2>
                    <p><?php echo $description; ?></p>
                    <a href="profile.php"><?php echo $field; ?></a>
                </div>
            </div>
            <div class="drop">
                <div class="cont">
                    <h2><?php echo $teacher; ?></h2>
                    <p>
                        <?php echo $teacher; ?> is your personal professor, he gonna be the one responsible for all your internship files.
                        You can recieve from him any document related with your internship, as he can also send him reports etc... 
                    </p>
                </div>
            </div>
            <div class="drop">
                <div class="cont">
                    <h2>Admin</h2>
                    <p>
                        Your admin is Riad EL HAJJAME, he is the one responsible if anything happens on the website. If you need any more information please contact him
                        using his email adress : riad.elhajjame@uir.ac.ma, or by phone : +212 7 08 18 79 43. 
                    </p>
                </div>
            </div>
        </div>
    </div>
    

    <section class="categ">
        <a href="profile.php" class="box">
            <img src="Pics/main-course-1.png" alt="">
            <h3>Show Profile</h3>
        </a>
        <a href="contact.php" class="box">
            <img src="Pics/aa.png" alt="">
            <h3>Contact Us</h3>
        </a>
        <a href="about.html" class="box">
            <img src="Pics/main-course-4.png" alt="">
            <h3>About Us</h3>
        </a>
        <a href="" class="box">
            <img src="Pics/dd.png" alt="">
            <h3>Internship files</h3>
        </a>
    </section>




    <section class="footer">
        <div class="boxContainer">
            <div class="box">
                <h3>Explore</h3>
                <a href="student.php"><i class="fas fa-arrow-right"></i> Home</a>
                <a href="profile.php"><i class="fas fa-arrow-right"></i> Profile</a>
                <a href="docs.php"><i class="fas fa-arrow-right"></i> Docs</a>
                <a href="internship_files.php"><i class="fas fa-arrow-right"></i> Internship Files</a>
                <a href="about.html"><i class="fas fa-arrow-right"></i> About</a>
                <a href="contact.php"><i class="fas fa-arrow-right"></i> Contact Us</a>
            </div>

            <div class="box">
                <h3>Categories</h3>
                <a href="#"><i class="fas fa-arrow-right"></i> Show Profile</a>
                <a href="#"><i class="fas fa-arrow-right"></i> Manage Settings</a>
            </div>

            <div class="box">
                <h3>Technology</h3>
                <a href="#"><i class="fas fa-arrow-right"></i>HTML</a>
                <a href="#"><i class="fas fa-arrow-right"></i>CSS</a>
                <a href="#"><i class="fas fa-arrow-right"></i>JavaScript</a>
            </div>

            <div class="box">
                <h3>Follow Us</h3>
                <a href="https://web.facebook.com/riad.elhajjame" target="_blank"><i class="fab fa-facebook-f"></i>Facebook</a>
                <a href="https://www.instagram.com/__ri_art/" target="_blank"><i class="fab fa-instagram"></i>Instagram</a>
            </div>
        </div>

        <div class="credit">
            Created By <span>Riad ELHAJJAME</span> | © All rights reserved! 
        </div>
    </section>
    <script src="sstudent.js"></script>
    
    <style>
        .container .drop:nth-child(1):hover
        {
            background-image: url(<?php echo $im_pth; ?>);
            background-position: center center;
            background-size: cover;
            opacity: 0.7;
        }
        .container .drop:nth-child(1):hover h2, .container .drop:nth-child(1):hover p, .container .drop:nth-child(1):hover a, .container .drop:nth-child(1):hover::before, .container .drop:nth-child(1):hover::after
        {
            visibility: hidden; 
        }
        .container .drop h2, .container .drop p, .container .drop a, .container .drop::before, .container .drop::after
        {
            transition: ease 0s;
        }


        .container .drop:nth-child(3):hover
        {
            background-image: url('Pics/admin.jpg');
            background-position: center center;
            background-size: cover;
            opacity: 0.7;
        }
        .container .drop:nth-child(3):hover h2, .container .drop:nth-child(3):hover p, .container .drop:nth-child(3):hover::before, .container .drop:nth-child(3):hover::after
        {
            visibility: hidden; 
        }
        
        <?php 
            if($teacher == 'Mehdi Najib')
            {
        ?>

        .container .drop:nth-child(2):hover
        {
            background-image: url('Pics/mehdinajib.jpeg');
            background-position: center center;
            background-size: cover;
            opacity: 0.8;
        }

        .container .drop:nth-child(2):hover h2, .container .drop:nth-child(2):hover p, .container .drop:nth-child(2):hover::before, .container .drop:nth-child(2):hover::after
        {
            visibility: hidden; 
        }

        <?php
            }
        ?>

        <?php 
            if($teacher == 'Anass Sebbar')
            {
        ?>

        .container .drop:nth-child(2):hover
        {
            background-image: url('Pics/anass.png');
            background-position: center center;
            background-size: cover;
            opacity: 0.7;
        }

        .container .drop:nth-child(2):hover h2, .container .drop:nth-child(2):hover p, .container .drop:nth-child(2):hover::before, .container .drop:nth-child(2):hover::after
        {
            visibility: hidden; 
        }

        <?php
            }
        ?>
    </style>
</body>
</html>