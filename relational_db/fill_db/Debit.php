
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


$sql="INSERT INTO `Debit` VALUES ('1',now()),
('2',now()),
('3',now()),
('4',now()),
('5',now()),
('6',now()),
('7',now()),
('8',now()),
('9',now()),
('10',now()),
('11',now()),
('12',now()),
('13',now()),
('14',now()),
('15',now()),
('16',now()),
('17',now()),
('18',now()),
('19',now()),
('20',now()); 
";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>