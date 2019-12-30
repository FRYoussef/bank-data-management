
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


$sql="INSERT INTO `SavingAccount` VALUES
('4','1979-10-05',now()),
('5','1973-08-03',now()),
('6','2017-02-26',now()),
('7','1989-04-28',now()),
('8','2002-02-09',now()),
('9','1979-07-18',now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>