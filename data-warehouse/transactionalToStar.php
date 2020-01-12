
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "";
$starDB = "StarSchema"; 
$transDB = "BankDataManagement"; 

$transConn = mysqli_connect( $servername, $username, $password, $transDB, true ); 
$starConn = mysqli_connect( $servername, $username, $password, $starDB, true ); 

ini_set('memory_limit', '5G'); 

if ( !$starConn) { 
    die("Connection to StarSchema DB failed: " . mysqli_connect_error()); 
} 


if ( !$transConn) { 
    die("Connection to BankDataManagement DB failed: " . mysqli_connect_error()); 
}

//------------------------- FILL DIM CUSTOMER LOCATION ----------------------------

 
$query =    "INSERT INTO StarSchema.dimcustomerlocation (postcode, city, region, country)
            SELECT DISTINCT AddressPostCode.postCode, AddressLocality.locality, AddressProvince.province,
            AddressCountry.country
            FROM Account 
            INNER JOIN Owns 
                ON Account.accountId=Owns.accountId
            INNER JOIN Person 
                ON Person.personId=Owns.personId
            INNER JOIN Address
                ON Person.addressId=Address.addressId
            INNER JOIN AddressLocality 
                ON Address.addressLocId=AddressLocality.addressLocId
            INNER JOIN AddressPostCode 
                ON Address.addressPCId=AddressPostCode.addressPCId
            INNER JOIN AddressProvince
                ON Address.addressProvId=AddressProvince.addressProvId
            INNER JOIN AddressCountry
                ON Address.addressCountryId=AddressCountry.addressCountryId
            WHERE DATEDIFF(NOW(), Address.timestamp) < 15
            ";

$result = mysqli_query($transConn, $query);
if(!$result){
    echo "FILL LOCATION ERROR: " . mysqli_error($transConn);
}



//------------------------- FILL DIM PRODUCT -----------------------

$insert = "";
$queryDA =  "SELECT DISTINCT DepositAccount.accountId AS transactionalId, 'depositAccount' AS product, 
            Account.amount AS investment, Account.currency AS currency, 'fix' AS interestType, '0' AS interest
            FROM Account
            INNER JOIN DepositAccount ON Account.accountId = DepositAccount.accountId
            WHERE DATEDIFF(NOW(), DepositAccount.timestamp) < 15
            ";

$querySA =  "SELECT DISTINCT SavingsAccount.accountId AS transactionalId, 'savingsAccount' AS product, 
            Account.amount AS investment, Account.currency AS currency, 'fix' AS interestType, '0' AS interest
            FROM Account
            INNER JOIN SavingsAccount ON Account.accountId = SavingsAccount.accountId
            WHERE DATEDIFF(NOW(), SavingsAccount.timestamp) < 15
            ";
$queryLoan =   "SELECT DISTINCT Loan.productId AS transactionalId, 'loan' AS product,
               Product.totalAmount AS investment, Account.currency AS 'currency', Interest.interest AS 'interest', IF (Interest.isVariable='1', 'variable', 'fix') AS 'interestType'
               FROM Loan
               INNER JOIN Owns ON Loan.productId = Owns.productId
               INNER JOIN Account ON Owns.accountId = Account.accountId
               INNER JOIN Interest ON Interest.interestId = Owns.interestId
               INNER JOIN Product ON Product.productId = Loan.productId
               WHERE DATEDIFF(NOW(), Loan.timestamp) < 15
               ";

