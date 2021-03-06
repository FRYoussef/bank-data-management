CREATE TABLE `Account` (
  `accountId` int(6) NOT NULL AUTO_INCREMENT ,
  `accountNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `openDate` date NOT NULL,
  `amount` double(18,4) NOT NULL,
  `currency` enum('EUR','JPY','USD','GBP') COLLATE utf8_spanish_ci NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`accountId`),
  UNIQUE KEY `accountNumber` (`accountNumber`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AccountEntry` (
  `entryId` int(6) NOT NULL AUTO_INCREMENT ,
  `type` enum('withdraw','deposit','transferIn','transferOut','creditCharge','debitCharge') COLLATE utf8_spanish_ci NOT NULL,
  `amount` double(18,4) NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `ordererName` text COLLATE utf8_spanish_ci NULL,
  `office` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`entryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AccountOperation` (
  `entryId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`entryId`),
  FOREIGN KEY (`entryId`)
    REFERENCES `AccountEntry`(`entryId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`accountId`)
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `AddressLocality` (
  `addressLocId` int(6) NOT NULL AUTO_INCREMENT ,
  `locality` text COLLATE utf8_spanish_ci NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`addressLocId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `AddressPostCode` (
  `addressPCId` int(6) NOT NULL AUTO_INCREMENT ,
  `postCode` text COLLATE utf8_spanish_ci NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`addressPCId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `AddressProvince` (
  `addressProvId` int(6) NOT NULL AUTO_INCREMENT,
  `province` text COLLATE utf8_spanish_ci NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`addressProvId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AddressCountry` (
  `addressCountryId` int(6) NOT NULL AUTO_INCREMENT,
  `country` text COLLATE utf8_spanish_ci NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`addressCountryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Address` (
  `addressId` int(6) NOT NULL AUTO_INCREMENT ,
  `street` text COLLATE utf8_spanish_ci NOT NULL,
  `number` int(3) NOT NULL,
  `stairwell` text COLLATE utf8_spanish_ci NULL,
  `floor` int(3) NULL,
  `door` text COLLATE utf8_spanish_ci NULL,
  `addressProvId` int(6) NOT NULL,
  `addressPCId` int(6) NOT NULL,
  `addressLocId` int(6) NOT NULL,
  `addressCountryId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`addressId`),
  FOREIGN KEY (`addressProvId`) 
    REFERENCES `AddressProvince`(`addressProvId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`addressLocId`) 
    REFERENCES `AddressLocality`(`addressLocId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`addressPCId`) 
    REFERENCES `AddressPostCode`(`addressPCId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`addressCountryId`) 
    REFERENCES `AddressCountry`(`addressCountryId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `BussinesCard` (
  `bussinesCardId` int(6) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`bussinesCardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `Card` (
  `cardId` int(6) NOT NULL AUTO_INCREMENT ,
  `cardNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `releaseDate` date NOT NULL,
  `expireDate` date NOT NULL,
  `verificationValue` int(3) NOT NULL,
  `pin` int(4) NOT NULL,
  `bussinesCardId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`cardId`),
  FOREIGN KEY (`bussinesCardId`)
    REFERENCES `BussinesCard`(`bussinesCardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `CardOperation` (
  `entryId` int(6) NOT NULL AUTO_INCREMENT ,
  `cardId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`entryId`),
  FOREIGN KEY (`entryId`) 
    REFERENCES `AccountEntry`(`entryId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`cardId`) 
    REFERENCES `Card`(`cardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `Charge` (
  `chargeId` int(6) NOT NULL AUTO_INCREMENT ,
  `amount` double(18,4) NOT NULL,
  `confirmationDate` date NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`chargeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `Credit` (
  `cardId` int(6) NOT NULL,
  `boundary` double(18,4) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`cardId`),
  FOREIGN KEY (`cardId`) REFERENCES `Card`(`cardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPayment` (
  `creditPaymentId` int(6) NOT NULL AUTO_INCREMENT ,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `amount` double(18,4) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`creditPaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPaymentCard` (
  `creditPaymentId` int(6) NOT NULL AUTO_INCREMENT ,
  `cardId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`creditPaymentId`),
  FOREIGN KEY (`creditPaymentId`)
    REFERENCES `CreditPayment`(`creditPaymentId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`cardId`)
    REFERENCES `Card`(`cardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPaymentCharge` (
  `creditPaymentId` int(6) NOT NULL AUTO_INCREMENT ,
  `chargeId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`creditPaymentId`),
  FOREIGN KEY (`chargeId`)
    REFERENCES `Charge`(`chargeId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Debit` (
  `cardId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`cardId`),
  FOREIGN KEY (`cardId`) REFERENCES `Card`(`cardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `DepositAccount` (
  `depositAccountId` int(6) NOT NULL AUTO_INCREMENT ,
  `accountId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`depositAccountId`),
  FOREIGN KEY (`accountId`)
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Person` (
  `personId` int(6) NOT NULL AUTO_INCREMENT ,
  `firstName` text COLLATE utf8_spanish_ci NOT NULL,
  `lastName` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NULL,
  `addressId` int(6) NOT NULL,
  `nationality` text COLLATE utf8_spanish_ci NOT NULL,
  `salary` double(10,2) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `gender` enum('female','male') COLLATE utf8_spanish_ci NOT NULL,
  `phoneNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `identityNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `digitalSignature` int(6) NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`personId`),
  UNIQUE `email` (`email`) USING HASH,
  UNIQUE `phoneNumber` (`phoneNumber`) USING HASH,
  UNIQUE `identityNumber` (`identityNumber`) USING HASH,
  FOREIGN KEY (`addressId`)
    REFERENCES `Address`(`addressId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Product` (
  `productId` int(6) NOT NULL AUTO_INCREMENT ,
  `releaseDate` date NOT NULL,
  `expireDate` date NOT NULL,
  `totalAmount` double(18,4) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `FinancialAsset` (
  `assetId` int(6) NOT NULL AUTO_INCREMENT ,
  `risk` int(11) NOT NULL CHECK (`risk` >= 1 AND `risk` <= 10),
  `type` enum('investmentFund','pensionFund','bankDeposit','stockExchange') COLLATE utf8_spanish_ci NOT NULL,
  `productId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`assetId`),
  FOREIGN KEY (`productId`)
    REFERENCES `Product`(`productId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Interest` (
  `interestId` int(6) NOT NULL AUTO_INCREMENT ,
  `isVariable` tinyint(1) NOT NULL,
  `interest` float(2,2) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`interestId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `IsAutorized` (
  `personId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`personId`,`accountId`),
  FOREIGN KEY (`accountId`) 
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`personId`) 
    REFERENCES `Person`(`personId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Loan` (
  `loanId` int(6) NOT NULL AUTO_INCREMENT ,
  `remainingAccount` double(18,4) NOT NULL,
  `cardId` int(6) NULL,
  `productId` int(6) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`loanId`),
  FOREIGN KEY (`cardId`)
    REFERENCES `Card`(`cardId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`productId`) 
    REFERENCES `Product`(`productId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Owns` (
  `personId` int(6) NOT NULL ,
  `productId` int(6) NOT NULL ,
  `accountId` int(6) NOT NULL ,
  `interestId` int(6) NOT NULL ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`personId`,`productId`,`accountId`),
  FOREIGN KEY (`personId`) 
    REFERENCES `Person`(`personId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`productId`)
    REFERENCES `Product`(`productId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`accountId`) 
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`interestId`)
    REFERENCES `Interest`(`interestId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




CREATE TABLE `SavingsAccount` (
  `accountId` int(6) NOT NULL AUTO_INCREMENT ,
  `timeLimit` date NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`accountId`),
  FOREIGN KEY (`accountId`) 
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;