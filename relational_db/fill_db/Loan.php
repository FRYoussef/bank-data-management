
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


$sql="INSERT INTO `Loan` VALUES ('1','0.0000','6','8',now()),
('2','198.0000',NULL,'9',now()),
('3','769588.0000','7','10',now()),
('4','168787.0000',NULL,'11',now()),
('5','97.0000',NULL,'12',now()),
('6','1890.0000',NULL,'13',now()),
('7','56.0000','7','14',now()),
('8','77298742.0000','10','15',now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>