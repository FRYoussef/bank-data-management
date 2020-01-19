<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";

$transDB = "BankDataManagement"; 

$transConn = mysqli_connect( $servername, $username, $password, $transDB, true ); 


ini_set('memory_limit', '5G'); 



if ( !$transConn) { 
    die("Connection to BankDataManagement DB failed: " . mysqli_connect_error()); 
}



$queryYear1="INSERT IGNORE INTO SnowFlake.dimyear (year)
    SELECT DISTINCT SUBSTR(y.dateOfBirth, 1, 4)
    FROM Person y
    WHERE NOT EXISTS (
    SELECT * FROM SnowFlake.dimyear WHERE SnowFlake.dimyear.year = SUBSTR(y.timestamp, 1, 4)
)
    
   
";

$queryYear3="INSERT IGNORE INTO SnowFlake.dimyear (year)
    SELECT DISTINCT SUBSTR(y.timestamp, 1, 4)
    FROM BankDataManagement.Account y
    WHERE NOT EXISTS (
    SELECT * FROM SnowFlake.dimyear WHERE SnowFlake.dimyear.year = SUBSTR(y.timestamp, 1, 4)
)
    
    
   
";

$queryYear2="INSERT IGNORE INTO SnowFlake.dimyear (year)
SELECT DISTINCT SUBSTR(y.timestamp, 1, 4)
FROM Owns y
WHERE NOT EXISTS (
    SELECT * FROM SnowFlake.dimyear WHERE SnowFlake.dimyear.year = SUBSTR(y.timestamp, 1, 4)
)";
$queryMonthAccount="INSERT IGNORE INTO SnowFlake.dimmonth (month, idYear)
    SELECT DISTINCT SUBSTR(m.timestamp, 6, 2), y.idYear
    FROM BankDataManagement.Account m
    JOIN SnowFlake.dimyear y ON y.year = SUBSTR(m.timestamp, 1, 4)
    WHERE NOT EXISTS (
        SELECT * 
        FROM SnowFlake.dimmonth
        WHERE SnowFlake.dimmonth.month = SUBSTR(m.timestamp, 6, 2) AND SnowFlake.dimmonth.idYear=y.idYear
    )
";

$queryMonthPerson="INSERT IGNORE INTO SnowFlake.dimmonth (month, idYear)
SELECT DISTINCT SUBSTR(m.dateOfBirth, 6, 2), y.idYear
FROM BankDataManagement.Person m
JOIN SnowFlake.dimyear y ON y.year = SUBSTR(m.dateOfBirth, 1, 4)
WHERE NOT EXISTS (
    SELECT * 
    FROM SnowFlake.dimmonth
    WHERE SnowFlake.dimmonth.month = SUBSTR(m.dateOfBirth, 6, 2) AND SnowFlake.dimmonth.idYear=y.idYear
)

";

$queryMonthOwns="INSERT IGNORE INTO SnowFlake.dimmonth (month, idYear)
SELECT DISTINCT SUBSTR(m.timestamp, 6, 2), y.idYear
FROM BankDataManagement.Owns m
JOIN SnowFlake.dimyear y ON y.year = SUBSTR(m.timestamp, 1, 4)
WHERE NOT EXISTS (
    SELECT * 
    FROM SnowFlake.dimmonth
    WHERE SnowFlake.dimmonth.month = SUBSTR(m.timestamp, 6, 2) AND SnowFlake.dimmonth.idYear=y.idYear
)
        ";


$queryDayAccount="INSERT INTO SnowFlake.dimday (day, idMonth)
    SELECT DISTINCT SUBSTR(d.timestamp, 9, 2), m.idMonth
    FROM BankDataManagement.Account d
    JOIN SnowFlake.dimyear y ON y.year = SUBSTR(d.timestamp, 1, 4)
    JOIN SnowFlake.dimmonth m ON m.month = SUBSTR(d.timestamp, 6, 2)
    WHERE NOT EXISTS (
    SELECT * 
    FROM SnowFlake.dimday
    WHERE SnowFlake.dimday.day = SUBSTR(d.timestamp, 9, 2) AND SnowFlake.dimday.idMonth=m.idMonth
)
";

