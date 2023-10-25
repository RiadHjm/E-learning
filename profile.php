<?php
    @include 'config.php';
    //@include 'trial.php';
    session_start();

    $username = $_SESSION['student_name'];
    $req = "SELECT day FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $day_birth = $row['day'];

    $req = "SELECT month FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $month_birth = $row['month'];

    $req = "SELECT year FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $year_birth = $row['year'];

    $req = "SELECT first_name FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $firstname = $row['first_name'];

    $req = "SELECT last_name FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $lastname = $row['last_name'];

    $req = "SELECT field FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $field = $row['field'];

    $req = "SELECT nationality FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $nationality = $row['nationality'];

    $req = "SELECT faculty FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $fac = $row['faculty'];

    $req = "SELECT description FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $description = $row['description'];

    $req = "SELECT email FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $email = $row['email'];

    $req = "SELECT phone_number FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $phone = $row['phone_number'];

    $req = "SELECT city FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $city = $row['city'];

    $req = "SELECT country FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $country = $row['country'];

    $req = "SELECT current_university FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $uni = $row['current_university'];

    $req = "SELECT uni_loc FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $loca = $row['uni_loc'];

    $req = "SELECT gpa FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $gpa = $row['gpa'];

    $req = "SELECT highschool FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $highschool = $row['highschool'];

    $req = "SELECT profile_pic FROM students WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $im_pth = $row['profile_pic'];

    if(isset($_POST['sub']))
    {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $day_birth = $_POST['birth_date'];
        $month_birth = $_POST['birth_month'];
        $year_birth = $_POST['birth_year'];
        $email = $_POST['email'];
        $phone = $_POST['phone_number'];
        $city = $_POST['city'];	
        $count = $_POST['country'];
        $uni = $_POST['school_name'];
        $loca = $_POST['school_city'];
        $gpa = $_POST['school_gpa'];
        $highschool = $_POST['highschool'];
        $description = $_POST['story'];

        $profile_pic = $_FILES['photo']['name'];
        $img_size = $_FILES['photo']['size'];
        $tmp_name = $_FILES['photo']['tmp_name'];
        $img_ex = pathinfo($profile_pic, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if(in_array($img_ex_lc, $allowed_exs))
        {
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = 'uploads/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
            $SQL = "UPDATE `students` SET `profile_pic`='$img_upload_path' WHERE `username` = '$username';";
            $result = mysqli_query($conn, $SQL);
        }

        $SQL = "UPDATE `students` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`description`='$description',`day`='$day_birth',`month`='$month_birth',`year`='$year_birth',`phone_number`='$phone',`city`='$city',`country`='$count',`current_university`='$uni',`uni_loc`='$loca',`gpa`='$gpa',`highschool`='$highschool' WHERE `username` = '$username',";
        $SQL .= "UPDATE `accounts` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email' WHERE `username` = '$username';";
        $result = mysqli_query($conn, $SQL);
        if($result)
        {
            header("Location: profile.php");
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0fb231b4af.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="profile.css">
    <link rel="icon" type="image/x-icon" href="./Pics/logo-design.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Profile</title>
</head>

<body>
    <!-- Header -->
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


    <!-- Body -->
    <div id="page" class="site">
        <header>
            <div class="container">
                <div class="logo"><a href="">.the innovative university</a></div>
            </div>
        </header>
        <main>
            <div class="formBox">
                <div class="top">
                    <div class="container">
                        <ul>
                            <li class="indicator active"><a href="#" class="ind"><i
                                        class="ri-checkbox-blank-circle-line"></i></a> Choose your field</li>
                            <li class="indicator"><a href="#" class="ind"><i
                                        class="ri-checkbox-blank-circle-line"></i></a> Your Profile</li>
                            <li class="indicator"><a href="#" class="ind"><i
                                        class="ri-checkbox-blank-circle-line"></i></a> Your Story</li>
                        </ul>
                    </div>
                </div>
                <div class="container">
                    <form action="" id="studentForm" name="studentForm" method="POST" enctype="multipart/form-data">
                        <div class="field form-child active">
                            <h2>That is your <br>field of study</h2>
                            <div class="wrapper">
                                <div class="faculty">
                                    <div class="icon engineering"><i class="ri-computer-line ri-2x"></i></div>
                                    <h3>Engineering</h3>
                                    <ul>
                                        <li>
                                            <input type="radio" name="faculty" value="Computer Science" id="1" <?php if($field == 'Computer Science'){ ?> checked <?php } ?>>
                                            <label for="1">Computer Science</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Aerospace" id="2" <?php if($field == 'Aerospace'){ ?> checked <?php } ?>>
                                            <label for="2">Aerospace</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Automobile" id="3" <?php if($field == 'Automobile'){ ?> checked <?php } ?>>
                                            <label for="3">Automobile</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Recycable Energy" id="4" <?php if($field == 'Recycable Energy'){ ?> checked <?php } ?>>
                                            <label for="4">Recycable Energy</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="faculty">
                                    <div class="icon art"><i class="ri-quill-pen-line ri-2x"></i></div>
                                    <h3>Art</h3>
                                    <ul>
                                        <li>
                                            <input type="radio" name="faculty" value="Architecture" id="5" <?php if($field == 'Architecture'){ ?> checked <?php } ?>>
                                            <label for="5">Architecture</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Web Design" id="6" <?php if($field == 'Web Design'){ ?> checked <?php } ?>>
                                            <label for="6">Web Design</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Blender" id="7" <?php if($field == 'Blender'){ ?> checked <?php } ?>>
                                            <label for="7">Blender</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Infography" id="8" <?php if($field == 'Infography'){ ?> checked <?php } ?>>
                                            <label for="8">Infography</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="faculty">
                                    <div class="icon med"><i class="ri-hospital-line ri-2x"></i></div>
                                    <h3>Medical School</h3>
                                    <ul>
                                        <li>
                                            <input type="radio" name="faculty" value="Dental" id="9" <?php if($field == 'Dental'){ ?> checked <?php } ?>>
                                            <label for="9">Dental</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="General Medecine" id="10" <?php if($field == 'General Medecine'){ ?> checked <?php } ?>>
                                            <label for="10">General Medicine</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Cardio" id="11" <?php if($field == 'Cardio'){ ?> checked <?php } ?>>
                                            <label for="11">Cardio</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Pharmacology" id="12" <?php if($field == 'Pharmacology'){ ?> checked <?php } ?>>
                                            <label for="12">Pharmacology</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="faculty">
                                    <div class="icon business"><i class="ri-calculator-line ri-2x"></i></div>
                                    <h3>Business School</h3>
                                    <ul>
                                        <li>
                                            <input type="radio" name="faculty" value="Accounting" id="13" <?php if($field == 'Accounting'){ ?> checked <?php } ?>>
                                            <label for="13">Accounting</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Economics" id="14" <?php if($field == 'Economics'){ ?> checked <?php } ?>>
                                            <label for="14">Economics</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Finance" id="15" <?php if($field == 'Finance'){ ?> checked <?php } ?>>
                                            <label for="15">Finance</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="faculty" value="Management" id="16" <?php if($field == 'Management'){ ?> checked <?php } ?>>
                                            <label for="16">Management</label>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="highlight">
                                <div class="head">
                                    <div class="thumbnail">
                                        <img src="<?php echo $im_pth; ?>" alt="">
                                    </div>
                                    <div class="split">
                                        <div class="name">
                                            <h4>
                                                <strong class="firstname">
                                                    <?php   
                                                        echo $firstname;
                                                    ?>
                                                </strong>
                                                <strong class="lastname">
                                                    <?php   
                                                        echo $lastname;
                                                    ?>
                                                </strong>
                                            </h4>
                                            <span>
                                                <span class="month">
                                                    <?php   
                                                        echo $month_birth;
                                                    ?>
                                                </span>
                                                <span class="day">
                                                    <?php   
                                                        echo $day_birth;
                                                    ?>
                                                </span>
                                                <span class="year">
                                                    <?php   
                                                        echo $year_birth;
                                                    ?>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="devider"></div>
                                        <div class="country">
                                            <span class="nationality">
                                                <?php   
                                                    echo $country;
                                                ?>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="wrapper">
                                    <h4>Your Field is : </h4>
                                    <div class="field_selected">
                                        <div class="faculty">
                                            <div class="icon">
                                                <?php
                                                    if($field == "Computer Science" || $field == "Aerospace" || $field == "Automobile" || $field == "Recycable Energy")
                                                    {
                                                        $pic = "ri-computer-line ri-2x";
                                                    }
                                                    elseif($field == "Architecture" || $field == "Web Design" || $field == "Blender" || $field == "Infography")
                                                    {
                                                        $pic = "ri-brush-line ri-2x";
                                                    }
                                                    elseif($field == "Dental" || $field == "General Medecine" || $field == "Cardio" || $field == "Pharmacology")
                                                    {
                                                        $pic = "ri-hospital-line ri-2x";
                                                    }
                                                    elseif($field == "Accounting" || $field == "Economics" || $field == "Finance" || $field == "Management")
                                                    {
                                                        $pic = "ri-calculator-line ri-2x";
                                                    }
                                                ?>
                                                <i class="<?php echo $pic;?>"></i>
                                            </div>
                                            <h3>
                                                <?php   
                                                    echo $fac;
                                                ?>
                                            </h3>
                                            <span>
                                                <?php   
                                                    echo $field;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="profile form-child">
                                <h2>Fill out the application form carefully</h2>
                                <div class="wrapper">
                                    <div class="row personal">
                                        <div class="heading">
                                            <div class="icon"><i class="ri-user-5-line ri-2x"></i></div>
                                            <h3>Personal Information</h3>
                                        </div>
                                        <div class="upload split">
                                            <p>
                                                <label for="uploader">Upload a Picture</label>
                                                <input type="file" name="photo" id="uploader">
                                            </p>
                                        </div>
                                        <div class="split">
                                            <p>
                                                <label>Full Name</label>
                                                <input type="text" name="fname" class="fname" value="<?php echo $firstname;?>" placeholder="<?php echo $firstname;?>"
                                                    autocomplete=off>
                                            </p>
                                            <p>
                                                <input type="text" name="lname" class="lname" value="<?php echo $lastname;?>" placeholder="<?php echo $lastname;?>"
                                                    autocomplete=off>
                                            </p>
                                        </div>
                                        <div class="split birth">
                                            <p>
                                                <label>Birth Day</label>
                                                <input type="number" name="birth_date" value="<?php echo $day_birth;?>" placeholder="<?php echo $day_birth;?>" min="1"
                                                    max="31">
                                            </p>
                                            <p>
                                                <label>Birth Month</label>
                                                <input type="number" name="birth_month" value="<?php echo $month_birth;?>" placeholder="<?php echo $month_birth;?>" min="1"
                                                    max="12">
                                            </p>
                                            <p>
                                                <label>Birth Year</label>
                                                <input type="number" name="birth_year" value="<?php echo $year_birth;?>" placeholder="<?php echo $year_birth;?>" max="2010"
                                                    min="1990">
                                            </p>
                                        </div>
                                        <p>
                                            <label>Email</label>
                                            <input type="email" name="email" class="email" value="<?php echo $email;?>" placeholder="<?php echo $email;?>">
                                        </p>
                                        <p>
                                            <label>Phone Number</label>
                                            <input type="text" name="phone_number" value="<?php echo $phone;?>" placeholder="<?php echo $phone;?>">
                                        </p>
                                        <div class="split">
                                            <p>
                                                <input type="text" name="city" value="<?php echo $city;?>" placeholder="<?php echo $city;?>">
                                            </p>
                                        </div>
                                        <p class="custom-select">
                                            <i class="ri-arrow-down-s-line"></i>
                                            <select name="country">
                                                <option value="" disabled>Select Your Country.. <?php echo $country;?></option>
                                                <option value="Morocco" <?php if($country == 'Morocco'){ ?> selected <?php }?>>Morocco</option>
                                                <option value="Japan" <?php if($country == 'Japan'){ ?> selected <?php }?>>Japan</option>
                                                <option value="South Korea" <?php if($country == 'South Korea'){ ?> selected <?php }?>>South Korea</option>
                                                <option value="USA" <?php if($country == 'USA'){ ?> selected <?php }?>>USA</option>
                                                <option value="Finland" <?php if($country == 'Finland'){ ?> selected <?php }?>>Finland</option>
                                                <option value="Ghana" <?php if($country == 'Ghana'){ ?> selected <?php }?>>Ghana</option>
                                                <option value="China" <?php if($country == 'China'){ ?> selected <?php }?>>China</option>
                                                <option value="United Kingdom" <?php if($country == 'United Kingdom'){ ?> selected <?php }?>>United Kingdom</option>
                                                <option value="Others.." <?php if($country == 'Others..'){ ?> selected <?php }?>>Others..</option>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="row academic">
                                        <div class="heading">
                                            <div class="icon">
                                                <i class="ri-building-2-line ri-2x"></i>
                                            </div>
                                            <h3>Academic Background</h3>
                                        </div>
                                        <p>
                                            <label>Name of your current University</label>
                                            <input type="text" name="school_name" value="<?php echo $uni;?>" placeholder="<?php echo $uni;?>">
                                        </p>
                                        <div class="split">
                                            <p>
                                                <label>School Location</label>
                                                <input type="text" name="school_city" value="<?php echo $loca;?>" placeholder="<?php echo $loca;?>">
                                            </p>
                                        </div>
                                        <p>
                                            <label>Professor Rating</label>
                                            <input type="text" name="school_gpa" max="5" value="<?php echo $gpa;?>" placeholder="<?php echo $gpa;?>">
                                        </p>
                                        <div class="split">
                                            <p>
                                                <label>In which highschool you got graduated ? </label>
                                                <input type="text" name="highschool" value="<?php echo $highschool;?>" placeholder="<?php echo $highschool;?>">
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="story form-child">
                                <h2>Write about your strengths.. if you have one xD</h2>
                                <div class="wrapper">
                                    <div class="row academic">
                                        <div class="heading">
                                            <div class="icon">
                                                <i class="ri-character-recognition-line ri-2x"></i>
                                            </div>
                                            <h3>Activity Information</h3>
                                        </div>
                                        <p>
                                            <label for="">Brief your Story</label>
                                            <textarea name="story" cols="30" rows="10" placeholder="<?php echo $description ?>"><?php echo $description;?></textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <nav>
                            <a href="#0" class="prev">Back</a>
                            <a href="#0" class="next">Continiue</a>
                            <a href="#0" class="submit">All done</a>
                        </nav>
                        <input type="submit" value="Submit" name="sub" class="sub">
                    </form>
                </div>
            </div>
        </main>
    </div>



    <script src="profilee.js"></script>



    <!-- Footer -->
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
</body>

</html>