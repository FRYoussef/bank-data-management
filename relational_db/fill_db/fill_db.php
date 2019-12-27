<?php 
include 'Account.php';
include 'AccountEntry.php'; 
include 'AccountOperation.php'; 
include 'AddressProvince.php'; 
include 'AddressLocality.php'; 
include 'AddressPostCode.php'; 
include 'Address.php'; 
include 'BussinesCard.php'; 
include 'Card.php'; 
include 'CardOperation.php'; 
include 'Charge.php'; 
include 'Credit.php'; 
include 'CreditPayment.php'; 
include 'CreditPaymentCard.php'; 
include 'CreditPaymentCharge.php'; 
include 'Debit.php'; 
include 'DepositAccount.php'; 
include 'Product.php'; 
include 'FinancialAsset.php'; 
include 'Interest.php'; 
include 'Person.php'; 
include 'IsAutorized.php'; 
include 'Loan.php'; 
include 'Owns.php'; 
include 'SavingAccount.php';




$output = shell_exec('php Account.php') . "\r\n" ;
$output .= shell_exec('php AccountEntry.php') . "\r\n" ;
$output .= shell_exec('php AccountOperation.php') . "\r\n" ;
$output .= shell_exec('php AddressProvince.php') . "\r\n" ;
$output .= shell_exec('php AddressLocality.php') . "\r\n" ;
$output .= shell_exec('php AddressPostCode.php') . "\r\n" ;
$output .= shell_exec('php Address.php') . "\r\n" ;
$output .= shell_exec('php BussinesCard.php') . "\r\n" ;
$output .= shell_exec('php Card.php') . "\r\n" ;
$output .= shell_exec('php CardOperation.php') . "\r\n" ;
$output .= shell_exec('php Charge.php') . "\r\n" ;
$output .= shell_exec('php Credit.php') . "\r\n" ;
$output .= shell_exec('php CreditPayment.php') . "\r\n" ;
$output .= shell_exec('php CreditPaymentCard.php') . "\r\n" ;
$output .= shell_exec('php CreditPaymentCharge.php') . "\r\n" ;
$output .= shell_exec('php Debit.php') . "\r\n" ;
$output .= shell_exec('php DepositAccount.php') . "\r\n" ;
$output .= shell_exec('php Product.php') . "\r\n" ;
$output .= shell_exec('php FinancialAsset.php') . "\r\n" ;
$output .= shell_exec('php Interest.php') . "\r\n" ;
$output .= shell_exec('php Person.php') . "\r\n" ;
$output .= shell_exec('php IsAutorized.php') . "\r\n" ;
$output .= shell_exec('php Loan.php') . "\r\n" ;
$output .= shell_exec('php Owns.php') . "\r\n" ;
$output .= shell_exec('php SavingAccount.php') . "\r\n" ;

echo "<pre>$output</pre>";






?>