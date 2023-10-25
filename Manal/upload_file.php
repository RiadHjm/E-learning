<?php
session_start();
$user=$_SESSION['chief_name']; 

// Include the database configuration file
include 'connexion.php';

$result = mysqli_query($con, "SELECT id FROM internship_managers WHERE username = '$user' LIMIT 1");
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $user_id = $row["id"];
    }
}
$statusMsg = '';

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

    // File upload path
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $con->query("INSERT into documents(`id`, `chief_id`, `student_id`, `deadline_id`, `document`, `uploaded_on`) VALUES (NULL,$user_id,Null,null,'".$fileName."', NOW())");
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

// Display status message
echo "<script type=\"text/javascript\">
            alert(\" ".$statusMsg." \");
            window.location = \"documents.php\"
      </script>";
?>