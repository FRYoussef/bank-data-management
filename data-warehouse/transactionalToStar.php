
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$starDB = "Star-schema"; 
$transDB = "Bank-data-management"; 

$transConn = mysqli_connect( $servername, $username, $password, $transDB ); 
$starConn = mysqli_connect( $servername, $username, $password, $starDB ); 

ini_set('memory_limit', '5G'); 

if ( !$starConn) { 
    die("Connection to Star-schema DB failed: " . mysqli_connect_error()); 
} 


if ( !$transConn) { 
    die("Connection to Bank-data-management DB failed: " . mysqli_connect_error()); 
} 

//------------------------- FILL DIM CUSTOMER LOCATION ----------------------------

$query =    "SELECT DISTINCT AddressPostCode.postCode AS postcode, AddressLocality.locality AS city, AddressProvince.province AS region,
            AddressCountry.country AS country
            FROM Account 
            INNER JOIN Owns 
                ON Account.accountId=Owns.accountId
            INNER JOIN Person 
                ON Person.personId=Owns.personId
            INNER JOIN Address
                ON Person.addressId=Address.addressId
            INNER JOIN AddressLocality 
                ON Address.addressLocId=AddressLocality.addressLocId
            INNER JOIN AddressPostCode INNER JOIN AddressProvince
                ON Address.addressProvId=AddressProvince.addressProvId
            INNER JOIN AddressCountry
                ON Address.addressCountryId=AddressCountry.addressCountryId
            ";

$result = mysqli_query($transConn, $query);


if(!$result){
    echo mysqli_error($transConn);
}
else{
    $insert = "INSERT INTO `dimcustomerlocation` VALUES";
    $first = TRUE;
    while($row = mysqli_fetch_array($result)) {  //Cambiar esto
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
        $row['city'] = str_replace("'", "\'", $row['city']);
        $row['region'] = str_replace("'", "\'", $row['region']);
        $row['country'] = str_replace("'", "\'", $row['country']);

       
        //Location dimension
        $insert .= "(" . "NULL" . "," . "'" . $row['postcode'] . "'" . "," . "'" . $row['city'] . "'" . "," . "'" . $row['region'] . "'" . "," . "'" . $row['country'] . "'" . ")";
        
    }
}
$insert .= ";";

if (mysqli_query($starConn, $insert)) { 
    echo "New record created successfully"; 
} else { 
    echo "Error: " . "<br>" . mysqli_error($starConn); 
}


//------------------------- FILL DIM PRODUCT -----------------------

mysqli_close($transConn);
mysqli_close($starConn); 
?>