<?php
    session_start();
    @include 'config.php';
    //@include 'upload.php';
    
    $username = $_SESSION['student_name'];

    $req = "SELECT `personal_teacher` FROM `students` WHERE username='$username'";
    $res = mysqli_query($conn, $req);
    $row = mysqli_fetch_assoc($res);
    $teacher = $row['personal_teacher'];

    $statusMsg = '';

    // File upload path
    $targetDir = "files/";
    

    if(isset($_POST['submit']) && !empty($_FILES['file']['name'])){
        $fName = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir . $fName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','pdf', 'zip', 'rar', 'txt', 'docx', 'doc', 'xlsx', 'xls', 'pptx', 'ppt', 'csv', 'php', 'html', 'css', 'js', 'c');
        if(in_array($fileType, $allowTypes))
        {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                // Insert image file name into database
                $insert = "INSERT INTO `files`(`id`, `teacher_name`, `student_name`, `file`) VALUES (NULL,'$teacher','$username','$fName')";
                $res = mysqli_query($conn, $insert);
                if($insert){
                    $statusMsg = "The file ".$fName. " has been uploaded successfully.";
                }else{
                    $statusMsg = "File upload failed, please try again.";
                } 
            }else{
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0fb231b4af.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="docs.css">
    <link rel="icon" type="image/x-icon" href="./Pics/logo-design.png">
    <title><?php echo $username; ?> / Docs </title>
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
        <h3>Docs</h3>
        <p> <a href="student.php">Home >></a> Docs</p>
    </section>

    <section class="about">
        <div class="image">
            <img src="Pics/doc.svg" alt="">
        </div>
        <div class="content">
            <h3>Wanna Upload your docs to your Professor ?</h3>
            <p>
                Here you can upload your docs to your Professor, and he will be able to see them and give you a feedback.
                Your documents (internship reports - etc...) will be seen on the Professor's plateforme, he gonna be able to 
                download them and give you a feedback. 
            </p>
            <a href="profile.php" class="btn">Visit your Profile</a>
        </div>
    </section>

    <div class="bod">
        <section id="fileUpload">
            <header>- Put everything on a compressed file then submit your work - </header>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="file">
                    <i class="ri-upload-cloud-2-line"></i>
                    <p>Search File Here</p>
                </label>
                <input type="file" name="file" id="file" class="file">
                <div class="progressArea">
                <?php
                    $query = "SELECT `file` FROM `files` WHERE `student_name` = '$username'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) 
                    {
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            $fName = $row['file'];
                        ?>
                        <!-- Display the file names -->
                        <div class="row complete">  
                            <div class="cont">
                                <i class="ri-file-cloud-line"></i>
                                <div class="detail">
                                    <a href="files/<?php echo $fName; ?>" class="name" download><?php echo $fName; ?></a>
                                </div>
                            </div>
                            <i class="ri-checkbox-circle-line"></i>
                        </div>
                        <?php
                        }
                    }
                    ?>
                </div> 
                <input type="submit" value="Upload" class="submit" name="submit">
            </form>
        </section>
    </div>

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
    <script src="docs.js"></script>

    <script>
        const form = document.querySelector('form');
        formInput = form.querySelector('#file');
        progressArea = document.querySelector('.progressArea');

        formInput.onchange = ({target}) => {
            let file = target.files[0];
            if(file)
            {
                let fileName = file.name;
                uploadFile(fileName);
            }
        }

        function uploadFile(fName)
        {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "upload.php");
            xhr.upload.addEventListener('progress', ({ loaded, total }) => {
                let fileLoad = Math.floor(loaded / total * 100);
                let fileTotal = Math.floor(total / 1000);
                let fileSize;
                (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024 * 1024)).toFixed(2) + " MB";
                var proHTML = `
                    <div class="row">
                        <i class="ri-file-cloud-line"></i>
                        <div class="cont">
                            <div class="detail">
                                <span class="name">${fName}</span>
                                <span class="percentage">${fileLoad}%</span>
                            </div>
                            <div class="progressBar">
                                <div class="progress" style="width:${fileLoad}%;"></div>
                            </div>
                        </div> 
                    </div>
                `;
                //progressArea.innerHTML = proHTML;
                // if(loaded == total)
                // {
                //     var completeHTML = `
                //         <div class="row complete">  
                //             <div class="cont">
                //                 <i class="ri-file-cloud-line"></i>
                //                 <div class="detail">
                //                     <span class="name">${fName}</span>
                //                     <span class="size">${fileSize}</span>
                //                 </div>
                //             </div>
                //             <i class="ri-checkbox-circle-line"></i>
                //         </div>
                //     `;
                //     progressArea.innerHTML = completeHTML;
                // }
            });
            let formData = new FormData(form);
            formData.append('fName', fName);
            xhr.send(formData);
        }
    </script>
    
</body>
</html>