$queryDayPerson="INSERT INTO SnowFlake.dimday (day, idMonth)
SELECT DISTINCT SUBSTR(d.dateOfBirth, 9, 2), m.idMonth
    FROM BankDataManagement.Person d
    JOIN SnowFlake.dimyear y ON y.year = SUBSTR(d.dateOfBirth, 1, 4)
    JOIN SnowFlake.dimmonth m ON m.month = SUBSTR(d.dateOfBirth, 6, 2)
    WHERE NOT EXISTS (
    SELECT * 
    FROM SnowFlake.dimday
    WHERE SnowFlake.dimday.day = SUBSTR(d.timestamp, 9, 2) AND SnowFlake.dimday.idMonth=m.idMonth
)
";
$queryDayOwns="INSERT INTO SnowFlake.dimday (day, idMonth)
SELECT DISTINCT SUBSTR(d.timestamp, 9, 2), m.idMonth
    FROM BankDataManagement.Owns d
    JOIN SnowFlake.dimyear y ON y.year = SUBSTR(d.timestamp, 1, 4)
    JOIN SnowFlake.dimmonth m ON m.month = SUBSTR(d.timestamp, 6, 2)
    WHERE NOT EXISTS (
    SELECT * 
    FROM SnowFlake.dimday
    WHERE SnowFlake.dimday.day = SUBSTR(d.timestamp, 9, 2) AND SnowFlake.dimday.idMonth=m.idMonth
)
";


if(!mysqli_query($transConn, $queryYear1) or !mysqli_query($transConn, $queryYear3) or !mysqli_query($transConn, $queryYear2) or !mysqli_query($transConn, $queryMonthAccount) or !mysqli_query($transConn, $queryMonthPerson) or 
!mysqli_query($transConn, $queryMonthOwns) or !mysqli_query($transConn, $queryDayAccount) or !mysqli_query($transConn, $queryDayPerson) or !mysqli_query($transConn, $queryDayOwns)){
    echo "ERROR: " . mysqli_error($transConn);
}
else{
    echo "OK DATES <br>";
}

$queryCountry="INSERT IGNORE INTO SnowFlake.dimcountry (country)
SELECT DISTINCT AddressCountry.country
    FROM BankDataManagement.AddressCountry
 ";
 $queryRegion="INSERT IGNORE INTO SnowFlake.dimregion (region, idCountry)
 SELECT DISTINCT p.province, c.idCountry
     FROM BankDataManagement.AddressProvince p
     JOIN BankDataManagement.Address ON p.addressProvId = Address.addressProvId
     JOIN BankDataManagement.AddressCountry ON AddressCountry.addressCountryId = Address.addressCountryId
     JOIN SnowFlake.dimcountry c ON c.country = AddressCountry.country
     WHERE NOT EXISTS (
        SELECT *
        FROM SnowFlake.dimregion
        WHERE SnowFlake.dimregion.region=p.province AND SnowFlake.dimregion.idCountry = c.idCountry
    )
  ";
$queryCity="INSERT IGNORE INTO SnowFlake.dimcity (city, idRegion)
SELECT DISTINCT p.locality, r.idRegion
    FROM BankDataManagement.AddressLocality p
    JOIN BankDataManagement.Address ON p.addressLocId = Address.addressLocId
    JOIN BankDataManagement.AddressProvince ON AddressProvince.addressProvId = Address.addressProvId
    JOIN SnowFlake.dimregion r ON r.region = AddressProvince.province
    WHERE NOT EXISTS (
        SELECT *
        FROM SnowFlake.dimcity
        WHERE SnowFlake.dimcity.city=p.locality AND SnowFlake.dimcity.idRegion = r.idRegion
    )
