
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

//From 1 to 10
$sql="INSERT INTO `Address` VALUES (NULL,'Paul Isle','389','5','8','w','1','1','1', '1', now()),
(NULL,'Nikita Crossroad','721','','7','a','2','2','2', '1', now()),
(NULL,'Eudora Key','294','','5','l','3','3','3', '1', now()),
(NULL,'Schaden Plaza','311','','6','l','4','4','4', '1', now()),
(NULL,'Elias Roads','919','','0','q','1','5','5', '2', now()),
(NULL,'Meta Dam','265','','2','o','2','6','6', '2', now()),
(NULL,'Leland Village','100','','9','x','4','1','1', '1', now()),
(NULL,'Florida Vista','35','','7','t','3','2','2', '1', now()),
(NULL,'Murazik Overpass','437','','9','h','2','5','5', '1', now()),
(NULL,'Anahi Harbor','330','4','8','r','1','6','6', '2', now())";


if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>