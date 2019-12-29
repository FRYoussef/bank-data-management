
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$starDB = "Star-schema"; 
$transDB = "Bank-data-management"; 

$transConn = mysqli_connect( $servername, $username, $password, $transDB ); 
$starConn = mysqli_connect( $servername, $username, $password, $starDB ); 

if ( !$starConn) { 
    die("Connection to Star-schema DB failed: " . mysqli_connect_error()); 
} 


if ( !$transConn) { 
    die("Connection to Bank-data-management DB failed: " . mysqli_connect_error()); 
} 


//Get transactional data
$query = "";
$result = mysqli_query($transConn, $query);


mysqli_close($transConn);
mysqli_close($starConn); 
?>