
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

//FROM 1 TO 10
$sql="INSERT INTO `AddressPostCode` VALUES (NULL,'93095-5039', now()),
(NULL,'75530-9268', now()),
(NULL,'11849', now()),
(NULL,'27282-2089', now()),
(NULL,'89992', now()),
(NULL,'04342', now()),
(NULL,'81268-8906', now()),
(NULL,'29566', now()),
(NULL,'64139-6608', now()),
(NULL,'89297', now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>