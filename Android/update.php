<?php


header('content-type: application/json');

define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB','internship_management');

$con = mysqli_connect(HOST,USER,PASS,DB);

$name = $_POST["name"];
$password = $_POST["password"];
$address = $_POST["address"];
$description = $_POST["description"];
$phonenumber = $_POST["phonenumber"];
$email = $_POST["email"];
$city = $_POST["city"];


$sql = "update students set first_name = '$password',last_name = '$address',description= '$description',phone_number='$phonenumber',email='$email',city='$city'  where username = '$name'";

if(mysqli_query($con,$sql))
{

echo " Succesfully update";

}
else
{
echo "Try again Later ..." .mysqli_error($con) ;

}

?>