$queryFA =  "SELECT DISTINCT FinancialAsset.productId AS transactionalId, FinancialAsset.type AS product,
             Product.totalAmount AS investment, Account.currency AS 'currency', Interest.interest AS 'interest', IF (Interest.isVariable='1', 'variable', 'fix') AS 'interestType'
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
    $insert = "INSERT INTO `dimproduct` VALUES";
    $first = TRUE;
    
    while($row1 = mysqli_fetch_array($resultDA)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }

        $insert .= "(" . 
                    "NULL" . "," .
                    "'" . $row1['transactionalId'] . "'" . "," . 
                    "'" . $row1['product'] . "'" . "," . 
                    "'" . $row1['investment'] . "'" . "," . 
                    "'" . $row1['currency'] . "'" . "," . 
                    "'" . $row1['interestType'] . "'" . "," .
                    "'" .  $row1['interest'] . "'". ")";
        
    }
    
    while($row2 = mysqli_fetch_array($resultFA)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
        $insert .= "(" . 
                    "NULL" . "," .
                    "'" . $row2['transactionalId'] . "'" . "," . 
                    "'" . $row2['product'] . "'" . "," .
                    "'" . $row2['investment'] . "'" . "," . 
                    "'" . $row2['currency'] . "'" . "," . 
                    "'" . $row2['interestType'] . "'" . "," .
                    "'" .  $row2['interest'] . "'". ")";
        
    }
    
    while($row3 = mysqli_fetch_array($resultSA)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }

        $insert .= "(" . 
                    "NULL" . "," .
                    "'" . $row3['transactionalId'] . "'" . "," . 
                    "'" . $row3['product'] . "'" . "," . 
                    "'" . $row3['investment'] . "'" . "," . 
                    "'" . $row3['currency'] . "'" . "," . 
                    "'" . $row3['interestType'] . "'" . "," .
                    "'" .  $row3['interest'] . "'". ")";
        
    }
    while($row4 = mysqli_fetch_array($resultLoan)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }

        $insert .= "(" . 
                    "NULL" . "," .
                    "'" . $row4['transactionalId'] . "'" . "," . 
                    "'" . $row4['product'] . "'" . "," . 
                    "'" . $row4['investment'] . "'" . "," . 
                    "'" . $row4['currency'] . "'" . "," . 
                    "'" . $row4['interestType'] . "'" . "," .
                    "'" .  $row4['interest'] . "'". ")";
    }
}
$insert .= ";";


if ($insert != "INSERT INTO `dimproduct` VALUES;"){
    if (mysqli_query($starConn, $insert)) { 
        echo "dim product filled". "<br>". "<br>"; 
    } else { 
        echo "FILL PRODUCTS ERROR: " . mysqli_error($starConn); 
    }
}

//------------------------- FILL DIM DATE -----------------------

$queryBD =  "SELECT DISTINCT Person.dateOfBirth AS date
            FROM Person
            INNER JOIN Owns ON Person.personId = Owns.personId
            WHERE DATEDIFF(NOW(), Person.timestamp) < 15

            ";

$resultBD = mysqli_query($transConn, $queryBD);

$querysell =    "SELECT DISTINCT Owns.timestamp AS date
                FROM Owns
                WHERE DATEDIFF(NOW(), Owns.timestamp) < 15

                ";
$resultsell = mysqli_query($transConn, $querysell);

$queryaccount =    "SELECT DISTINCT Account.timestamp AS date
            FROM Account
            WHERE DATEDIFF(NOW(), Account.timestamp) < 15

            ";
$resultaccount = mysqli_query($transConn, $queryaccount);

if(!$resultBD or !$resultsell or !$resultaccount){
    echo "SELECT DATE ERROR: " . mysqli_error($transConn);
}
else{
    $insert = "INSERT IGNORE INTO `dimdate` VALUES";
    $first = TRUE;
    while($row = mysqli_fetch_array($resultBD)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
        $day = substr ($row['date'], -2, 2);
        $month = substr ($row['date'], -5, 2);
        $year = substr ($row['date'], 0, 4);
       
        $insert .= "(" . "NULL" . "," . "'" . $day . "'" . "," . "'" . $month . "'" . "," . "'" . $year . "'" . ")";
        
    }
    while($row = mysqli_fetch_array($resultsell)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
        $day = substr ($row['date'], 8, 2);
        $month = substr ($row['date'], 5, 2);
        $year = substr ($row['date'], 0, 4);
       
        $insert .= "(" . "NULL" . "," . "'" . $day . "'" . "," . "'" . $month . "'" . "," . "'" . $year . "'" . ")";
        
    }
    while($row = mysqli_fetch_array($resultaccount)) {
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
        $day = substr ($row['date'], 8, 2);
        $month = substr ($row['date'], 5, 2);
        $year = substr ($row['date'], 0, 4);
       
        $insert .= "(" . "NULL" . "," . "'" . $day . "'" . "," . "'" . $month . "'" . "," . "'" . $year . "'" . ")";
        
    }
}
$insert .= ";";

