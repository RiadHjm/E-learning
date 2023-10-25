<?php
    session_start();
    @include 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpMailer/src/Exception.php';
    require 'phpMailer/src/PHPMailer.php';
    require 'phpMailer/src/SMTP.php';
    
    $username = $_SESSION['professor_name'];

    $req = "SELECT description FROM professors WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $description = $row['description'];

    $req = "SELECT studies FROM professors WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $desc = $row['studies'];

    $req = "SELECT expertise FROM professors WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $certif = $row['expertise'];

    $req = "SELECT linkedin FROM professors WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $linkedin = $row['linkedin'];

    $req = "SELECT first_name FROM professors WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $first_name = $row['first_name'];

    $req = "SELECT last_name FROM professors WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $last_name = $row['last_name'];

    $req = "SELECT password FROM professors WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $password = $row['password'];
    


    if($username == 'Mehdi Najib')
    {
        $profile_pic = 'Pics/mehdinajib.jpeg';
    }
    elseif($username == 'Mustapha Oudani')
    {
        $profile_pic = 'prof/oudani.jpeg';
    }
    elseif($username == 'Bassma Guermah')
    {
        $profile_pic = 'prof/bassma.jpeg';
    }
    elseif($username == 'Anass Sebbar')
    {
        $profile_pic = 'Pics/anass.png';
    }
    elseif($username == 'Kenza Oufaska')
    {
        $profile_pic = 'prof/oufaska.jpeg';
    }
    elseif($username == 'Majdoulayne Hanifi')
    {
        $profile_pic = 'prof/hanifi.jpeg';
    }
    elseif($username == 'Youness Moukafih')
    {
        $profile_pic = 'prof/moukafih.jpeg';
    }


    if(isset($_POST['submit']))
    {
        $msg = $_POST['msg'];

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $to = 'riad.elhajjame@uir.ac.ma';

        $subject = 'Contact Us - Professor -';
        $message = 'Hey, the Professor ' . $username . ' wants to send you a msg you. <br> That\'s what they said :  <br>';
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

    $statusMsg = '';
    // File upload path
    $targetDir = "files/";
    if(isset($_POST['sub']) && !empty($_FILES['file']['name'])){
        $firstName = $_POST['usname'];
        $fName = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir . $fName . " - " . $firstName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','pdf', 'zip', 'rar', 'txt', 'docx', 'doc', 'xlsx', 'xls', 'pptx', 'ppt', 'csv', 'php', 'html', 'css', 'js', 'c');
        if(in_array($fileType, $allowTypes))
        {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                // Insert image file name into database
                $insert = "INSERT INTO `teacher_to_st_files`(`teacher_name`, `to_student`, `file`) VALUES ('$username','$firstName','$fName')";
                $res = mysqli_query($conn, $insert);
                if ($res) 
                {
                    // INSERT statement was successful
                    echo "Insert was successful";
                } 
                else 
                {
                    // INSERT statement failed
                    echo "Insert failed: " . mysqli_error($conn);
                }
                if($insert)
                {
                    $statusMsg = "The file ".$fName. " has been uploaded successfully.";
                }else
                {
                    $statusMsg = "File upload failed, please try again.";
                } 
            }
            else
            {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & PDF files are allowed to upload.';
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Interface</title>
    <link rel="icon" type="image/x-icon" href="./Pics/logo-design.png">
    <script src="https://kit.fontawesome.com/0fb231b4af.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="professorr.css">
</head>

<body>
    <!-- header section starts  -->
    <header>
        <a href="professor.php" class="logo"><i class="fas fa-graduation-cap"></i>UIR</a>
        <nav class="navbar">
            <ul>
                <li><a href="professor.php" class="active">home</a></li>
                <li><a href="#about">about</a></li>
                <li><a href="#teacher">teacher</a></li>
                <li><a href="#review">students</a></li>
                <li><a href="#course">file</a></li>
                <li><a href="#contact">contact</a></li>
            </ul>
        </nav>
        <div class="fas fa-bars"></div>
    </header>
    <!-- header section ends -->


    <!-- home section starts  -->
    <section class="home" id="home">

        <div class="content">
            <h1>WELCOME <?php echo $username; ?></h1>
            <p> <?php echo $description; ?> </p>
            <a href="#teacher"><button>discover more</button></a>
        </div>

        <div class="box-container">
            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <h3>Studies</h3>
                <p><?php echo $desc; ?></p>
            </div>

            <div class="box">
                <i class="fas fa-fire"></i>
                <h3>Expertise</h3>
                <p><?php echo $certif; ?></p>
            </div>

            <!-- <div class="box">
                <i class="fas fa-award"></i>
                <h3>certifications</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero, sit!</p>
            </div> -->
        </div>
    </section>
    <!-- home section ends -->


    <!-- about section starts  -->
    <section class="about" id="about">

        <h1 class="heading">about us</h1>
        <h3 class="title">welcome to your account</h3>

        <div class="row">
            <div class="content">
                <h3>A quality of teaching forthe benefit of our students</h3>
                <p>As a professor, you will have the ability to create an account, view and list your account information, and make any necessary updates to your information. This account will provide you with access to a list of students that you are assigned to mentor. As a professor, you will also be able to download reports and documents submitted by students. This system provides you with the tools and resources needed to effectively manage your mentorship responsibilities, while allowing you to stay organized and up-to-date on the progress of your students. </p>
            </div>

            <div class="image">
                <img src="Pics/Prof.svg" alt="">
            </div>
        </div>
    </section>
    <!-- about section ends -->


    <!-- teacher section starts  -->
    <section id="teacher" class="teacher">
        <h1 class="heading">Profile</h1>
        <h3 class="title">Account : <?php echo $username; ?></h3>

        <div class="card-container">
            <div class="card">
                <img src="<?php echo $profile_pic ?>" alt="">
                <h3><?php echo $username; ?></h3>
                <p><?php echo $desc; ?></p>
                <div class="icons">
                    <a href="<?php echo $linkedin; ?>" class="fab fa-linkedin" target="_blank"></a>
                    <a href="" class="fab plus" target="_blank">Plus</a>

                </div>
            </div>

            <div class="card">
                <img src="prof/admin.jpg" alt="">
                <h3>Admin</h3>
                <p>Manages a student and teacher platform. would be responsible for overseeing and maintaining the smooth operation of the platform.</p>
                <div class="icons">
                    <a href="https://web.facebook.com/riad.elhajjame" class="fab fa-facebook-f" target="_blank"></a>
                    <a href="https://www.instagram.com/__ri_art/" class="fab fa-instagram" target="_blank"></a>
                </div>
            </div>
        </div>
    </section>
    <!-- teacher section ends -->


    <!-- student section starts  -->
    <?php
        $req = "SELECT * FROM `teacher_st` WHERE prof_name='$username'";
        $res = mysqli_query($conn, $req);
        $st_student = array();
        $st_pic = array();
        $description_st = array();
        $st_stars = array();

        while($row = mysqli_fetch_assoc($res)) 
        {
            $st_student[] = $row['st_name'];
            $st_pic[] = $row['profile_st'];
            $description_st[] = $row['description_st'];
            $st_stars[] = $row['rating'];
        }
    ?>
    <section id="review" class="review">

        <h1 class="heading">Students u're with : </h1>
        <h3 class="title">U can see their ratings too (stars)</h3>

        <div class="box-container">
            <?php
                for ($i=0; $i < count($st_student); $i++) 
                { 
                    echo '<div class="box">';
                        echo '<img src="'.$st_pic[$i].'" alt="">';
                        echo '<h3>'.$st_student[$i].'</h3>';
                        echo '<p>'.$description_st[$i].'</p>';
                        echo '<div class="stars">';
                        for ($j=0; $j < $st_stars[$i]; $j++) 
                        {
                            echo '<i class="fas fa-star"></i>';
                        }
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </section>
    <!-- review section ends -->

    <!-- course section starts  -->

    <section id="course" class="course">
        <div class="bod">
            <section id="fileUpload">
                <h1>- Files recieved by your students.. - </h1>
                                                    
                <div class="progressArea">
                    <?php
                        $query = "SELECT `file`, `student_name` FROM `files` WHERE `teacher_name` = '$username'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) 
                        {
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
                                $fName = $row['file'];
                                $sName = $row['student_name'];
                            ?>
                            <!-- Display the file names -->
                            <div class="row complete">  
                                <div class="cont">
                                    <i class="ri-file-cloud-line"></i>
                                    <div class="detail">
                                        <a href="files/<?php echo $fName; ?>" class="name" download><?php echo $fName . ' - ' . $sName; ?></a>
                                    </div>
                                </div>
                                <i class="ri-checkbox-circle-line"></i>
                            </div>
                            <?php
                            }
                        }
                        ?>
                    </div> 
            </section>
        </div>
    </section>
    <!-- course section ends -->


    <!-- contact section starts  -->
    <section class="contact" id="contact">
        <h1 class="heading">contact us</h1>
        <h3 class="title">Any problem ? Lets talk, the admin is gonna recieve your message !</h3>
        <div class="row">

            <div class="image">
                <img src="Pics/contact.svg" alt="">
            </div>

            <div class="form-container">
                <form action="" method="POST">
                    <input type="text" placeholder="full name" value="<?php echo $username ?>">
                    <textarea name="msg" id="" cols="30" rows="10" placeholder="message"></textarea>
                    <input type="submit" value="message" name="submit">
                </form>
            </div>
        </div>
    </section>
    <!-- contact section ends -->

    <section class="footer">
        <div class="icons">
            <a href="https://www.facebook.com/riad.elhajjame" class="fab fa-facebook-f" target="_blank"></a>
            <a href="https://www.instagram.com/__ri_art/" class="fab fa-instagram" target="_blank"></a>
        </div>
        <div class="credit">created by <span>Riad EL HAJJAME</span> | © All rights reserved! </div>
    </section>

    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- custom js file link  -->
    <script src="professors.js"></script>

    
</body>
</html>