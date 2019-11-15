CREATE TABLE `Account` (
  `accountId` int(6) NOT NULL AUTO_INCREMENT ,
  `accountNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `openDate` date NOT NULL,
  `amount` double(18,4) NOT NULL,
  `currency` enum('EUR','JPY','USD','GBP') COLLATE utf8_spanish_ci NOT NULL,
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
  PRIMARY KEY (`entryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AccountOperation` (
  `entryId` int(6) NOT NULL AUTO_INCREMENT ,
  `accountId` int(6) NOT NULL,
  PRIMARY KEY (`entryId`),
  FOREIGN KEY (`accountId`)
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Address` (
  `addressId` int(6) NOT NULL AUTO_INCREMENT ,
  `street` text COLLATE utf8_spanish_ci NOT NULL,
  `number` int(3) NOT NULL,
  `stairwell` text COLLATE utf8_spanish_ci NULL,
  `floor` int(3) NULL,
  `door` text COLLATE utf8_spanish_ci NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `AddressLocality` (
  `addressId` int(6) NOT NULL AUTO_INCREMENT ,
  `locality` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `AddressPostCode` (
  `addressId` int(6) NOT NULL AUTO_INCREMENT ,
  `postCode` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `AddressProvince` (
  `addressId` int(6) NOT NULL AUTO_INCREMENT,
  `province` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`addressId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `BussinesCard` (
  `bussinesCardId` int(6) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_spanish_ci NOT NULL,
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
  PRIMARY KEY (`cardId`),
  FOREIGN KEY (`bussinesCardId`)
    REFERENCES `BussinesCard`(`bussinesCardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `CardOperation` (
  `entryId` int(6) NOT NULL AUTO_INCREMENT ,
  `cardId` int(6) NOT NULL,
  PRIMARY KEY (`entryId`),
  FOREIGN KEY (`entryId`) 
    REFERENCES `AccountEntry`(`entryId`)
    ON DELETE CASCADE ON UPDATE CASCADE
  FOREIGN KEY (`cardId`) 
    REFERENCES `Card`(`cardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `Charge` (
  `chargeId` int(6) NOT NULL AUTO_INCREMENT ,
  `amount` double(18,4) NOT NULL,
  `confirmationDate` date NOT NULL,
  PRIMARY KEY (`chargeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `Credit` (
  `cardId` int(6) NOT NULL AUTO_INCREMENT ,
  `boundary` double(18,4) NOT NULL,
  PRIMARY KEY (`cardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPayment` (
  `creditPaymentId` int(6) NOT NULL AUTO_INCREMENT ,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `amount` double(18,4) NOT NULL,
  PRIMARY KEY (`creditPaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPaymentCard` (
  `creditPaymentId` int(6) NOT NULL AUTO_INCREMENT ,
  `cardId` int(6) NOT NULL,
  PRIMARY KEY (`creditPaymentId`),
  FOREIGN KEY (`cardId`)
    REFERENCES `Card`(`cardId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPaymentCharge` (
  `creditPaymentId` int(6) NOT NULL AUTO_INCREMENT ,
  `chargeId` int(6) NOT NULL,
  PRIMARY KEY (`creditPaymentId`),
  FOREIGN KEY (`chargeId`)
    REFERENCES `Charge`(`chargeId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Debit` (
  `cardId` int(6) NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`cardId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `DepositAccount` (
  `depositAccountId` int(6) NOT NULL AUTO_INCREMENT ,
  `accountId` int(6) NOT NULL,
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
  `gender` enum('mujer','hombre','otro') COLLATE utf8_spanish_ci NOT NULL,
  `phoneNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `identityNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `digitalSignature` int(6) NULL,
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
  `amountInvested` double(18,4) NOT NULL,
  `totalAmount` double(18,4) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `FinancialAsset` (
  `assetId` int(6) NOT NULL AUTO_INCREMENT ,
  `risk` int(11) NOT NULL CHECK (`risk` >= 1 AND `risk` <= 10),
  `type` enum('investmentFund','pensionFund','backDeposit','stockExchange') COLLATE utf8_spanish_ci NOT NULL,
  `productId` int(6) NOT NULL,
  PRIMARY KEY (`assetId`),
  FOREIGN KEY (`productId`)
    REFERENCES `Product`(`productId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Interest` (
  `interestId` int(6) NOT NULL AUTO_INCREMENT ,
  `isVariable` tinyint(1) NOT NULL,
  `interest` float(2,2) NOT NULL,
  PRIMARY KEY (`interestId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `IsAutorized` (
  `personId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL,
  PRIMARY KEY (`personId`,`accountId`),
  FOREIGN KEY (`accountId`) 
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`personId`) 
    REFERENCES `Person`(`personId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Loan` (
  `loadId` int(6) NOT NULL AUTO_INCREMENT ,
  `remainingAccount` double(18,4) NOT NULL,
  `cardId` int(6) NOT NULL,
  `productId` int(6) NOT NULL,
  PRIMARY KEY (`loadId`),
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




CREATE TABLE `SavingAccount` (
  `accountId` int(6) NOT NULL AUTO_INCREMENT ,
  `timeLimit` date NOT NULL,
  PRIMARY KEY (`accountId`),
  FOREIGN KEY (`accountId`) 
    REFERENCES `Account`(`accountId`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;