if ($insert != "INSERT IGNORE INTO `dimdate` VALUES;"){
    if (mysqli_query($starConn, $insert)) { 
        echo "dim date filled". "<br>". "<br>"; 
    } else { 
        echo "FILL DATE ERROR: " . mysqli_error($starConn); 
    }
}


//------------------------- FILL 1ST PRODUCT TYPE -----------------------

$insert = "INSERT INTO `dimFirstProductType` VALUES (NULL, 'account'),(NULL, 'loan'), (NULL, 'creditCardLoan'), (NULL, 'financialAsset')
           
            ";

if (mysqli_query($starConn, $insert)) { 
    echo "dim FirstProductType filled". "<br>". "<br>"; 
} else { 
    echo "ERROR FILL 1ST TYPE" . mysqli_error($starConn); 
}

//------------------------- FILL 2ND PRODUCT TYPE -----------------------

$insert = "INSERT INTO `dimSecondProductType` VALUES (NULL, 'RequiredProduct'), (NULL, 'OptionalProduct')
                   
                   
    ";

if (mysqli_query($starConn, $insert)) { 
    echo "dim SecondProductType filled". "<br>". "<br>"; 
} else { 
    echo "ERROR FILL 2ND TYPE"  . mysqli_error($starConn); 
}
 

//------------------------- FILL FACT SELLS -----------------------

$unitsSoldQ = "SELECT personId AS personId, COUNT(DISTINCT productId) AS productsSold,  COUNT(DISTINCT accountId) AS accountsSold FROM Owns GROUP BY personId";
$unitsSoldR = mysqli_query($transConn, $unitsSoldQ);

$revenueQ= "SELECT personId AS personId, SUM(totalAmount) AS total FROM Owns INNER JOIN Product ON Owns.productId = Product.productId GROUP BY personId" ;
$revenueR= mysqli_query($transConn, $revenueQ);

$usold=[];
$total=[];

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


$queryaccount =    "SELECT StarSchema.dimproduct.idProduct AS idProduct, StarSchema.dimFirstProductType.idType AS idFirstProductType,  StarSchema.dimSecondProductType.idType AS idSecondProductType,
            sell.idDate AS idSellDate, bday.idDate AS idCustomerBirthdate, StarSchema.dimcustomerlocation.idLocation AS idCustomerLocation,
            Person.salary AS salary, Person.gender AS gender, Person.personId AS idCustomer
            FROM StarSchema.dimproduct
            INNER JOIN Account ON StarSchema.dimproduct.transactionalId = Account.accountId
            INNER JOIN StarSchema.dimdate AS sell ON sell.day = SUBSTR(Account.timestamp, 9, 2) AND sell.month = SUBSTR(Account.timestamp, 6, 2) AND sell.year = SUBSTR(Account.timestamp, 1, 4)
            INNER JOIN Owns ON StarSchema.dimproduct.transactionalId = Owns.accountId
            INNER JOIN Person ON Person.personId = Owns.personId
            INNER JOIN StarSchema.dimdate AS bday ON bday.day = SUBSTR(Person.dateOfBirth, 9, 2) AND bday.month = SUBSTR(Person.dateOfBirth, 6, 2) AND bday.year = SUBSTR(Person.dateOfBirth, 1, 4)
            INNER JOIN Address ON Person.addressId = Address.addressId
            INNER JOIN AddressCountry ON Address.addressCountryId
            INNER JOIN AddressPostCode ON Address.addressPCId
            INNER JOIN AddressLocality ON Address.addressLocId
            INNER JOIN AddressProvince ON Address.addressProvId
            INNER JOIN StarSchema.dimcustomerlocation ON 
                    StarSchema.dimcustomerlocation.postcode = AddressPostCode.postcode
                AND AddressLocality.locality = StarSchema.dimcustomerlocation.city
                AND AddressProvince.province = StarSchema.dimcustomerlocation.region
                AND AddressCountry.country = StarSchema.dimcustomerlocation.country
            INNER JOIN StarSchema.dimFirstProductType ON StarSchema.dimFirstProductType.type = 'account'
            INNER JOIN StarSchema.dimSecondProductType ON StarSchema.dimSecondProductType.type = 'RequiredProduct'
            WHERE StarSchema.dimproduct.product='depositAccount' OR  StarSchema.dimproduct.product='savingsAccount'
            "; 


