SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `Account` (
  `accountId` int(6) NOT NULL,
  `accountNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `openDate` date NOT NULL,
  `amount` double(18,4) NOT NULL,
  `currency` enum('EUR','JPY','USD','GBP') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AccountEntry` (
  `entryId` int(6) NOT NULL,
  `type` enum('withdraw','deposit','transferIn','transferOut','creditCharge','debitCharge') COLLATE utf8_spanish_ci NOT NULL,
  `amount` double(18,4) NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `ordererName` text COLLATE utf8_spanish_ci NOT NULL,
  `office` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AccountRC` (
  `entryId` int(6) NOT NULL,
  `cardId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AccountRE` (
  `entryId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Address` (
  `addressId` int(6) NOT NULL,
  `street` text COLLATE utf8_spanish_ci NOT NULL,
  `premise` text COLLATE utf8_spanish_ci NOT NULL,
  `stairwell` text COLLATE utf8_spanish_ci NOT NULL,
  `floor` int(3) NOT NULL,
  `door` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AddressLocality` (
  `addressId` int(6) NOT NULL,
  `locality` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AddressPostCode` (
  `addressId` int(6) NOT NULL,
  `postCode` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AddressProvince` (
  `addressId` int(6) NOT NULL,
  `province` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Card` (
  `cardId` int(6) NOT NULL,
  `cardNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `releaseDate` date NOT NULL,
  `expireDate` date NOT NULL,
  `verificationValue` int(3) NOT NULL,
  `pin` int(4) NOT NULL,
  `bussinesCardId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `DepositAccount` (
  `depositAccountId` int(6) NOT NULL,
  `savingAccount` text COLLATE utf8_spanish_ci NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Interest` (
  `interestId` int(2) NOT NULL,
  `isVariable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `IsAutorized` (
  `personId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Owns` (
  `personId` int(6) NOT NULL,
  `productId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL,
  `interesId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Person` (
  `personId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Product` (
  `productId` int(6) NOT NULL,
  `releaseDate` date NOT NULL,
  `expireDate` date NOT NULL,
  `totalAmount` double(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


ALTER TABLE `Account`
  ADD PRIMARY KEY (`accountId`),
  ADD UNIQUE KEY `accountNumber` (`accountNumber`) USING HASH;

ALTER TABLE `AccountEntry`
  ADD PRIMARY KEY (`entryId`),
  ADD UNIQUE KEY `ordererName` (`ordererName`) USING HASH;

ALTER TABLE `AccountRC`
  ADD PRIMARY KEY (`entryId`);

ALTER TABLE `AccountRE`
  ADD PRIMARY KEY (`entryId`),
  ADD KEY `accountId` (`accountId`);

ALTER TABLE `Address`
  ADD PRIMARY KEY (`addressId`);

ALTER TABLE `AddressLocality`
  ADD PRIMARY KEY (`addressId`);

ALTER TABLE `AddressPostCode`
  ADD PRIMARY KEY (`addressId`);

ALTER TABLE `AddressProvince`
  ADD PRIMARY KEY (`addressId`);

ALTER TABLE `Card`
  ADD PRIMARY KEY (`cardId`);

ALTER TABLE `DepositAccount`
  ADD PRIMARY KEY (`depositAccountId`),
  ADD UNIQUE KEY `savingAccount` (`savingAccount`) USING HASH,
  ADD KEY `accountId` (`accountId`);

ALTER TABLE `Interest`
  ADD PRIMARY KEY (`interestId`);

ALTER TABLE `IsAutorized`
  ADD PRIMARY KEY (`personId`,`accountId`),
  ADD KEY `accountId` (`accountId`);

ALTER TABLE `Owns`
  ADD PRIMARY KEY (`personId`,`productId`,`accountId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `owns_ibfk_2` (`accountId`),
  ADD KEY `owns_ibfk_3` (`interesId`);

ALTER TABLE `Person`
  ADD PRIMARY KEY (`personId`);

ALTER TABLE `Product`
  ADD PRIMARY KEY (`productId`);


ALTER TABLE `AccountRC`
  ADD CONSTRAINT `accountrc_ibfk_1` FOREIGN KEY (`entryId`) REFERENCES `AccountEntry` (`entryId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `AccountRE`
  ADD CONSTRAINT `accountre_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accountre_ibfk_2` FOREIGN KEY (`entryId`) REFERENCES `AccountEntry` (`entryId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `AddressLocality`
  ADD CONSTRAINT `addresslocality_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `AddressPostCode`
  ADD CONSTRAINT `addresspostcode_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `AddressProvince`
  ADD CONSTRAINT `addressprovince_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `DepositAccount`
  ADD CONSTRAINT `depositaccount_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `IsAutorized`
  ADD CONSTRAINT `isautorized_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isautorized_ibfk_2` FOREIGN KEY (`personId`) REFERENCES `Person` (`personId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_3` FOREIGN KEY (`interesId`) REFERENCES `Interest` (`interestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_4` FOREIGN KEY (`personId`) REFERENCES `Person` (`personId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
