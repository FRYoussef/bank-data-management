
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

//From 1 to 14
$sql="INSERT INTO `Card` VALUES (NULL,'5210129432620557','1975-05-31','1993-07-05','425','9156','1', now()),
(NULL,'372546538338969','1978-01-06','1985-09-22','178','3910','2', now()),
(NULL,'5460174754078200','2003-03-23','1978-11-07','683','7098','3', now()),
(NULL,'345333554523598','1982-09-20','1994-09-21','806','2073','4', now()),
(NULL,'5225817776183646','2018-05-15','2002-09-23','696','2187','1', now()),
(NULL,'4024007115040','1995-06-23','1987-04-11','424','6970','2', now()),
(NULL,'4716970669205112','1975-07-01','2004-08-29','531','1767','3', now()),
(NULL,'4916197908235','2003-10-04','1975-10-23','299','5001','4', now()),
(NULL,'5468807715755415','2010-01-08','2018-09-09','828','3513','1', now()),
(NULL,'4485720635515','1998-01-13','1970-05-17','418','4886','2', now()),
(NULL,'5323387098067783','1993-09-06','1999-05-31','360','1632','3', now()),
(NULL,'4539767734507','1997-01-06','1992-05-16','286','4202','4', now()),
(NULL,'5352907205208498','1997-07-09','1977-06-13','86','4430','1', now()),
(NULL,'5464228243358282','1980-02-28','2009-05-05','467','9385','2', now())";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>