";
$queryPC="INSERT IGNORE INTO SnowFlake.dimpost (postCode, idCity)
SELECT DISTINCT p.postCode, SnowFlake.dimcity.idCity
    FROM BankDataManagement.AddressPostCode p
    JOIN BankDataManagement.Address ON p.addressPCId = Address.addressPCId
    JOIN BankDataManagement.AddressLocality ON AddressLocality.addressLocId = Address.addressLocId
    JOIN SnowFlake.dimcity ON SnowFlake.dimcity.city = AddressLocality.locality
    WHERE NOT EXISTS (
        SELECT *
        FROM SnowFlake.dimpost
        WHERE SnowFlake.dimpost.postcode=p.postCode
    )
";


if(!mysqli_query($transConn,$queryCountry) or !mysqli_query($transConn,$queryRegion) 
or !mysqli_query($transConn,$queryCity) or !mysqli_query($transConn,$queryPC)){
    echo "ERROR: " . mysqli_error($transConn);
}
else {
    echo "OK ADDRESS <br>";
}

$querySalary=" INSERT IGNORE INTO SnowFlake.dimsalary (salary)
SELECT DISTINCT Person.salary
    FROM BankDataManagement.Person
";




if(!mysqli_query($transConn,$querySalary)){
    echo "ERROR: " . mysqli_error($transConn);
}
else {
    echo "OK SALARY <br>";
}


$queryGender="INSERT IGNORE INTO SnowFlake.dimgender (gender)
    SELECT DISTINCT Person.gender
        FROM BankDataManagement.Person
";

if(!mysqli_query($transConn,$queryGender)){
    echo "ERROR: " . mysqli_error($transConn);
}
else {
    echo "OK GENDER <br>";
}

$querySecond="INSERT IGNORE INTO SnowFlake.dimsecondproducttype VALUES (NULL, 'RequiredProduct'), (NULL, 'OptionalProduct') ";

if(!mysqli_query($transConn,$querySecond)){
    echo "ERROR: " . mysqli_error($transConn);
}
else{
    $queryId="SELECT MIN(idType) AS idType FROM SnowFlake.dimsecondproducttype";
    $resultId = mysqli_query($transConn,$queryId);
    $row = mysqli_fetch_array($resultId);
    $id = $row['idType'];


    $id2= $id+1;
    $queryFirst="INSERT IGNORE INTO SnowFlake.dimfirstproducttype VALUES (NULL, '". $id2 ."', 'account'),(NULL, '" . $id ."', 'loan'), (NULL, '". $id ."', 'creditCardLoan'), (NULL, '" . $id . "', 'financialAsset')";


    if(!mysqli_query($transConn,$queryFirst)){
        echo "ERROR: " . mysqli_error($transConn);
    }
    else {
        echo "OK PRODUCT TYPES <br>";
    }
}

$queryId="SELECT MIN(idType) AS min FROM SnowFlake.dimfirstproducttype";
$resultId = mysqli_query($transConn,$queryId);
$row = mysqli_fetch_array($resultId);
$idac= $row['min'];
$idloan= $idac+1;
$idcc= $idloan+1;
$idfa= $idcc+1;




$insert = "";
$queryDA =  "SELECT DISTINCT DepositAccount.accountId AS transactionalId, 'depositAccount' AS product, 
            Account.amount AS investment, Account.currency AS currency, 'fix' AS type, '0' AS interest
            FROM Account
            INNER JOIN DepositAccount ON Account.accountId = DepositAccount.accountId
            WHERE DATEDIFF(NOW(), DepositAccount.timestamp) < 15
            ";

