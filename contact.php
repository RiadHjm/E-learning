<?php 
    @include 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpMailer/src/Exception.php';
    require 'phpMailer/src/PHPMailer.php';
    require 'phpMailer/src/SMTP.php';

    session_start();
    $username = $_SESSION['student_name'];

    $req = "SELECT field FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $field = $row['field'];

    if(isset($_POST['sub']))
    {
        $msg = $_POST['msg'];

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $to = 'riad.elhajjame@uir.ac.ma';

        $subject = 'Contact Us - Student -';
        $message = 'Hey, the Student ' . $username . ' : ' . $field . ' wants to contact you. <br> That\'s what they said :  <br>';
        $message .= '<br>' . $msg . '<br>';
        $from = 'bot.uir.ad@gmail.com';

        $mail -> Host = 'smtp.gmail.com';
        $mail -> SMTPAuth = true;
        $mail -> Username = $from;
        $mail -> Password = "tnluosbbmksvogep";
        $mail -> SMTPSecure = 'ssl';
        $mail -> Port = 465;
        $mail -> setFrom($from, 'UIR BOT Admin');
        $mail -> addAddress($to);
        $mail -> isHTML(true);
        $mail -> Subject = $subject;
        $mail -> Body = $message;
        $mail -> send();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0fb231b4af.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="contact.css">
    <link rel="icon" type="image/x-icon" href="./Pics/logo-design.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title><?php echo $username; ?> / Contact-Us</title>
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



    <section class="heading">
        <h3>Contact Us</h3>
        <p>
            <a href="student.php">Home >></a>
            Contaact Us
        </p>
    </section>

    <section class="contact">
        <div class="icons-container">
            <div class="icons">
                <i class="fas fa-phone"></i>
                <h3>Our Phone Number</h3>
                <p>+212 7 08 18 79 43</p>
                <p>+212 6 49 06 55 85</p>
            </div>

            <div class="icons">
                <i class="fas fa-envelope"></i>
                <h3>Our e-mail</h3>
                <p>riad.elhajjame@uir.ac.ma</p>
                <p>riad20011@gmail.com</p>
            </div>

            <div class="icons">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Adress</h3>
                <p>UIR - Université Internationale de RABAT - Technopolice</p>
                <p>Rocade Rabat-Salé</p>
                <p>11 100 Sala el Jadida</p>
            </div>
        </div>

        <div class="row">
            <form action="" method="POST">
                <h3>Get in Touch</h3>
                <input type="text" class="box" name="name" value="<?php echo $username; ?>" >
                <textarea name="msg" id="" cols="30" rows="10" placeholder="Your message here.."></textarea>
                <input type="submit" name="sub" value="Send Message" class="btn">
            </form>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3308.3395951240773!2d-6.72798058445322!3d33.
                        98381002878004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7406c402501ad%3A0x8c27f36f5c2f5a6c!2sUniversit%C3%A9%20
                        Internationale%20de%20Rabat!5e0!3m2!1sfr!2sma!4v1674498700735!5m2!1sfr!2sma" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>



    <section class="footer">
        <div class="boxContainer">
            <div class="box">
                <h3>Explore</h3>
                <a href="student.php"><i class="fas fa-arrow-right"></i> Home</a>
                <a href="profile.php"><i class="fas fa-arrow-right"></i> Profile</a>
                <a href="docs.php"><i class="fas fa-arrow-right"></i> Docs</a>
                <a href="internship_files.php"><i class="fas fa-arrow-right"></i> Internship Files</a>
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
                <a href="https://web.facebook.com/riad.elhajjame" target="_blank"><i
                        class="fab fa-facebook-f"></i>Facebook</a>
                <a href="https://www.instagram.com/__ri_art/" target="_blank"><i
                        class="fab fa-instagram"></i>Instagram</a>
            </div>
        </div>

        <div class="credit">
            Created By <span>Riad ELHAJJAME</span> | © All rights reserved!
        </div>
    </section>

    <script src="contact.js"></script>

</body>
</html>