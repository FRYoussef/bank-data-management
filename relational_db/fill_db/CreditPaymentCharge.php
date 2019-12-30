
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

$sql="INSERT INTO `CreditPaymentCharge` VALUES ('1','1',now()),
('2','2',now()),
('3','3',now()),
('4','4',now()),
('5','5',now()),
('6','6',now()),
('7','7',now()),
('8','8',now()),
('9','9',now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>