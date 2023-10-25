<?php

header('content-type: application/json');

define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB','internship_management');

$con = mysqli_connect(HOST,USER,PASS,DB);

$username  = $_GET['username'];
 
$sql = "select * from students where username like '%$username%'";
 
$res = mysqli_query($con,$sql);
 
$result = array();
 
while($row = mysqli_fetch_array($res)){
array_push($result,array('username'=>$row[1],'first_name'=>$row[3],'last_name'=>$row[4],'email'=>$row[5],'personal_teacher'=>$row[6],'field'=>$row[8],'description'=>$row[9],'day'=>$row[10],'month'=>$row[11],'year'=>$row[12],'nationality'=>$row[13],'faculty'=>$row[14],'phone_number'=>$row[15],'city'=>$row[16],'country'=>$row[17],'current_university'=>$row[18],'uni_loc'=>$row[19],'highschool'=>$row[21],'gpa'=>$row[20]


));
}
 
echo json_encode(array("result"=>$result));
 
mysqli_close($con);

?>