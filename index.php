<?php
    @include 'config.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpMailer/src/Exception.php';
    require 'phpMailer/src/PHPMailer.php';
    require 'phpMailer/src/SMTP.php';

    error_reporting(0);

    session_start();
    if(isset($_POST['subIn']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $profile = $_POST['profile'];
    
        $req = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $req);
    
        if(mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_array($res);
            if($row['profile'] == 'admin')
            {
                $_SESSION['admin_name'] = $row['username'];
                header('location:admin.php');
            }
            elseif($row['profile'] == 'professor')
            {
                $_SESSION['professor_name'] = $row['username'];
                header('location:professor.php');
            }
            elseif($row['profile'] == 'student')
            {
                $_SESSION['student_name'] = $row['username'];
                header('location:student.php');
            }
            elseif($row['profile'] == 'stage chief')
            {
                $_SESSION['chief_name'] = $row['username'];
                header('location:Manal/cheif_welcome.php');
            }
        }
        else 
        {
            $error[] = 'Incorrect Username or Password .. ';
        }
    };

    if(isset($_POST['subUp']))
    {
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $cPass = $_POST['cpass'];
        $userType = $_POST['userType'];
        $desc = $_POST['desc'];
        $uni = $_POST['uni'];
        $studies = $_POST['studies'];
        $expertise = $_POST['expertise'];
        $linkedin = $_POST['linkedin'];


        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $to = 'riad.elhajjame@uir.ac.ma';

        $subject = 'Account creation - Professor -';
        $message = 'Hey, ' . $name . ' sent a request to create a Professor Account. <br> Please check the pending requests. <br>';
        $message .= 'First Name: ' . $fname . '<br>';
        $message .= 'Last Name: ' . $lname . '<br>';
        $message .= 'Email: ' . $email . '<br>';
        $message .= 'Username: ' . $name . '<br>';
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

        $sql = "SELECT * FROM accounts WHERE username='$name' AND password='$pass'";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            $error[] = 'User existing .. ';
        }
        else
        {
            
            if($pass != $cPass)
            {
                $error[] = 'Passwords are not matching .. ';
            }
            else
            {
                $mail -> send();
                $insert = "INSERT INTO `pendings` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `profile`, `description`, `uni`, `studies`, `expertise`, `linkedin`) VALUES (NULL, '$name', '$pass', '$fname', '$lname', '$email', 'professor', '$desc', '$uni', '$studies', '$expertise', '$linkedin')";
                mysqli_query($conn, $insert);
                header('location:index.php');
            }      
        }
        mysqli_close($conn);
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0fb231b4af.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="./Pics/logo-design.png">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="formsContainer">
            <div class="signIn_signUp">
                <form action="" class="signInForm" method="POST">
                    <h2 class="title">Sign In</h2>
                    <?php
                        if(isset($error))
                        {
                            foreach($error as $error)
                            {
                                echo '<h2 class="errorMsg">'.$error.'</h2>';
                            };
                        };
                    ?>
                    <div class="inputField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required autocomplete=off>
                    </div>
                    <div class="inputField">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required autocomplete=off>
                    </div>
                    <!--<div class="inputField">
                        <i class="fa-duotone fa-option"></i>
                        <select name="profile">
                            <option value="admin">Admin</option>
                            <option value="chief">Stage chief</option>
                            <option value="professor">Professor</option>
                            <option value="student">Student</option>
                        </select> 
                    </div> -->
                    <input type="submit" name="subIn" value="Login" class="btn solid">
                </form>

                <form action="" class="signUpForm" method="POST">
                    <h2 class="title">Sign Up</h2>
                    <div class="sUp">
                        <div class="inputField">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" placeholder="Username" name="name" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-person"></i>
                            <input type="text" placeholder="1st Name" name="fname" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-person"></i>
                            <input type="text" placeholder="Last Name" name="lname" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" placeholder="Email" name="email" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" placeholder="Password" name="pass" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" placeholder="Confirm Password" name="cpass" autocomplete=off>
                        </div>


                        <div class="inputField">
                            <i class="fa-solid fa-key"></i>
                            <input type="textarea" placeholder="Description" name="desc" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-key"></i>
                            <input type="text" placeholder="University You teaching in" name="uni" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-key"></i>
                            <input type="textarea" placeholder="Studies" name="studies" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-key"></i>
                            <input type="textarea" placeholder="Expertise" name="expertise" autocomplete=off>
                        </div>
                        <div class="inputField">
                            <i class="fa-solid fa-key"></i>
                            <input type="text" placeholder="Linkedin Link" name="linkedin" autocomplete=off>
                        </div>
                    </div>
                    <div class="inputField">
                        <i class="fa-duotone fa-option"></i>
                        <select name="userType">                        
                            <option value="professor">Professor</option>
                        </select>
                    </div>
                    <input type="submit" value="Sign Up" name="subUp" class="btn solid">
                </form>
            </div>
        </div>

        <div class="panelsContainer">
            <div class="panel leftPanel">
                <div class="content">
                    <h3>You Part of the Administration ?</h3>
                    <p>Since you do have access to this page, here you can create your Administrator / Professor account.. Good luck working hard :D ... </p>
                    <button class="btn transparent" id="signUpBtn">Sign Up</button>
                </div>
                <img src="Pics/undraw_content_team_re_6rlg.svg" alt="" class="image">
            </div>

            <div class="panel rightPanel">
                <div class="content">
                    <h3>Are you One of Us ? </h3>
                    <p>Since you do have access to this page, here you can create your Administrator / Professor account.. Good luck working hard :D ... </p>
                    <button class="btn transparent" id="signInBtn">Sign In</button>
                </div>
                <img src="Pics/undraw_online_test_re_kyfx.svg" alt="" class="image">
            </div>

        </div>
    </div>

    <script src="main.js"></script>
</body>
</html>