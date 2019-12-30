
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

$sql="INSERT INTO `AccountOperation` VALUES ('1','2', now()),
('2','1', now()),
('3','3', now()),
('4','4', now()),
('5','5', now()),
('6','5', now()),
('7','7', now()),
('8','8', now()),
('9','9', now()),
('10','1', now()),
('11','1', now()),
('12','2', now()),
('13','3', now()),
('14','4', now()),
('15','5', now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>