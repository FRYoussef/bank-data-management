-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2020 a las 16:45:10
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `snowflake`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimcity`
--

CREATE TABLE `dimcity` (
  `idCity` int(6) NOT NULL,
  `city` text NOT NULL,
  `idRegion` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimcountry`
--

CREATE TABLE `dimcountry` (
  `idCountry` int(6) NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimcustomer`
--

CREATE TABLE `dimcustomer` (
  `idCustomer` int(6) NOT NULL,
  `idBirthDate` int(6) NOT NULL,
  `idLocation` int(6) NOT NULL,
  `idSalary` int(6) NOT NULL,
  `idGender` int(6) NOT NULL,
  `customerType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimday`
--

CREATE TABLE `dimday` (
  `idDay` int(6) NOT NULL,
  `day` int(2) NOT NULL,
  `idMonth` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimfirstproducttype`
--

CREATE TABLE `dimfirstproducttype` (
  `idType` int(6) NOT NULL,
  `idSecondType` int(6) NOT NULL,
  `type` enum('account','loan','creditCardLoan','financialAsset') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimgender`
--

CREATE TABLE `dimgender` (
  `idGender` int(6) NOT NULL,
  `gender` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimmonth`
--

CREATE TABLE `dimmonth` (
  `idMonth` int(6) NOT NULL,
  `month` int(2) NOT NULL,
  `idYear` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimpost`
--

CREATE TABLE `dimpost` (
  `idLocation` int(6) NOT NULL,
  `postcode` int(5) NOT NULL,
  `idCity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimproduct`
--

CREATE TABLE `dimproduct` (
  `idProduct` int(6) NOT NULL,
  `transactionalId` int(6) NOT NULL,
  `product` enum('depositAccount','savingsAccount','loan','investmentFund','bankDeposit','pensionFund','stockExchange') NOT NULL,
  `investment` double(6,2) NOT NULL,
  `idProductType` int(6) NOT NULL,
  `currency` enum('Dolar','Euro','Yen','Libra','Franco') NOT NULL,
  `type` enum('fix','variable') NOT NULL,
  `interest` double(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimregion`
--

CREATE TABLE `dimregion` (
  `idRegion` int(6) NOT NULL,
  `region` text NOT NULL,
  `idCountry` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimsalary`
--

CREATE TABLE `dimsalary` (
  `idSalary` int(6) NOT NULL,
  `salary` double(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimsecondproducttype`
--

CREATE TABLE `dimsecondproducttype` (
  `idType` int(11) NOT NULL,
  `type` enum('RequiredProduct','OptionalProduct') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimyear`
--

CREATE TABLE `dimyear` (
  `idYear` int(6) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factsells`
--

CREATE TABLE `factsells` (
  `idProduct` int(6) NOT NULL,
  `idSellDate` int(6) NOT NULL,
  `idCustomer` int(6) NOT NULL,
  `unitsSold` int(6) NOT NULL,
  `revenue` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dimcity`
--
ALTER TABLE `dimcity`
  ADD PRIMARY KEY (`idCity`),
  ADD KEY `fk_idRegion` (`idRegion`);

--
-- Indices de la tabla `dimcountry`
--
ALTER TABLE `dimcountry`
  ADD PRIMARY KEY (`idCountry`);

--
-- Indices de la tabla `dimcustomer`
--
ALTER TABLE `dimcustomer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD KEY `fk_idBirthDate` (`idBirthDate`),
  ADD KEY `fk_idLocation` (`idLocation`),
  ADD KEY `fk_idSalary` (`idSalary`),
  ADD KEY `fk_idGender` (`idGender`);

--
-- Indices de la tabla `dimday`
--
ALTER TABLE `dimday`
  ADD PRIMARY KEY (`idDay`),
  ADD KEY `fk_idMonth` (`idMonth`);

--
-- Indices de la tabla `dimfirstproducttype`
--
ALTER TABLE `dimfirstproducttype`
  ADD PRIMARY KEY (`idType`),
  ADD KEY `fk_idSecondType` (`idSecondType`);

--
-- Indices de la tabla `dimgender`
--
ALTER TABLE `dimgender`
  ADD PRIMARY KEY (`idGender`);

--
-- Indices de la tabla `dimmonth`
--
ALTER TABLE `dimmonth`
  ADD PRIMARY KEY (`idMonth`),
  ADD KEY `fk_idYear` (`idYear`);

--
-- Indices de la tabla `dimpost`
--
ALTER TABLE `dimpost`
  ADD PRIMARY KEY (`idLocation`),
  ADD KEY `fk_idCity` (`idCity`);

--
-- Indices de la tabla `dimproduct`
--
ALTER TABLE `dimproduct`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `fk_idProductType` (`idProductType`);

--
-- Indices de la tabla `dimregion`
--
ALTER TABLE `dimregion`
  ADD PRIMARY KEY (`idRegion`),
  ADD KEY `fk_idCountry` (`idCountry`);

--
-- Indices de la tabla `dimsalary`
--
ALTER TABLE `dimsalary`
  ADD PRIMARY KEY (`idSalary`);

--
-- Indices de la tabla `dimsecondproducttype`
--
ALTER TABLE `dimsecondproducttype`
  ADD PRIMARY KEY (`idType`);

--
-- Indices de la tabla `dimyear`
--
ALTER TABLE `dimyear`
  ADD PRIMARY KEY (`idYear`);

--
-- Indices de la tabla `factsells`
--
ALTER TABLE `factsells`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `fk_idSellDate` (`idSellDate`),
  ADD KEY `fk_idCustomer` (`idCustomer`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dimcity`
--
ALTER TABLE `dimcity`
  MODIFY `idCity` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimcountry`
--
ALTER TABLE `dimcountry`
  MODIFY `idCountry` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimcustomer`
--
ALTER TABLE `dimcustomer`
  MODIFY `idCustomer` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimday`
--
ALTER TABLE `dimday`
  MODIFY `idDay` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimfirstproducttype`
--
ALTER TABLE `dimfirstproducttype`
  MODIFY `idType` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimgender`
--
ALTER TABLE `dimgender`
  MODIFY `idGender` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimmonth`
--
ALTER TABLE `dimmonth`
  MODIFY `idMonth` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimpost`
--
ALTER TABLE `dimpost`
  MODIFY `idLocation` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimproduct`
--
ALTER TABLE `dimproduct`
  MODIFY `idProduct` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimregion`
--
ALTER TABLE `dimregion`
  MODIFY `idRegion` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimsalary`
--
ALTER TABLE `dimsalary`
  MODIFY `idSalary` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimsecondproducttype`
--
ALTER TABLE `dimsecondproducttype`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dimyear`
--
ALTER TABLE `dimyear`
  MODIFY `idYear` int(6) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dimcity`
--
ALTER TABLE `dimcity`
  ADD CONSTRAINT `fk_idRegion` FOREIGN KEY (`idRegion`) REFERENCES `dimregion` (`idRegion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimcustomer`
--
ALTER TABLE `dimcustomer`
  ADD CONSTRAINT `fk_dimPost` FOREIGN KEY (`idLocation`) REFERENCES `dimpost` (`idLocation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idBirthDate` FOREIGN KEY (`idBirthDate`) REFERENCES `dimday` (`idDay`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idGender` FOREIGN KEY (`idGender`) REFERENCES `dimgender` (`idGender`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idLocation` FOREIGN KEY (`idLocation`) REFERENCES `dimpost` (`idLocation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idSalary` FOREIGN KEY (`idSalary`) REFERENCES `dimsalary` (`idSalary`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimday`
--
ALTER TABLE `dimday`
  ADD CONSTRAINT `fk_idMonth` FOREIGN KEY (`idMonth`) REFERENCES `dimmonth` (`idMonth`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimfirstproducttype`
--
ALTER TABLE `dimfirstproducttype`
  ADD CONSTRAINT `fk_idSecondType` FOREIGN KEY (`idSecondType`) REFERENCES `dimsecondproducttype` (`idType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimmonth`
--
ALTER TABLE `dimmonth`
  ADD CONSTRAINT `fk_idYear` FOREIGN KEY (`idYear`) REFERENCES `dimyear` (`idYear`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimpost`
--
ALTER TABLE `dimpost`
  ADD CONSTRAINT `fk_idCity` FOREIGN KEY (`idCity`) REFERENCES `dimcity` (`idCity`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimproduct`
--
ALTER TABLE `dimproduct`
  ADD CONSTRAINT `fk_idFirstProductType` FOREIGN KEY (`idProductType`) REFERENCES `dimfirstproducttype` (`idType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dimregion`
--
ALTER TABLE `dimregion`
  ADD CONSTRAINT `fk_idCountry` FOREIGN KEY (`idCountry`) REFERENCES `dimcountry` (`idCountry`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factsells`
--
ALTER TABLE `factsells`
  ADD CONSTRAINT `fk_idCustomer` FOREIGN KEY (`idCustomer`) REFERENCES `dimcustomer` (`idCustomer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idProduct` FOREIGN KEY (`idProduct`) REFERENCES `dimproduct` (`idProduct`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idSellDate` FOREIGN KEY (`idSellDate`) REFERENCES `dimday` (`idDay`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