$queryloan =    "SELECT StarSchema.dimproduct.idProduct AS idProduct, StarSchema.dimFirstProductType.idType AS idFirstProductType,  StarSchema.dimSecondProductType.idType AS idSecondProductType,
            sell.idDate AS idSellDate, bday.idDate AS idCustomerBirthdate, StarSchema.dimcustomerlocation.idLocation AS idCustomerLocation,
            Person.salary AS salary, Person.gender AS gender, Person.personId AS idCustomer
            FROM StarSchema.dimproduct
            INNER JOIN Product ON StarSchema.dimproduct.transactionalId = Product.productId
            INNER JOIN Loan ON Loan.productId = Product.productId
            INNER JOIN StarSchema.dimdate AS sell ON sell.day = SUBSTR(Loan.timestamp, 9, 2) AND sell.month = SUBSTR(Loan.timestamp, 6, 2) AND sell.year = SUBSTR(Loan.timestamp, 1, 4)
            INNER JOIN Owns ON StarSchema.dimproduct.transactionalId = Owns.productId
            INNER JOIN Person ON Person.personId = Owns.personId
            INNER JOIN StarSchema.dimdate AS bday ON bday.day = SUBSTR(Person.dateOfBirth, 9, 2) AND bday.month = SUBSTR(Person.dateOfBirth, 6, 2) AND bday.year = SUBSTR(Person.dateOfBirth, 1, 4)
            INNER JOIN Address ON Person.addressId = Address.addressId
            INNER JOIN AddressCountry ON Address.addressCountryId
            INNER JOIN AddressPostCode ON Address.addressPCId
            INNER JOIN AddressLocality ON Address.addressLocId
            INNER JOIN AddressProvince ON Address.addressProvId
            INNER JOIN StarSchema.dimcustomerlocation ON 
                    StarSchema.dimcustomerlocation.postcode = AddressPostCode.postcode
                AND AddressLocality.locality = StarSchema.dimcustomerlocation.city
                AND AddressProvince.province = StarSchema.dimcustomerlocation.region
                AND AddressCountry.country = StarSchema.dimcustomerlocation.country
            INNER JOIN StarSchema.dimFirstProductType ON StarSchema.dimFirstProductType.type = 'loan'
            INNER JOIN StarSchema.dimSecondProductType ON StarSchema.dimSecondProductType.type = 'OptionalProduct'
                WHERE Loan.cardId IS NOT NULL AND StarSchema.dimproduct.product='loan'

            "; 

$querycardloan =    "SELECT StarSchema.dimproduct.idProduct AS idProduct, StarSchema.dimFirstProductType.idType AS idFirstProductType,  StarSchema.dimSecondProductType.idType AS idSecondProductType,
sell.idDate AS idSellDate, bday.idDate AS idCustomerBirthdate, StarSchema.dimcustomerlocation.idLocation AS idCustomerLocation,
Person.salary AS salary, Person.gender AS gender, Person.personId AS idCustomer
FROM StarSchema.dimproduct
INNER JOIN Product ON StarSchema.dimproduct.transactionalId = Product.productId
INNER JOIN Loan ON Loan.productId = Product.productId
INNER JOIN StarSchema.dimdate AS sell ON sell.day = SUBSTR(Loan.timestamp, 9, 2) AND sell.month = SUBSTR(Loan.timestamp, 6, 2) AND sell.year = SUBSTR(Loan.timestamp, 1, 4)
INNER JOIN Owns ON StarSchema.dimproduct.transactionalId = Owns.productId
INNER JOIN Person ON Person.personId = Owns.personId
INNER JOIN StarSchema.dimdate AS bday ON bday.day = SUBSTR(Person.dateOfBirth, 9, 2) AND bday.month = SUBSTR(Person.dateOfBirth, 6, 2) AND bday.year = SUBSTR(Person.dateOfBirth, 1, 4)
INNER JOIN Address ON Person.addressId = Address.addressId
INNER JOIN AddressCountry ON Address.addressCountryId
INNER JOIN AddressPostCode ON Address.addressPCId
INNER JOIN AddressLocality ON Address.addressLocId
INNER JOIN AddressProvince ON Address.addressProvId
INNER JOIN StarSchema.dimcustomerlocation ON 
        StarSchema.dimcustomerlocation.postcode = AddressPostCode.postcode
    AND AddressLocality.locality = StarSchema.dimcustomerlocation.city
    AND AddressProvince.province = StarSchema.dimcustomerlocation.region
    AND AddressCountry.country = StarSchema.dimcustomerlocation.country
