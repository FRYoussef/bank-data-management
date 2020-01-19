CREATE DATABASE IF NOT EXISTS bankDataWarehouse;

CREATE EXTERNAL TABLE IF NOT EXISTS factSells (
    productType STRING,
    productFirstCategory STRING,
    productSecondCategory STRING,
    productTransactionalId INT,
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
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
LOCATION 'rutaDelArchivo';



DESCRIBE factSells;
