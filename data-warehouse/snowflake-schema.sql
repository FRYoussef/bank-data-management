








SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;











CREATE TABLE `dimcity` (
  `idCity` int(6) NOT NULL,
  `city` text NOT NULL,
  `idRegion` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimcountry` (
  `idCountry` int(6) NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimcustomer` (
  `idCustomer` int(6) NOT NULL,
  `idBirthDate` int(6) NOT NULL,
  `idLocation` int(6) NOT NULL,
  `idSalary` int(6) NOT NULL,
  `idGender` int(6) NOT NULL,
  `customerType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimday` (
  `idDay` int(6) NOT NULL,
  `day` int(2) NOT NULL,
  `idMonth` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimgender` (
  `idGender` int(6) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimmonth` (
  `idMonth` int(6) NOT NULL,
  `month` int(2) NOT NULL,
  `idYear` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimpost` (
  `idLocation` int(6) NOT NULL,
  `postcode` int(5) NOT NULL,
  `idCity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimproduct` (
  `idProduct` int(11) NOT NULL,
  `product` enum('depositAccount','savingsAccount','loan','investmentFund','bankDeposit','pensionFund','stockExchange') NOT NULL,
  `investment` double(6,2) NOT NULL,
  `idProductType` int(6) NOT NULL,
  `currency` enum('Dolar','Euro','Yen','Libra','Franco') NOT NULL,
  `type` enum('fix','variable') NOT NULL,
  `interest` double(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimproducttype` (
  `idType` int(6) NOT NULL,
  `type` enum('product','account','loan','creditCardLoan','financialAsset') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimregion` (
  `idRegion` int(6) NOT NULL,
  `region` text NOT NULL,
  `idCountry` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimsalary` (
  `idSalary` int(6) NOT NULL,
  `salary` double(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `dimyear` (
  `idYear` int(6) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE `factsells` (
  `idProduct` int(6) NOT NULL,
  `idSellDate` int(6) NOT NULL,
  `idCustomer` int(6) NOT NULL,
  `unitsSold` int(6) NOT NULL,
  `revenue` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;








ALTER TABLE `dimcity`
  ADD PRIMARY KEY (`idCity`),
  ADD KEY `fk_idRegion` (`idRegion`);




ALTER TABLE `dimcountry`
  ADD PRIMARY KEY (`idCountry`);




ALTER TABLE `dimcustomer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD KEY `fk_idBirthDate` (`idBirthDate`),
  ADD KEY `fk_idLocation` (`idLocation`),
  ADD KEY `fk_idSalary` (`idSalary`),
  ADD KEY `fk_idGender` (`idGender`);




ALTER TABLE `dimday`
  ADD PRIMARY KEY (`idDay`),
  ADD KEY `fk_idMonth` (`idMonth`);




ALTER TABLE `dimgender`
  ADD PRIMARY KEY (`idGender`);




ALTER TABLE `dimmonth`
  ADD PRIMARY KEY (`idMonth`),
  ADD KEY `fk_idYear` (`idYear`);




ALTER TABLE `dimpost`
  ADD PRIMARY KEY (`idLocation`),
  ADD KEY `fk_idCity` (`idCity`);




ALTER TABLE `dimproduct`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `fk_idProductType` (`idProductType`);




ALTER TABLE `dimproducttype`
  ADD PRIMARY KEY (`idType`);




ALTER TABLE `dimregion`
  ADD PRIMARY KEY (`idRegion`),
  ADD KEY `fk_idCountry` (`idCountry`);




ALTER TABLE `dimsalary`
  ADD PRIMARY KEY (`idSalary`);




ALTER TABLE `dimyear`
  ADD PRIMARY KEY (`idYear`);




ALTER TABLE `factsells`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `fk_idSellDate` (`idSellDate`),
  ADD KEY `fk_idCustomer` (`idCustomer`);








ALTER TABLE `dimcity`
  MODIFY `idCity` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimcountry`
  MODIFY `idCountry` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimcustomer`
  MODIFY `idCustomer` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimday`
  MODIFY `idDay` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimgender`
  MODIFY `idGender` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimmonth`
  MODIFY `idMonth` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimpost`
  MODIFY `idLocation` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimproduct`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimproducttype`
  MODIFY `idType` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimregion`
  MODIFY `idRegion` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimsalary`
  MODIFY `idSalary` int(6) NOT NULL AUTO_INCREMENT;




ALTER TABLE `dimyear`
  MODIFY `idYear` int(6) NOT NULL AUTO_INCREMENT;








ALTER TABLE `dimcity`
  ADD CONSTRAINT `fk_idRegion` FOREIGN KEY (`idRegion`) REFERENCES `dimregion` (`idRegion`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `dimcustomer`
  ADD CONSTRAINT `fk_dimPost` FOREIGN KEY (`idLocation`) REFERENCES `dimpost` (`idLocation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idBirthDate` FOREIGN KEY (`idBirthDate`) REFERENCES `dimday` (`idDay`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idGender` FOREIGN KEY (`idGender`) REFERENCES `dimgender` (`idGender`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idLocation` FOREIGN KEY (`idLocation`) REFERENCES `dimpost` (`idLocation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idSalary` FOREIGN KEY (`idSalary`) REFERENCES `dimsalary` (`idSalary`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `dimday`
  ADD CONSTRAINT `fk_idMonth` FOREIGN KEY (`idMonth`) REFERENCES `dimmonth` (`idMonth`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `dimmonth`
  ADD CONSTRAINT `fk_idYear` FOREIGN KEY (`idYear`) REFERENCES `dimyear` (`idYear`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `dimpost`
  ADD CONSTRAINT `fk_idCity` FOREIGN KEY (`idCity`) REFERENCES `dimcity` (`idCity`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `dimproduct`
  ADD CONSTRAINT `fk_idProductType` FOREIGN KEY (`idProductType`) REFERENCES `dimproducttype` (`idType`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `dimregion`
  ADD CONSTRAINT `fk_idCountry` FOREIGN KEY (`idCountry`) REFERENCES `dimcountry` (`idCountry`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `factsells`
  ADD CONSTRAINT `fk_idCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `dimcustomer` (`idCustomer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProduct` FOREIGN KEY (`idProduct`) REFERENCES `dimproduct` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idSellDate` FOREIGN KEY (`idSellDate`) REFERENCES `dimday` (`idDay`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
