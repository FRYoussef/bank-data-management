<?php 

  $servername = "localhost";
  $usernameDB = "administrador";
  $passwordDB = "administrador";
  $dbname = "bankdatamanagement";
      // Crear la conexión
  $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
      // Comprobar la conexión
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  
  $queryDA =  "SELECT DISTINCT 'DepositAccount' AS productType, 'account' AS productFirstCategory,
			'RequieredProduct' AS productSecondCategory, DepositAccount.accountId AS productTransactionalId,
            Account.amount AS productInvestment, Account.currency AS currency, 'fix' AS interestType, DepositAccount.timestamp AS sellDate,
			'0' AS interest, Person.personId AS customerId, Person.dateOfBirth AS customerBirthDate, 
			AddressPostCode.postCode AS customerPostCode, AddressLocality.locality AS customerCity, 
			AddressProvince.province AS customerRegion, AddressCountry.country AS customerCountry, 
			Person.salary AS customerSalary, Person.gender AS customerGender,
			(SELECT COUNT(DISTINCT productId)FROM Owns where Owns.personId=customerId) AS customerProducts,
			(SELECT COUNT(DISTINCT accountId)FROM Owns where Owns.personId=customerId) AS customerAccounts,
			(SELECT SUM(totalAmount) FROM Owns INNER JOIN Product ON Owns.productId = Product.productId where Owns.personId=customerId) AS customerTotalRevenue
            FROM Account
            INNER JOIN DepositAccount ON Account.accountId = DepositAccount.accountId
			INNER JOIN Owns ON Owns.accountId = Account.accountId
			INNER JOIN Person ON Person.personId = Owns.personId 
			INNER JOIN Address ON Address.addressId = Person.addressId
			INNER JOIN AddressPostCode ON AddressPostCode.addressPCId = Address.addressPCId
			INNER JOIN AddressLocality ON AddressLocality.addressLocId = Address.addressLocId
			INNER JOIN AddressProvince ON AddressProvince.addressProvId = Address.addressProvId
			INNER JOIN AddressCountry ON AddressCountry.addressCountryId = Address.addressCountryId
            WHERE DATEDIFF(NOW(), DepositAccount.timestamp) < 15
            ";
    $querySA =  "SELECT DISTINCT 'SavingsAccount' AS productType, 'account' AS productFirstCategory,
			'RequieredProduct' AS productSecondCategory, SavingsAccount.accountId AS productTransactionalId,
            Account.amount AS productInvestment, Account.currency AS currency, 'fix' AS interestType, '0' AS interest, SavingsAccount.timestamp AS sellDate,
			Person.personId AS customerId, Person.dateOfBirth AS customerBirthDate, AddressPostCode.postCode AS customerPostCode,
			AddressLocality.locality AS customerCity, AddressProvince.province AS customerRegion, 
			AddressCountry.country AS customerCountry, Person.salary AS customerSalary, Person.gender AS customerGender,
			(SELECT COUNT(DISTINCT productId)FROM Owns where Owns.personId=customerId) AS customerProducts,
			(SELECT COUNT(DISTINCT accountId)FROM Owns where Owns.personId=customerId) AS customerAccounts,
			(SELECT SUM(totalAmount) FROM Owns INNER JOIN Product ON Owns.productId = Product.productId where Owns.personId=customerId) AS customerTotalRevenue
            FROM Account
            INNER JOIN SavingsAccount ON Account.accountId = SavingsAccount.accountId
			INNER JOIN Owns ON Owns.accountId = Account.accountId
			INNER JOIN Person ON Person.personId = Owns.personId 
			INNER JOIN Address ON Address.addressId = Person.addressId
			INNER JOIN AddressPostCode ON AddressPostCode.addressPCId = Address.addressPCId
			INNER JOIN AddressLocality ON AddressLocality.addressLocId = Address.addressLocId
			INNER JOIN AddressProvince ON AddressProvince.addressProvId = Address.addressProvId
			INNER JOIN AddressCountry ON AddressCountry.addressCountryId = Address.addressCountryId
            WHERE DATEDIFF(NOW(), SavingsAccount.timestamp) < 15
            ";
	$queryFA =  "SELECT DISTINCT IF(FinancialAsset.type='investmentFund', 'InvestmentFund', 
									IF(FinancialAsset.type='bankDeposit', 'BankDeposit', 
									IF(FinancialAsset.type='pensionFund', 'PensionFund', 
									IF(FinancialAsset.type='stockExchange', 'StockExchange', 'Error')))) AS productType, 
			'FinancialAsset' AS productFirstCategory, 'OptionalProduct' AS productSecondCategory, 
			FinancialAsset.assetId AS productTransactionalId, Product.totalAmount AS productInvestment, 
			Account.currency AS currency, IF (Interest.isVariable='1', 'variable', 'fix') AS interestType, 
			Interest.interest AS interest, FinancialAsset.timestamp AS sellDate, Person.personId AS customerId, Person.dateOfBirth AS customerBirthDate, 
			AddressPostCode.postCode AS customerPostCode, AddressLocality.locality AS customerCity, 
			AddressProvince.province AS customerRegion, AddressCountry.country AS customerCountry, 
			Person.salary AS customerSalary, Person.gender AS customerGender,
			(SELECT COUNT(DISTINCT productId)FROM Owns where Owns.personId=customerId) AS customerProducts,
			(SELECT COUNT(DISTINCT accountId)FROM Owns where Owns.personId=customerId) AS customerAccounts,
			(SELECT SUM(totalAmount) FROM Owns INNER JOIN Product ON Owns.productId = Product.productId where Owns.personId=customerId) AS customerTotalRevenue
            FROM Product
            INNER JOIN FinancialAsset ON Product.productId = FinancialAsset.productId
			INNER JOIN Owns ON Owns.productId = Product.productId
			INNER JOIN Account ON Account.accountId = Owns.accountId
			INNER JOIN Person ON Person.personId = Owns.personId 
			INNER JOIN Interest ON Interest.interestId = Owns.interestId
			INNER JOIN Address ON Address.addressId = Person.addressId
			INNER JOIN AddressPostCode ON AddressPostCode.addressPCId = Address.addressPCId
			INNER JOIN AddressLocality ON AddressLocality.addressLocId = Address.addressLocId
			INNER JOIN AddressProvince ON AddressProvince.addressProvId = Address.addressProvId
			INNER JOIN AddressCountry ON AddressCountry.addressCountryId = Address.addressCountryId
            WHERE DATEDIFF(NOW(), FinancialAsset.timestamp) < 15
            ";
			
	$queryLoan =  "SELECT DISTINCT 'Loan' AS productType, 
			'Loan' AS productFirstCategory, 'OptionalProduct' AS productSecondCategory, 
			Loan.loanId AS productTransactionalId, Product.totalAmount AS productInvestment, 
			Account.currency AS currency, IF (Interest.isVariable='1', 'variable', 'fix') AS interestType, 
			Interest.interest AS interest, Loan.timestamp AS sellDate, Person.personId AS customerId, Person.dateOfBirth AS customerBirthDate, 
			AddressPostCode.postCode AS customerPostCode, AddressLocality.locality AS customerCity, 
			AddressProvince.province AS customerRegion, AddressCountry.country AS customerCountry, 
			Person.salary AS customerSalary, Person.gender AS customerGender,
			(SELECT COUNT(DISTINCT productId)FROM Owns where Owns.personId=customerId) AS customerProducts,
			(SELECT COUNT(DISTINCT accountId)FROM Owns where Owns.personId=customerId) AS customerAccounts,
			(SELECT SUM(totalAmount) FROM Owns INNER JOIN Product ON Owns.productId = Product.productId where Owns.personId=customerId) AS customerTotalRevenue
            FROM Product
            INNER JOIN Loan ON Product.productId = Loan.productId
			INNER JOIN Owns ON Owns.productId = Product.productId
			INNER JOIN Account ON Account.accountId = Owns.accountId
			INNER JOIN Person ON Person.personId = Owns.personId 
			INNER JOIN Interest ON Interest.interestId = Owns.interestId
			INNER JOIN Address ON Address.addressId = Person.addressId
			INNER JOIN AddressPostCode ON AddressPostCode.addressPCId = Address.addressPCId
			INNER JOIN AddressLocality ON AddressLocality.addressLocId = Address.addressLocId
			INNER JOIN AddressProvince ON AddressProvince.addressProvId = Address.addressProvId
			INNER JOIN AddressCountry ON AddressCountry.addressCountryId = Address.addressCountryId
            WHERE DATEDIFF(NOW(), Loan.timestamp) < 15 and Loan.cardId IS NULL
            ";
			
	$queryCardLoan =  "SELECT DISTINCT 'Loan' AS productType, 
			'CreditCardLoan' AS productFirstCategory, 'OptionalProduct' AS productSecondCategory, 
			Loan.loanId AS productTransactionalId, Product.totalAmount AS productInvestment, 
			Account.currency AS currency, IF (Interest.isVariable='1', 'variable', 'fix') AS interestType, 
			Interest.interest AS interest, Loan.timestamp AS sellDate, Person.personId AS customerId, Person.dateOfBirth AS customerBirthDate, 
			AddressPostCode.postCode AS customerPostCode, AddressLocality.locality AS customerCity, 
			AddressProvince.province AS customerRegion, AddressCountry.country AS customerCountry, 
			Person.salary AS customerSalary, Person.gender AS customerGender,
			(SELECT COUNT(DISTINCT productId)FROM Owns where Owns.personId=customerId) AS customerProducts,
			(SELECT COUNT(DISTINCT accountId)FROM Owns where Owns.personId=customerId) AS customerAccounts,
			(SELECT SUM(totalAmount) FROM Owns INNER JOIN Product ON Owns.productId = Product.productId where Owns.personId=customerId) AS customerTotalRevenue
            FROM Product
            INNER JOIN Loan ON Product.productId = Loan.productId
			INNER JOIN Owns ON Owns.productId = Product.productId
			INNER JOIN Account ON Account.accountId = Owns.accountId
			INNER JOIN Person ON Person.personId = Owns.personId 
			INNER JOIN Interest ON Interest.interestId = Owns.interestId
			INNER JOIN Address ON Address.addressId = Person.addressId
			INNER JOIN AddressPostCode ON AddressPostCode.addressPCId = Address.addressPCId
			INNER JOIN AddressLocality ON AddressLocality.addressLocId = Address.addressLocId
			INNER JOIN AddressProvince ON AddressProvince.addressProvId = Address.addressProvId
			INNER JOIN AddressCountry ON AddressCountry.addressCountryId = Address.addressCountryId
            WHERE DATEDIFF(NOW(), Loan.timestamp) < 15 and Loan.cardId IS NOT NULL
            ";
  $resultDA = mysqli_query($conn, $queryDA) or die(mysqli_error());
  $resultSA = mysqli_query($conn, $querySA) or die(mysqli_error());
  $resultFA = mysqli_query($conn, $queryFA) or die(mysqli_error());
  $resultLoan = mysqli_query($conn, $queryLoan) or die(mysqli_error());
  $resultCardLoan = mysqli_query($conn, $queryCardLoan) or die(mysqli_error());
  
  //create a file pointer
  $f = fopen('transToHive.csv', 'w');
  
  while($row1 = mysqli_fetch_array($resultDA)) {
	
	$linedata = array($row1['productType'], $row1['productFirstCategory'], $row1['productSecondCategory'], 
	$row1['productTransactionalId'], $row1['productInvestment'], $row1['currency'], $row1['interestType'], 
	$row1['interest'], $row1['sellDate'], $row1['customerId'], $row1['customerBirthDate'], $row1['customerPostCode'], 
	$row1['customerCity'], $row1['customerRegion'], $row1['customerCountry'], $row1['customerSalary'], 
	$row1['customerGender'], $row1['customerProducts'] + $row1['customerAccounts'], $row1['customerTotalRevenue']);
	
	fputcsv($f, $linedata, ',');
  }
  
  while($row2 = mysqli_fetch_array($resultSA)) {
	
	$linedata = array($row2['productType'], $row2['productFirstCategory'], $row2['productSecondCategory'], 
	$row2['productTransactionalId'], $row2['productInvestment'], $row2['currency'], $row2['interestType'], 
	$row2['interest'], $row2['sellDate'], $row2['customerId'], $row2['customerBirthDate'], $row2['customerPostCode'], 
	$row2['customerCity'], $row2['customerRegion'], $row2['customerCountry'], $row2['customerSalary'], 
	$row2['customerGender'], $row2['customerProducts'] + $row2['customerAccounts'], $row2['customerTotalRevenue']);
	
	fputcsv($f, $linedata, ',');
	
  }
  
  while($row3 = mysqli_fetch_array($resultFA)) {
	
	$linedata = array($row3['productType'], $row3['productFirstCategory'], $row3['productSecondCategory'], 
	$row3['productTransactionalId'], $row3['productInvestment'], $row3['currency'], $row3['interestType'], 
	$row3['interest'], $row3['sellDate'], $row3['customerId'], $row3['customerBirthDate'], $row3['customerPostCode'], 
	$row3['customerCity'], $row3['customerRegion'], $row3['customerCountry'], $row3['customerSalary'], 
	$row3['customerGender'], $row3['customerProducts'] + $row3['customerAccounts'], $row3['customerTotalRevenue']);
	
	fputcsv($f, $linedata, ',');
	
  }
  
  while($row4 = mysqli_fetch_array($resultLoan)) {
	
	$linedata = array($row4['productType'], $row4['productFirstCategory'], $row4['productSecondCategory'], 
	$row4['productTransactionalId'], $row4['productInvestment'], $row4['currency'], $row4['interestType'], 
	$row4['interest'], $row4['sellDate'], $row4['customerId'], $row4['customerBirthDate'], $row4['customerPostCode'], 
	$row4['customerCity'], $row4['customerRegion'], $row4['customerCountry'], $row4['customerSalary'], 
	$row4['customerGender'], $row4['customerProducts'] + $row4['customerAccounts'], $row4['customerTotalRevenue']);
	
	fputcsv($f, $linedata, ',');
	
  }
  
  while($row5 = mysqli_fetch_array($resultCardLoan)) {
	
	$linedata = array($row5['productType'], $row5['productFirstCategory'], $row5['productSecondCategory'], 
	$row5['productTransactionalId'], $row5['productInvestment'], $row5['currency'], $row5['interestType'], 
	$row5['interest'], $row5['sellDate'], $row5['customerId'], $row5['customerBirthDate'], $row5['customerPostCode'], 
	$row5['customerCity'], $row5['customerRegion'], $row5['customerCountry'], $row5['customerSalary'], 
	$row5['customerGender'], $row5['customerProducts'] + $row5['customerAccounts'], $row5['customerTotalRevenue']);
	
	fputcsv($f, $linedata, ',');
	
  }
  
  echo "csv generated correctly";
  $conn->close();
  
  fclose($f);