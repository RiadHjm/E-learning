<?php
@include 'config.php';
 
//if there is some error connecting to the database
//with die we will stop the further execution by displaying a message causing the error 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
//if everything is fine
 
//creating an array for storing the data 
$etablissement = array(); 
 
//this is our sql query 
$sql = "SELECT id, nom FROM etablissement;";
 
//creating an statment with the query
$stmt = $conn->prepare($sql);
 
//executing that statment
$stmt->execute();
 
//binding results for that statment 
$stmt->bind_result($id, $nom);
 
//looping through all the records
while($stmt->fetch()){
 
 //pushing fetched data in an array 
 $temp = [
 'id'=>$id,
 'nom'=>$nom
 ];
 
 //pushing the array inside the hero array 
 array_push($etablissement, $temp);
}
 
//displaying the data in json format 
echo json_encode($etablissement);