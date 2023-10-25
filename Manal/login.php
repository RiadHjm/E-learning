<?php
    @include 'connexion.php';

    session_start();
    if(isset($_POST['subIn']))
    {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $profile = $_POST['profile'];
    
        $req = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
        $res = mysqli_query($con, $req);
    
        if(mysqli_num_rows($res) > 0)
        {
            $row = mysqli_fetch_array($res);
            $_SESSION['id'] = $row['id'];
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
                header('location:cheif_welcome.php');
            }
        }
        else 
        {
            $error[] = 'Incorrect Username or Password .. ';
        }
        
    };


    if(isset($_POST['subUp']))
    {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $confPass = mysqli_real_escape_string($conn, $_POST['cpass']);
        $userType = $_POST['userType'];

        $req = "SELECT * FROM accounts WHERE username='$username' AND password='$pass'";
        $res = mysqli_query($conn, $req);

        if(mysqli_num_rows($res) > 0)
        {
            $error[] = 'User existing .. ';
        }
        else
        {
            if($pass != $confPass)
            {
                $error[] = 'Passwords are not matching .. ';
            }
            else
            {
                $insert = "INSERT INTO `accounts` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `profile`) VALUES ('NULL', '$name', '$pass', '$fname', '$lname', '$email', 'professor')";
                mysqli_query($conn, $insert);
                header('location:index.php');
            }
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0fb231b4af.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login_css.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="formsContainer">
            <div class="signIn_signUp">
                <form action="" class="signInForm" method="POST">
                    <h2 class="title">Sign In</h2>
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