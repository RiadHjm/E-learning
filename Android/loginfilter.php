<?php
@include 'conn.php';
@include 'login.php';

//if there is some error connecting to the database
//with die we will stop the further execution by displaying a message causing the error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//if everything is fine

//creating an array for storing the data
$students = array();

// Create the SQL query string
$sql = "SELECT id, username,first_name,last_name FROM students where id='2'";

//creating an statment with the query
$stmt = $conn->prepare($sql);

//executing that statment
$stmt->execute();

 //binding results for that statment
    $stmt->bind_result($id, $username,$firstname,$lastname);

 while($stmt->fetch()){
            $temp = [
                'id'=>$id,
                'username'=>$username,
                'first_name'=>$firstname,
                'last_name'=>$lastname
            ];
   		//pushing the array inside the hero array
   		 array_push($students,$temp);
		}
    echo json_encode($students);
?>