$querySA =  "SELECT DISTINCT SavingsAccount.accountId AS transactionalId, 'savingsAccount' AS product, 
            Account.amount AS investment, Account.currency AS currency, 'fix' AS type, '0' AS interest
            FROM Account
            INNER JOIN SavingsAccount ON Account.accountId = SavingsAccount.accountId
            WHERE DATEDIFF(NOW(), SavingsAccount.timestamp) < 15
            ";
$queryLoan =   "SELECT DISTINCT Loan.productId AS transactionalId, 'loan' AS product,
               Product.totalAmount AS investment, Account.currency AS 'currency', Interest.interest AS 'interest', IF (Interest.isVariable='1', 'variable', 'fix') AS 'type'
               FROM Loan
               INNER JOIN Owns ON Loan.productId = Owns.productId
               INNER JOIN Account ON Owns.accountId = Account.accountId
               INNER JOIN Interest ON Interest.interestId = Owns.interestId
               INNER JOIN Product ON Product.productId = Loan.productId
               WHERE DATEDIFF(NOW(), Loan.timestamp) < 15
               ";

$queryFA =  "SELECT DISTINCT FinancialAsset.productId AS transactionalId, FinancialAsset.type AS product,
             Product.totalAmount AS investment, Account.currency AS 'currency', Interest.interest AS 'interest', IF (Interest.isVariable='1', 'variable', 'fix') AS 'type'
            FROM FinancialAsset
            INNER JOIN Owns ON FinancialAsset.productId = Owns.productId
            INNER JOIN Account ON Owns.accountId = Account.accountId
            INNER JOIN Interest ON Interest.interestId = Owns.interestId
            INNER JOIN Product ON Product.productId = FinancialAsset.productId
            WHERE DATEDIFF(NOW(), FinancialAsset.timestamp) < 15
            ";

$resultDA = mysqli_query($transConn, $queryDA);
$resultSA = mysqli_query($transConn, $querySA);
$resultLoan = mysqli_query($transConn, $queryLoan);
$resultFA = mysqli_query($transConn, $queryFA);



if(!$resultDA or !$resultSA or !$resultLoan or !$resultFA){
    echo "SELECT PRODUCTS ERROR: " . mysqli_error($transConn);
}
else{
    $insert = "INSERT INTO SnowFlake.dimproduct VALUES";
    $first = TRUE;
    
    while($row = mysqli_fetch_array($resultDA)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }

        $insert .= "(" . 
        "NULL" . "," .
        "'" . $row['transactionalId'] . "'" . "," . 
        "'" . $row['product'] . "'" . "," . 
        "'" . $row['investment'] . "'" . "," . 
        "'" . $idac . "'" . "," . 
        "'" . $row['currency'] . "'" . "," .
        "'" . $row['type'] . "'" . "," .
        "'" .  $row['interest'] . "'". ")";
        
    }
    
    while($row = mysqli_fetch_array($resultFA)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
        $insert .= "(" . 
        "NULL" . "," .
        "'" . $row['transactionalId'] . "'" . "," . 
        "'" . $row['product'] . "'" . "," . 
        "'" . $row['investment'] . "'" . "," . 
        "'" . $idfa . "'" . "," . 
        "'" . $row['currency'] . "'" . "," .
        "'" . $row['type'] . "'" . "," .
        "'" .  $row['interest'] . "'". ")";
        
    }
    
    while($row = mysqli_fetch_array($resultSA)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }

        $insert .= "(" . 
        "NULL" . "," .
        "'" . $row['transactionalId'] . "'" . "," . 
        "'" . $row['product'] . "'" . "," . 
        "'" . $row['investment'] . "'" . "," . 
        "'" . $idac . "'" . "," . 
        "'" . $row['currency'] . "'" . "," .
        "'" . $row['type'] . "'" . "," .
        "'" .  $row['interest'] . "'". ")";
        
    }
    while($row = mysqli_fetch_array($resultLoan)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }

        $insert .= "(" . 
                    "NULL" . "," .
                    "'" . $row['transactionalId'] . "'" . "," . 
                    "'" . $row['product'] . "'" . "," . 
                    "'" . $row['investment'] . "'" . "," . 
                    "'" . $idloan . "'" . "," . 
                    "'" . $row['currency'] . "'" . "," .
                    "'" . $row['type'] . "'" . "," .
                    "'" .  $row['interest'] . "'". ")";
    }
}
$insert .= ";";