INNER JOIN StarSchema.dimFirstProductType ON StarSchema.dimFirstProductType.type = 'creditCardLoan'
INNER JOIN StarSchema.dimSecondProductType ON StarSchema.dimSecondProductType.type = 'OptionalProduct'
    WHERE Loan.cardId IS NULL AND StarSchema.dimproduct.product='loan'
"; 


$queryfa=    "SELECT StarSchema.dimproduct.idProduct AS idProduct, StarSchema.dimFirstProductType.idType AS idFirstProductType,  StarSchema.dimSecondProductType.idType AS idSecondProductType,
sell.idDate AS idSellDate, bday.idDate AS idCustomerBirthdate, StarSchema.dimcustomerlocation.idLocation AS idCustomerLocation,
Person.salary AS salary, Person.gender AS gender, Person.personId AS idCustomer
FROM StarSchema.dimproduct
INNER JOIN Product ON StarSchema.dimproduct.transactionalId = Product.productId
INNER JOIN FinancialAsset ON FinancialAsset.productId = Product.productId
INNER JOIN StarSchema.dimdate AS sell ON sell.day = SUBSTR(FinancialAsset.timestamp, 9, 2) AND sell.month = SUBSTR(FinancialAsset.timestamp, 6, 2) AND sell.year = SUBSTR(FinancialAsset.timestamp, 1, 4)
INNER JOIN Owns ON StarSchema.dimproduct.transactionalId = Owns.productId
INNER JOIN Person ON Person.personId = Owns.personId
INNER JOIN StarSchema.dimdate AS bday ON bday.day = SUBSTR(Person.dateOfBirth, 9, 2) AND bday.month = SUBSTR(Person.dateOfBirth, 6, 2) AND bday.year = SUBSTR(Person.dateOfBirth, 1, 4)
INNER JOIN Address ON Person.addressId = Address.addressId
INNER JOIN AddressCountry ON Address.addressCountryId
INNER JOIN AddressPostCode ON Address.addressPCId
INNER JOIN AddressLocality ON Address.addressLocId
INNER JOIN AddressProvince ON Address.addressProvId
INNER JOIN StarSchema.dimcustomerlocation ON 
        StarSchema.dimcustomerlocation.postcode = AddressPostCode.postcode
    AND AddressLocality.locality = StarSchema.dimcustomerlocation.city
    AND AddressProvince.province = StarSchema.dimcustomerlocation.region
    AND AddressCountry.country = StarSchema.dimcustomerlocation.country
INNER JOIN StarSchema.dimFirstProductType ON StarSchema.dimFirstProductType.type = 'financialAsset'
INNER JOIN StarSchema.dimSecondProductType ON StarSchema.dimSecondProductType.type = 'OptionalProduct'
WHERE StarSchema.dimproduct.product='bankDesposit' OR StarSchema.dimproduct.product='investmentFund' OR StarSchema.dimproduct.product='pensionFund' OR StarSchema.dimproduct.product='stockExchange'
"; 




$resultaccount = mysqli_query($transConn, $queryaccount);

$resultloan = mysqli_query($transConn, $queryloan);

$resultcardloan = mysqli_query($transConn, $querycardloan);

$resultfa = mysqli_query($transConn, $queryfa);


if(!$resultaccount  or !$resultloan or !$resultcardloan  or !$resultfa){
    echo mysqli_error($transConn);
    echo mysqli_error($starConn);
}

