
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
$query =    "SELECT Product.productId AS idProduct, Product.timestamp AS sellDate, 
            Person.dateOfBirth AS idCostumerBirthday, AddressLocality.locality AS city, AddressPostCode.postCode AS postcode,
            AddressProvince.province AS region, Person.salary AS salary, Person.gender AS gender, Person.personId AS idCostumer
            FROM Product 
            INNER JOIN Owns 
                ON Product.productId=Owns.productId
            INNER JOIN Person 
                ON Person.personId=Owns.personId
            INNER JOIN Address
                ON Person.addressId=Address.addressId
            INNER JOIN AddressLocality 
                ON Address.addressLocId=AddressLocality.addressLocId
            INNER JOIN AddressPostCode INNER JOIN AddressProvince
                ON Address.addressProvId=AddressProvince.addressProvId
            ";
$result = mysqli_query($transConn, $query);



mysqli_close($transConn);
mysqli_close($starConn); 
?>