if ($insert != "INSERT INTO SnowFlake.SnowFlake.dimproduct VALUES;"){
    if (!mysqli_query($transConn, $insert)) { 
        echo mysqli_error($transConn); 
    } else { 
        echo "OK PRODUCT <br>";
    }
}


$queryCustomer ="INSERT INTO SnowFlake.dimcustomer (idTransactionalCustomer, idBirthDate, idLocation, idSalary, idGender, customerType)
    SELECT  p.personId, SnowFlake.dimday.idDay, SnowFlake.dimpost.idLocation, SnowFlake.dimsalary.idSalary, SnowFlake.dimgender.idGender, NULL
    FROM BankDataManagement.Person p
    JOIN SnowFlake.dimday ON SUBSTR(p.dateOfBirth, 9, 2) = SnowFlake.dimday.day
    JOIN SnowFlake.dimmonth ON SnowFlake.dimmonth.idMonth=SnowFlake.dimday.idMonth
    JOIN SnowFlake.dimyear ON SnowFlake.dimyear.idYear=SnowFlake.dimmonth.idYear
    JOIN BankDataManagement.Address ON p.addressId = BankDataManagement.Address.addressId
    JOIN BankDataManagement.AddressPostCode ON  BankDataManagement.Address.addressPCId = BankDataManagement.AddressPostCode.addressPCId
    JOIN SnowFlake.dimpost ON BankDataManagement.AddressPostCode.postCode = SnowFlake.dimpost.postcode
    JOIN SnowFlake.dimcity ON SnowFlake.dimcity.idCity = SnowFlake.dimpost.idCity
    JOIN SnowFlake.dimregion ON SnowFlake.dimregion.idRegion = SnowFlake.dimcity.idRegion
    JOIN SnowFlake.dimcountry ON SnowFlake.dimcountry.idCountry = SnowFlake.dimregion.idCountry
    JOIN SnowFlake.dimsalary ON SnowFlake.dimsalary.salary = p.salary
    JOIN SnowFlake.dimgender ON p.gender = SnowFlake.dimgender.gender
    WHERE NOT EXISTS (
        SELECT * FROM SnowFlake.dimcustomer WHERE  SnowFlake.dimcustomer.idTransactionalCustomer = p.personId
    )
";

if(!mysqli_query($transConn,$queryCustomer)){
    echo "ERROR: " . mysqli_error($transConn);
}
else{
    echo "OK CUSTOMERS <br>";
}


$unitsSoldQ = "SELECT personId AS personId, COUNT(DISTINCT productId) AS productsSold,  COUNT(DISTINCT accountId) AS accountsSold FROM Owns GROUP BY personId";
$unitsSoldR = mysqli_query($transConn, $unitsSoldQ);

$revenueQ= "SELECT personId AS personId, SUM(totalAmount) AS total FROM Owns INNER JOIN Product ON Owns.productId = Product.productId GROUP BY personId" ;
$revenueR= mysqli_query($transConn, $revenueQ);

$usold;
$total;

if(!$unitsSoldR) {

    echo mysqli_error($transConn);
}
else{

    while($row = mysqli_fetch_array($unitsSoldR)) {

       
        $usold[]=[$row['personId'], ($row['accountsSold'] + $row['productsSold'])];

        
    }
    
    
    
}

if(!$revenueR) {
    echo mysqli_error($transConn);
}
else{

    while($row = mysqli_fetch_array($revenueR)) {

        
        $total[]=[$row['personId'], $row['total']];
        
        
    }
}

