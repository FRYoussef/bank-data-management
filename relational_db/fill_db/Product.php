
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

//From 1 to 15
$sql="INSERT INTO `Product` VALUES (NULL,'1971-08-29','1973-08-18','68380268.8524',now()),
(NULL,'1994-06-13','1991-03-27','51818758.8888',now()),
(NULL,'2000-09-18','1992-04-13','3964.2383',now()),
(NULL,'1994-08-12','2014-03-26','3141664.8346',now()),
(NULL,'2010-12-24','1997-01-15','2177.4220',now()),
(NULL,'1989-02-05','1971-04-23','312140.8205',now()),
(NULL,'1979-03-01','2009-08-17','1827.7733',now()),
(NULL,'1989-12-16','1971-07-27','212609.2000',now()),
(NULL,'1978-02-06','1970-09-10','6642.8700',now()),
(NULL,'2011-07-18','1970-03-18','53334546.0074',now()),
(NULL,'2006-05-27','2006-05-31','4032115.6870',now()),
(NULL,'1990-02-01','2011-02-12','337387737.4000',now()),
(NULL,'1987-12-28','1978-12-23','2.2245',now()),
(NULL,'1977-08-06','2019-08-13','32967.4521',now()),
(NULL,'1997-04-04','1992-06-26','942360.9348',now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>