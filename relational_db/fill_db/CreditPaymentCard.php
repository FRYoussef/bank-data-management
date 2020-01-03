
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

//From 1 to 8
$sql="INSERT INTO `CreditPaymentCard` VALUES (NULL,'1', now()),
(NULL,'6', now()),
(NULL,'7', now()),
(NULL,'6', now()),
(NULL,'7', now()),
(NULL,'6', now()),
(NULL,'10', now()),
(NULL,'7', now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>