$queryFactsP="SELECT DISTINCT SnowFlake.dimday.idDay AS idSellDate, SnowFlake.dimcustomer.idCustomer AS idCustomer,
BankDataManagement.Owns.productId AS idProduct, BankDataManagement.Owns.personId AS personId
FROM SnowFlake.dimproduct
JOIN BankDataManagement.Product ON SnowFlake.dimproduct.transactionalId = BankDataManagement.Product.productId
JOIN BankDataManagement.Owns ON  BankDataManagement.Product.productId = BankDataManagement.Owns.productId
JOIN SnowFlake.dimday ON SUBSTR(Owns.timestamp, 9, 2) = SnowFlake.dimday.day
JOIN SnowFlake.dimmonth ON SnowFlake.dimmonth.idMonth=SnowFlake.dimday.idMonth
JOIN SnowFlake.dimyear ON SnowFlake.dimyear.idYear=SnowFlake.dimmonth.idYear
JOIN SnowFlake.dimcustomer ON BankDataManagement.Owns.personId = SnowFlake.dimcustomer.idTransactionalCustomer
";

$queryFactsA="SELECT DISTINCT SnowFlake.dimday.idDay AS idSellDate, SnowFlake.dimcustomer.idCustomer AS idCustomer,
BankDataManagement.Account.accountId AS idProduct, BankDataManagement.Owns.personId AS personId
FROM SnowFlake.dimproduct
JOIN BankDataManagement.Account ON SnowFlake.dimproduct.transactionalId = BankDataManagement.Account.accountId
JOIN SnowFlake.dimday ON SUBSTR(Account.timestamp, 9, 2) = SnowFlake.dimday.day
JOIN SnowFlake.dimmonth ON SnowFlake.dimmonth.idMonth=SnowFlake.dimday.idMonth
JOIN SnowFlake.dimyear ON SnowFlake.dimyear.idYear=SnowFlake.dimmonth.idYear
JOIN BankDataManagement.Owns ON BankDataManagement.Owns.accountId = BankDataManagement.Account.accountId
JOIN SnowFlake.dimcustomer ON BankDataManagement.Owns.personId = SnowFlake.dimcustomer.idTransactionalCustomer
";


$resultA=mysqli_query($transConn, $queryFactsA);
$resultP=mysqli_query($transConn, $queryFactsP);

if(!$resultA or !$resultP){
    echo mysqli_error($transConn);
}
else{
    
    $insert = "INSERT IGNORE INTO SnowFlake.factsells VALUES";
    $first = TRUE;
    while($row = mysqli_fetch_array($resultA)) {
        
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
        for($i=0; $i<sizeof($usold);$i++){
            if($usold[$i][0] == $row['personId']){
                $x=$i;
                
            break;
            }
        }
       
        $insert .= "(" . 
                        "'" . $row['idProduct'] . "'" . "," . 
                        "'" . $row['idCustomer'] . "'" . "," . 
                        "'" . $row['idSellDate'] . "'" . "," . 
                        "'" . $usold[$x][1] . "'" . "," .
                        "'" . $total[$x][1] . "'" . ")" ;
                        
        
        
    }
    while($row = mysqli_fetch_array($resultP)) {
        
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
        
       
        $insert .= "(" . 
                        "'" . $row['idProduct'] . "'" . "," . 
                        "'" . $row['idCustomer'] . "'" . "," . 
                        "'" . $row['idSellDate'] . "'" . "," . 
                        "'" . $usold[$x][1] . "'" . "," .
                        "'" . $total[$x][1] . "'" . ")" ;
                        
  
        
    }
}


if ($insert != "INSERT IGNORE INTO SnowFlake.factsells VALUES;"){

    if(!mysqli_query($transConn, $insert)){
        echo mysqli_error($transConn);
    }
    else{
        echo "OK FACT SELLS";
    }
}


mysqli_close($transConn);
?>