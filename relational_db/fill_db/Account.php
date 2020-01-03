
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

//from 1 to 9
$sql = "INSERT INTO `Account` VALUES (NULL,'5263693663797971','1992-03-31','0.9683','USD', now()),
(NULL,'5291257394528224','1976-11-16','21235971.3000','JPY', now()),
(NULL,'372743289096967','1981-10-21','0.0000','EUR', now()),
(NULL,'5559354295768073','2001-01-28','177315198.4000','EUR', now()),
(NULL,'4716042007571','1992-10-04','947569.3826','USD', now()),
(NULL,'5339637251186994','1985-03-27','4.3313','EUR', now()),
(NULL,'4716118401774304','2006-12-10','33.0350','USD', now()),
(NULL,'6011874425419702','2005-10-31','0.0000','JPY', now()),
(NULL,'5312722856416440','1986-01-02','12158.3910','JPY', now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}
// Close coneection 
mysqli_close($conn); 
?>