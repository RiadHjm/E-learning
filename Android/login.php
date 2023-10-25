<?php
session_start();
@include 'conn.php';

$test=null;


// Check if email and password are set
if(isset($_POST['name']) && isset($_POST['password'])){


    // Include the necessary files
    require_once "conn.php";
    require_once "validate.php";
	global $test;
    // Call validate, pass form data as parameter and store the returned value
    	$name = validate($_POST['name']);
	
	

    $password = validate($_POST['password']);



    // Create the SQL query string
    $sql1 = "select * from accounts where username='$name' and password='$password'";
	$test=$name;
	$_SESSION['student_name']=$test;


    // Execute the query
    $result = $conn->query($sql1);
    // If number of rows returned is greater than 0 (that is, if the record is found), we'll print "success", 	otherwise "failure"
    if($result->num_rows > 0){
        
		define('HOST','localhost');
		define('USER','root');
		define('PASS','');
		define('DB','internship_management');

 
		$con = mysqli_connect(HOST,USER,PASS,DB);


		$qry="select profile from accounts where username='$name' and password='$password'";
		$row=mysqli_query($con,$qry);

		while($res=mysqli_fetch_array($row)){
		$data[]=$res;
		}
		echo $data;

		print(json_encode($data));

    	} 
   
	else{
        // If no record is found, print "failure"
        echo "failure";
    }


}




// Check if email and password are set
if(isset($_POST['name'])){

    // Include the necessary files
    require_once "conn.php";
    require_once "validate.php";
    // Call validate, pass form data as parameter and store the returned value
    $name = validate($_POST['name']);


//if everything is fine

//creating an array for storing the data
$students = array();

// Create the SQL query string
$sql = "SELECT id, username,first_name,last_name FROM students where username='$name'";

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
   		 array_push($students, $temp);
		}

    echo json_encode($students);
}


?>



