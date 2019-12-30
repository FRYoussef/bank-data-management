
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

//10 PER, 15 PROD, 9 CUENTAS, 3 INTERES
$sql="INSERT INTO `Owns` VALUES ('1','1','1','1',now()),
('2','2','2','2',now()),
('3','3','3','3',now()),
('4','4','4','1',now()),
('4','5','5','2',now()),
('4','6','6','3',now()),
('4','7','7','1',now()),
('4','8','8','2',now()),
('4','9','9','2',now()),
('10','10','7','2',now()),
('1','11','8','1',now()),
('1','12','3','2',now()),
('2','13','3','3',now()),
('2','14','1','1',now()),
('3','15','5','1',now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>