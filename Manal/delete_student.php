<?php

include "connexion.php";

$id = $_GET['id'];

$sql = "DELETE FROM `students` WHERE id = $id";

$result = mysqli_query($con,$sql);
if($result){
    echo "<script type=\"text/javascript\">
                alert(\"Student has been successfully deleted.\");
                window.location = \"students.php\"
          </script>";
}else{
    echo "Failed : ".mysqli_error($con);
}

 
?>