<?php

include "connexion.php";

$id = $_GET['id'];

$sql = "DELETE FROM `doc_deadline` WHERE id = $id";

$result = mysqli_query($con,$sql);
if($result){
    echo "<script type=\"text/javascript\">
                    alert(\"Deadline has been successfully deleted.\");
                    window.location = \"documents.php\"
              </script>";
    } else {
        echo "Failed : " . mysqli_error($con);
    }
 
?>