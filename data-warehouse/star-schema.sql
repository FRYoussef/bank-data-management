








SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";












CREATE TABLE `dimcustomerlocation` (
  `idLocation` int(6) NOT NULL  AUTO_INCREMENT ,
  `postcode` text(20) NOT NULL,
  `city` text NOT NULL,
  `region` text(20) NOT NULL,
  `country` text(20) NOT NULL,
  PRIMARY KEY (`idLocation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimdate` (
  `idDate` int(6) NOT NULL  AUTO_INCREMENT ,
  `day` int(2) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  PRIMARY KEY (`idDate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimproduct` (
  `idProduct` int(6) NOT NULL,
  `transactionalId` int(6) NOT NULL,
  `product` enum('depositAccount','savingsAccount','loan','investmentFund','bankDeposit','pensionFund','stockExchange') NOT NULL,
  `investment` double(18,4) NOT NULL,
  `currency` enum('EUR','JPY','USD','GBP') NOT NULL,
  `interestType` enum('fix','variable') NOT NULL,
  `interest` double(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimFirstProductType` (
  `idType` int(6) NOT NULL  AUTO_INCREMENT,
  `type` enum('product','account','loan','creditCardLoan','financialAsset', 'debitCard') NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `dimSecondProductType` (
  `idType` int(6) NOT NULL  AUTO_INCREMENT,
  `type` enum('RequiredProduct','OptionalProduct') NOT NULL,
  PRIMARY KEY (`idType`)
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












ALTER TABLE `dimproduct`
  ADD PRIMARY KEY (`idProduct`);



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