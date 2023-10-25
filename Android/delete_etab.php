<?php
    @include 'config.php';

   $name = $_POST["nom"];

    if($conn){

        $sqlCheckName  ="SELECT * FROM etablissement WHERE nom LIKE '$name'";
        $NameQuery  = mysqli_query($conn,$sqlCheckName);
    if (mysqli_num_rows($NameQuery)>0){
        $sql_delete ="DELETE FROM `etablissement` WHERE nom = '$name'";

        if(mysqli_query($conn,$sql_delete)){
            echo "Successfully Deleted";
        }
    }
        
        else {
            echo "Failed to Delete";
        }
    }
    ?>