
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "Bank-data-management"; 
  
// Create connection 
$conn = mysqli_connect( $servername, $username, $password, $dbname ); 
  
// Check connection 
if ( !$conn ) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 

//From 1 to 3
$sql="INSERT INTO `Interest` VALUES (NULL,'0','0.99',now()),
(NULL,'0','0.99',now()),
(NULL,'1','0.99',now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>