
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

$sql="INSERT INTO `AddressProvince` VALUES ('1','Nebraska', now()),
('2','Massachusetts', now()),
('3','Arizona', now()),
('4','Georgia', now()),
('5','Kentucky', now()),
('6','Wyoming', now()),
('7','Virginia', now()),
('8','Connecticut', now()),
('9','Vermont', now()),
('10','Texas', now()),
('11','California', now()),
('12','Arkansas', now()),
('13','Pennsylvania', now()),
('14','Wisconsin', now()),
('15','Tennessee', now()),
('16','Colorado', now()),
('17','NewHampshire', now()),
('18','Oklahoma', now()),
('19','Iowa', now()),
('20','Washington', now()),
('21','RhodeIsland', now()),
('22','Idaho', now()),
('23','Delaware', now()),
('24','Hawaii', now()),
('25','Florida', now()),
('26','Michigan', now()),
('27','Missouri', now()),
('28','Louisiana', now()),
('29','Nevada', now()),
('30','NewYork', now()),
('31','Montana', now()),
('32','Maryland', now()),
('33','District of Columbia', now()),
('34','Alabama', now()),
('35','WestVirginia', now()),
('36','Utah', now()),
('37','Indiana', now()),
('38','Ohio', now()),
('39','NorthDakota', now()),
('40','SouthCarolina', now()),
('41','Kansas', now()),
('42','Minnesota', now()),
('43','NewJersey', now()),
('44','Maine', now()),
('45','Alaska', now()),
('46','Illinois', now()),
('47','Mississippi', now()),
('48','SouthDakota', now()),
('49','NewMexico', now()),
('50','Oregon',now());";

if (mysqli_query($conn, $sql)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
}

// Close coneection 
mysqli_close($conn); 
?>