
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
  `ordererName` text COLLATE utf8_spanish_ci NULL,
  `office` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `AccountOperation` (
  `entryId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `Address` (
  `addressId` int(6) NOT NULL,
  `street` text COLLATE utf8_spanish_ci NOT NULL,
  `number` int(3) NOT NULL,
  `stairwell` text COLLATE utf8_spanish_ci NULL,
  `floor` int(3) NULL,
  `door` text COLLATE utf8_spanish_ci NULL
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



CREATE TABLE `BackDeposit` (
  `assetId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `BussinesCard` (
  `bussinesCardId` int(6) NOT NULL,
  `name` text COLLATE utf8_spanish_ci NOT NULL
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



CREATE TABLE `CardOperation` (
  `entryId` int(6) NOT NULL,
  `cardId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `Charge` (
  `chargeId` int(6) NOT NULL,
  `amount` double(18,4) NOT NULL,
  `confirmationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `Credit` (
  `cardId` int(6) NOT NULL,
  `boundary` double(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPayment` (
  `creditPaymentId` int(6) NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `amount` double(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPaymentCard` (
  `creditPaymentId` int(6) NOT NULL,
  `cardId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `CreditPaymentCharge` (
  `creditPaymentId` int(6) NOT NULL,
  `chargeId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Debit` (
  `cardId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `DepositAccount` (
  `depositAccountId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `FinancialAsset` (
  `assetId` int(6) NOT NULL,
     check(`assetId` >= 1 and `assetId` <= 10),
  `risk` int(11) NOT NULL,
  `type` enum('investmentFund','pensionFund','backDeposit','stockExchange') COLLATE utf8_spanish_ci NOT NULL,
  `productId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Interest` (
  `interestId` int(6) NOT NULL,
  `isVariable` tinyint(1) NOT NULL,
  `interest` float(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `InvestmentFund` (
  `assetId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `IsAutorized` (
  `personId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Loan` (
  `loadId` int(6) NOT NULL,
  `remainingAccount` double(18,4) NOT NULL,
  `cardId` int(6) NOT NULL,
  `productId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Owns` (
  `personId` int(6) NOT NULL,
  `productId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL,
  `interesId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `PensionFund` (
  `assetId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Person` (
  `personId` int(6) NOT NULL,
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
  `digitalSignature` int(6) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `Product` (
  `productId` int(6) NOT NULL,
  `releaseDate` date NOT NULL,
  `expireDate` date NOT NULL,
  `amountInvested` double(18,4) NOT NULL,
  `totalAmount` double(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `SavingAccount` (
  `accountId` int(6) NOT NULL,
  `timeLimit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `StockExchange` (
  `assetId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


ALTER TABLE `Account`
  ADD PRIMARY KEY (`accountId`),
  ADD UNIQUE KEY `accountNumber` (`accountNumber`) USING HASH;


ALTER TABLE `AccountEntry`
  ADD PRIMARY KEY (`entryId`),
  ADD UNIQUE KEY `ordererName` (`ordererName`) USING HASH;


ALTER TABLE `AccountOperation`
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

ALTER TABLE `BackDeposit`
  ADD PRIMARY KEY (`assetId`);

ALTER TABLE `BussinesCard`
  ADD PRIMARY KEY (`bussinesCardId`),
  ADD UNIQUE KEY `name` (`name`) USING HASH;

ALTER TABLE `Card`
  ADD PRIMARY KEY (`cardId`),
  ADD KEY `bussinesCardId` (`bussinesCardId`);

ALTER TABLE `CardOperation`
  ADD PRIMARY KEY (`entryId`),
  ADD KEY `accountrc_ibfk_2` (`cardId`);

ALTER TABLE `Charge`
  ADD PRIMARY KEY (`chargeId`);

ALTER TABLE `Credit`
  ADD PRIMARY KEY (`cardId`);




ALTER TABLE `CreditPayment`
  ADD PRIMARY KEY (`creditPaymentId`);




ALTER TABLE `CreditPaymentCard`
  ADD PRIMARY KEY (`creditPaymentId`),
  ADD KEY `cardId` (`cardId`);




ALTER TABLE `CreditPaymentCharge`
  ADD PRIMARY KEY (`creditPaymentId`),
  ADD KEY `chargeId` (`chargeId`);




ALTER TABLE `Debit`
  ADD PRIMARY KEY (`cardId`);




ALTER TABLE `DepositAccount`
  ADD PRIMARY KEY (`depositAccountId`),
  ADD KEY `accountId` (`accountId`);




ALTER TABLE `FinancialAsset`
  ADD PRIMARY KEY (`assetId`),
  ADD KEY `productId` (`productId`);




ALTER TABLE `Interest`
  ADD PRIMARY KEY (`interestId`);




ALTER TABLE `InvestmentFund`
  ADD PRIMARY KEY (`assetId`);




ALTER TABLE `IsAutorized`
  ADD PRIMARY KEY (`personId`,`accountId`),
  ADD KEY `accountId` (`accountId`);




ALTER TABLE `Loan`
  ADD PRIMARY KEY (`loadId`),
  ADD KEY `cardId` (`cardId`),
  ADD KEY `productId` (`productId`);




ALTER TABLE `Owns`
  ADD PRIMARY KEY (`personId`,`productId`,`accountId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `owns_ibfk_2` (`accountId`),
  ADD KEY `owns_ibfk_3` (`interesId`);




ALTER TABLE `PensionFund`
  ADD PRIMARY KEY (`assetId`);




ALTER TABLE `Person`
  ADD PRIMARY KEY (`personId`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`) USING HASH,
  ADD UNIQUE KEY `identityNumber` (`identityNumber`) USING HASH,
  ADD KEY `addressId` (`addressId`);




ALTER TABLE `Product`
  ADD PRIMARY KEY (`productId`);




ALTER TABLE `SavingAccount`
  ADD PRIMARY KEY (`accountId`);




ALTER TABLE `StockExchange`
  ADD PRIMARY KEY (`assetId`);








ALTER TABLE `AccountOperation`
  ADD CONSTRAINT `accountoperation_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accountoperation_ibfk_2` FOREIGN KEY (`entryId`) REFERENCES `AccountEntry` (`entryId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `AddressLocality`
  ADD CONSTRAINT `addresslocality_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `AddressPostCode`
  ADD CONSTRAINT `addresspostcode_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `AddressProvince`
  ADD CONSTRAINT `addressprovince_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `BackDeposit`
  ADD CONSTRAINT `backdeposit_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `FinancialAsset` (`assetId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `Card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`bussinesCardId`) REFERENCES `BussinesCard` (`bussinesCardId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `CardOperation`
  ADD CONSTRAINT `cardoperation_ibfk_1` FOREIGN KEY (`entryId`) REFERENCES `AccountEntry` (`entryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cardoperation_ibfk_2` FOREIGN KEY (`cardId`) REFERENCES `Card` (`cardId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `Credit`
  ADD CONSTRAINT `credit_ibfk_1` FOREIGN KEY (`cardId`) REFERENCES `Card` (`cardId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `CreditPaymentCard`
  ADD CONSTRAINT `creditpaymentcard_ibfk_1` FOREIGN KEY (`cardId`) REFERENCES `Card` (`cardId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `creditpaymentcard_ibfk_2` FOREIGN KEY (`creditPaymentId`) REFERENCES `CreditPayment` (`creditPaymentId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `CreditPaymentCharge`
  ADD CONSTRAINT `creditpaymentcharge_ibfk_1` FOREIGN KEY (`creditPaymentId`) REFERENCES `CreditPayment` (`creditPaymentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `creditpaymentcharge_ibfk_2` FOREIGN KEY (`chargeId`) REFERENCES `Charge` (`chargeId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `Debit`
  ADD CONSTRAINT `debit_ibfk_1` FOREIGN KEY (`cardId`) REFERENCES `Card` (`cardId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `DepositAccount`
  ADD CONSTRAINT `depositaccount_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `FinancialAsset`
  ADD CONSTRAINT `financialasset_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `InvestmentFund`
  ADD CONSTRAINT `investmentfund_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `FinancialAsset` (`assetId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `IsAutorized`
  ADD CONSTRAINT `isautorized_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `isautorized_ibfk_2` FOREIGN KEY (`personId`) REFERENCES `Person` (`personId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `Loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`cardId`) REFERENCES `Card` (`cardId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `Product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `Owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_3` FOREIGN KEY (`interesId`) REFERENCES `Interest` (`interestId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_4` FOREIGN KEY (`personId`) REFERENCES `Person` (`personId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `PensionFund`
  ADD CONSTRAINT `pensionfund_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `FinancialAsset` (`assetId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `Person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;




ALTER TABLE `StockExchange`
  ADD CONSTRAINT `stockexchange_ibfk_1` FOREIGN KEY (`assetId`) REFERENCES `FinancialAsset` (`assetId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
