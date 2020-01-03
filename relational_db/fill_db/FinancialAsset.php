
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

//From 1 to 10
$sql="INSERT INTO `FinancialAsset` VALUES (NULL,'10','investmentFund','1',now()),
(NULL,'4','investmentFund','2',now()),
(NULL,'1','bankDeposit','3',now()),
(NULL,'1','investmentFund','4',now()),
(NULL,'2','bankDeposit','5',now()),
(NULL,'8','investmentFund','6',now()),
(NULL,'6','pensionFund','7',now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>