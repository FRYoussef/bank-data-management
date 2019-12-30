
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


$sql="INSERT INTO `Credit` VALUES
('6','55.4000', now()),
('7','0.0000', now()),
('8','75.9000', now()),
('9','85596861.0777', now()),
('10','11234.0675', now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>