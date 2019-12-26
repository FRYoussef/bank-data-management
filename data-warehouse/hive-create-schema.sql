CREATE DATABASE IF NOT EXISTS bankDataWarehouse;

CREATE TABLE IF NOT EXISTS factSells (
    productType STRING,
    productCategory STRING,
    productInvestment DOUBLE,
    currency STRING,
    interestType STRING,
    interest FLOAT,
    sellDate TIMESTAMP,
    customerId INT,
    customerBirthDate TIMESTAMP,
    customerPostCode INT,
    customerCity STRING,
    customerRegion STRING,
    customerCountry STRING,
    customerSalary DOUBLE,
    customerGender STRING,
    customerUnitsSold INT,
    customerTotalRevenue DOUBLE,
    customerType STRING)
ROW FORMAT DELIMITED
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n';



DESCRIBE factSells;