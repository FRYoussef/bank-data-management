
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "BankDataManagement"; 
  
// Create connection 
$conn = mysqli_connect( $servername, $username, $password, $dbname ); 
  
// Check connection 
if ( !$conn ) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 

//From 1 to 6
$sql="INSERT INTO `AddressLocality` VALUES (NULL,'East Roderick', now()),
(NULL,'Lake Donavon', now()),
(NULL,'South Melissaborough', now()),
(NULL,'Hettingermouth', now()),
(NULL,'South Claudiachester', now()),
(NULL,'Ziemeshire', now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>