else{
    
    $insert = "INSERT INTO `factsells` VALUES";
    $first = TRUE;
    while($row = mysqli_fetch_array($resultaccount)) {
        
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
       
        $insert .= "(" . 
                        
                        "'" . $row['idProduct'] . "'" . "," . 
                        "'" . $row['idFirstProductType'] . "'" . "," . 
                        "'" . $row['idSecondProductType'] . "'" . "," . 
                        "'" . $row['idSellDate'] . "'" . "," . 
                        "'" . $row['idCustomerBirthdate'] . "'" . "," .
                        "'" . $row['idCustomerLocation'] . "'" . "," .
                        "'" . $row['salary'] . "'" . "," .
                        "'" . $row['gender'] . "'" . "," .
                        "'" . $row['idCustomer'] . "'" . "," .
                        "'" . $usold[0]['1'] . "'" . "," .
                        "'" . $total[0]['1'] . "'" . "," .
                        "NULL" . ")" ;
                        
     
        
    }
    while($row = mysqli_fetch_array($resultloan)) {
        
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
       
        $insert .= "(" . 
                        
                        "'" . $row['idProduct'] . "'" . "," . 
                        "'" . $row['idFirstProductType'] . "'" . "," . 
                        "'" . $row['idSecondProductType'] . "'" . "," . 
                        "'" . $row['idSellDate'] . "'" . "," . 
                        "'" . $row['idCustomerBirthdate'] . "'" . "," .
                        "'" . $row['idCustomerLocation'] . "'" . "," .
                        "'" . $row['salary'] . "'" . "," .
                        "'" . $row['gender'] . "'" . "," .
                        "'" . $row['idCustomer'] . "'" . "," .
                        "'" . $usold[0]['1'] . "'" . "," .
                        "'" . $total[0]['1'] . "'" . "," .
                        "NULL" . ")" ;
                        
     
        
    }
    while($row = mysqli_fetch_array($resultcardloan)) {
        
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
       
        $insert .= "(" . 
                        
                        "'" . $row['idProduct'] . "'" . "," . 
                        "'" . $row['idFirstProductType'] . "'" . "," . 
                        "'" . $row['idSecondProductType'] . "'" . "," . 
                        "'" . $row['idSellDate'] . "'" . "," . 
                        "'" . $row['idCustomerBirthdate'] . "'" . "," .
                        "'" . $row['idCustomerLocation'] . "'" . "," .
                        "'" . $row['salary'] . "'" . "," .
                        "'" . $row['gender'] . "'" . "," .
                        "'" . $row['idCustomer'] . "'" . "," .
                        "'" . $usold[0]['1'] . "'" . "," .
                        "'" . $total[0]['1'] . "'" . "," .
                        "NULL" . ")" ;
                        
     
        
    }
    while($row = mysqli_fetch_array($resultfa)) {
        
        if(!$first){
            $insert .= ",";
        }
        else{
            $first=FALSE;
        }
       
       
        $insert .= "(" . 
                       
                        "'" . $row['idProduct'] . "'" . "," . 
                        "'" . $row['idFirstProductType'] . "'" . "," . 
                        "'" . $row['idSecondProductType'] . "'" . "," . 
                        "'" . $row['idSellDate'] . "'" . "," . 
                        "'" . $row['idCustomerBirthdate'] . "'" . "," .
                        "'" . $row['idCustomerLocation'] . "'" . "," .
                        "'" . $row['salary'] . "'" . "," .
                        "'" . $row['gender'] . "'" . "," .
                        "'" . $row['idCustomer'] . "'" . "," .
                        "'" . $usold[0]['1'] . "'" . "," .
                        "'" . $total[0]['1'] . "'" . "," .
                        "NULL" . ")" ;
                        
     
        
    }
}
if ($insert != "INSERT IGNORE INTO `factsells` VALUES;"){

    if(!mysqli_query($starConn, $insert)){
        echo mysqli_error($transConn);
        echo mysqli_error($starConn);
    }
    else{
        echo "ok";
    }
}


mysqli_close($transConn);
mysqli_close($starConn); 
?>