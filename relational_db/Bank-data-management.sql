-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-11-2019 a las 01:09:28
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Bank-data-management`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Account`
--

CREATE TABLE `Account` (
  `accountId` int(6) NOT NULL,
  `accountNumber` text COLLATE utf8_spanish_ci NOT NULL,
  `openDate` date NOT NULL,
  `amount` double(18,4) NOT NULL,
  `currency` enum('EUR','JPY','USD','GBP') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Address`
--

CREATE TABLE `Address` (
  `addressId` int(6) NOT NULL,
  `street` text COLLATE utf8_spanish_ci NOT NULL,
  `premise` text COLLATE utf8_spanish_ci NOT NULL,
  `stairwell` text COLLATE utf8_spanish_ci NOT NULL,
  `floor` int(3) NOT NULL,
  `door` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AddressLocality`
--

CREATE TABLE `AddressLocality` (
  `addressId` int(6) NOT NULL,
  `locality` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AddressPostCode`
--

CREATE TABLE `AddressPostCode` (
  `addressId` int(6) NOT NULL,
  `postCode` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AddressProvince`
--

CREATE TABLE `AddressProvince` (
  `addressId` int(6) NOT NULL,
  `province` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DepositAccount`
--

CREATE TABLE `DepositAccount` (
  `depositAccountId` int(6) NOT NULL,
  `savingAccount` text COLLATE utf8_spanish_ci NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Interest`
--

CREATE TABLE `Interest` (
  `interestId` int(2) NOT NULL,
  `isVariable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IsAutorized`
--

CREATE TABLE `IsAutorized` (
  `personId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Owns`
--

CREATE TABLE `Owns` (
  `costumerId` int(6) NOT NULL,
  `productId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL,
  `interesId` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Product`
--

CREATE TABLE `Product` (
  `productId` int(6) NOT NULL,
  `releaseDate` date NOT NULL,
  `expireDate` date NOT NULL,
  `totalAmount` double(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`accountId`),
  ADD UNIQUE KEY `accountNumber` (`accountNumber`) USING HASH;

--
-- Indices de la tabla `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`addressId`);

--
-- Indices de la tabla `AddressLocality`
--
ALTER TABLE `AddressLocality`
  ADD PRIMARY KEY (`addressId`);

--
-- Indices de la tabla `AddressPostCode`
--
ALTER TABLE `AddressPostCode`
  ADD PRIMARY KEY (`addressId`);

--
-- Indices de la tabla `AddressProvince`
--
ALTER TABLE `AddressProvince`
  ADD PRIMARY KEY (`addressId`);

--
-- Indices de la tabla `DepositAccount`
--
ALTER TABLE `DepositAccount`
  ADD PRIMARY KEY (`depositAccountId`),
  ADD UNIQUE KEY `savingAccount` (`savingAccount`) USING HASH,
  ADD KEY `accountId` (`accountId`);

--
-- Indices de la tabla `Interest`
--
ALTER TABLE `Interest`
  ADD PRIMARY KEY (`interestId`);

--
-- Indices de la tabla `IsAutorized`
--
ALTER TABLE `IsAutorized`
  ADD PRIMARY KEY (`personId`,`accountId`),
  ADD KEY `accountId` (`accountId`);

--
-- Indices de la tabla `Owns`
--
ALTER TABLE `Owns`
  ADD PRIMARY KEY (`costumerId`,`productId`,`accountId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `owns_ibfk_2` (`accountId`),
  ADD KEY `owns_ibfk_3` (`interesId`);

--
-- Indices de la tabla `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`productId`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `AddressLocality`
--
ALTER TABLE `AddressLocality`
  ADD CONSTRAINT `addresslocality_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `AddressPostCode`
--
ALTER TABLE `AddressPostCode`
  ADD CONSTRAINT `addresspostcode_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `AddressProvince`
--
ALTER TABLE `AddressProvince`
  ADD CONSTRAINT `addressprovince_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `Address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `DepositAccount`
--
ALTER TABLE `DepositAccount`
  ADD CONSTRAINT `depositaccount_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `IsAutorized`
--
ALTER TABLE `IsAutorized`
  ADD CONSTRAINT `isautorized_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Owns`
--
ALTER TABLE `Owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`accountId`) REFERENCES `Account` (`accountId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_3` FOREIGN KEY (`interesId`) REFERENCES `Interest` (`interestId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
