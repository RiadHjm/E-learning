<?php
$con = new mysqli('localhost','root','','internship_management');

if($con){
}else{
    die(mysqli_error($con));
}
?>