<?php
     session_start();
     unset($_SESSION["id"]);
     unset($_SESSION["chief_name"]);
     header("Location:login.php");
?>