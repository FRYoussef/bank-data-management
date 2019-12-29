








SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;











CREATE TABLE `dimcustomerlocation` (
  `idLocation` int(6) NOT NULL,
  `postcode` int(5) NOT NULL,
  `city` text NOT NULL,
  `region` int(20) NOT NULL,
  `country` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimdate` (
  `idDate` int(6) NOT NULL,
  `day` int(2) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimproduct` (
  `idProduct` int(6) NOT NULL,
  `product` enum('depositAccount','savingsAccount','loan','investmentFund','bankDeposit','pensionFund','stockExchange') NOT NULL,
  `investment` double(6,2) NOT NULL,
  `currency` enum('Dolar','Euro','Yen','Libra','Franco') NOT NULL,
  `interestType` enum('fix','variable') NOT NULL,
  `interest` double(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimFirstProductType` (
  `idType` int(6) NOT NULL,
  `type` enum('product','account','loan''creditCardLoan','financialAsset', 'debitCard') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `dimSecondProductType` (
  `idType` int(6) NOT NULL,
  `type` enum('RequiredProduct','OptionalProduct') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `factsells` (
  `idProduct` int(6) NOT NULL,
  `idFirstProductType` int(6) NOT NULL,
  `idSecondProductType` int(6) NOT NULL,
  `idSellDate` int(6) NOT NULL,
  `idCustomerBirthDate` int(6) NOT NULL,
  `idCustomerLocation` int(6) NOT NULL,
  `salary` double(6,2) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `idCustomer` int(6) NOT NULL,
  `unitsSold` int(6) NOT NULL,
  `revenue` double(10,2) NOT NULL,
  `customerType` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;








ALTER TABLE `dimcustomerlocation`
  ADD PRIMARY KEY (`idLocation`);




ALTER TABLE `dimdate`
  ADD PRIMARY KEY (`idDate`);




ALTER TABLE `dimproduct`
  ADD PRIMARY KEY (`idProduct`);




ALTER TABLE `dimFirstProductType`
  ADD PRIMARY KEY (`idType`);


ALTER TABLE `dimSecondProductType`
  ADD PRIMARY KEY (`idType`);



ALTER TABLE `factsells`
  ADD KEY `fk_idProduct` (`idProduct`),
  ADD KEY `fk_idFirstProductType` (`idFirstProductType`),
  ADD KEY `fk_idSecondProductType` (`idSecondProductType`),
  ADD KEY `fk_idSellDate` (`idSellDate`),
  ADD KEY `fk_idCustomerBirthDate` (`idCustomerBirthDate`),
  ADD KEY `fk_idCustomerLocation` (`idCustomerLocation`);








ALTER TABLE `dimcustomerlocation`
  MODIFY `idLocation` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimdate`
  MODIFY `idDate` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimproduct`
  MODIFY `idProduct` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimFirstProductType`
  MODIFY `idType` int(6) NOT NULL AUTO_INCREMENT;


ALTER TABLE `dimSecondProductType`
  MODIFY `idType` int(6) NOT NULL AUTO_INCREMENT;






ALTER TABLE `factsells`
  ADD CONSTRAINT `fk_idCustomerBirthDate` FOREIGN KEY (`idCustomerBirthDate`) REFERENCES `dimdate` (`idDate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idCustomerLocation` FOREIGN KEY (`idCustomerLocation`) REFERENCES `dimcustomerlocation` (`idLocation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProduct` FOREIGN KEY (`idProduct`) REFERENCES `dimproduct` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idFirstProductType` FOREIGN KEY (`idFirstProductType`) REFERENCES `dimFirstProductType` (`idType`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idSecondProductType` FOREIGN KEY (`idSecondProductType`) REFERENCES `dimSecondProductType` (`idType`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idSellDate` FOREIGN KEY (`idSellDate`) REFERENCES `dimdate` (`idDate`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;