<?php
    @include 'config.php';

    $name    = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $frais   = $_POST['frais'];
    $email   = $_POST['email'];


    if($conn){
        $sqlCheckName  ="SELECT * FROM etablissement WHERE nom LIKE '$name'";
        $sqlCheckEmail ="SELECT * FROM etablissement WHERE email LIKE '$email'";
        $NameQuery  = mysqli_query($conn,$sqlCheckName);
        $EmailQuery = mysqli_query($conn,$sqlCheckEmail);

        if (mysqli_num_rows($NameQuery)>0){
            echo "Name is already registered, type another one";
        }else if (mysqli_num_rows($EmailQuery)>0){
            echo "Email is already registered, type another one";
        }

        else{
            $sql_register = "INSERT INTO `etablissement`
            (`id`, `nom`, `adresse`, `frais`, `email`)
             VALUES (NULL,'$name','$adresse','$frais','$email')";
        }

        if(mysqli_query($conn,$sql_register)){
            echo "Successfully Registered";
        }
        else {
            echo "Failed to Register";
        }
    }
    ?>