<?php
    @include 'config.php';
    session_start();
    $username = $_SESSION['username'];

    $statusMsg = '';

    // File upload path
    $targetDir = "files/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if(isset($_POST['submit']) && !empty($_FILES['file']['name'])){
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','pdf', 'zip', 'rar');
        if(in_array($fileType, $allowTypes))
        {
            if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
                // Insert image file name into database
                $insert = $conn ->query("INSERT INTO `teacher_st`(`files`) VALUES ('$fileName') WHERE `username` = '$username'");
                if($insert){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
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