
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

//From 1 to 9
$sql="INSERT INTO `Charge` VALUES (NULL,'0.0000','2010-05-02', now()),
(NULL,'124657.8651','1974-07-15', now()),
(NULL,'11.2841','1976-01-29', now()),
(NULL,'48876154.0000','1971-03-20', now()),
(NULL,'1306.9159','1993-05-13', now()),
(NULL,'228703.6436','2007-11-14', now()),
(NULL,'114005015.6964','2016-03-16', now()),
(NULL,'0.0000','1999-07-04', now()),
(NULL,'18453115.4516','2001-05-04', now())";


if (mysqli_query($conn, $sql)) { 
    echo "Charge table filled"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>