<?php 
include 'Account.php';
include 'AccountEntry.php'; 
include 'AccountOperation.php'; 
include 'AddressProvince.php'; 
include 'AddressLocality.php'; 
include 'AddressPostCode.php'; 
include 'AddressCountry.php'; 
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
include 'SavingsAccount.php';




$output = shell_exec('php Account.php') . "\n" ;
$output .= shell_exec('php AccountEntry.php') . "\n" ;
$output .= shell_exec('php AccountOperation.php') . "\n" ;
$output .= shell_exec('php AddressProvince.php') . "\n" ;
$output .= shell_exec('php AddressLocality.php') . "\n" ;
$output .= shell_exec('php AddressPostCode.php') . "\n" ;
$output .= shell_exec('php AddressCountry.php') . "\n" ;
$output .= shell_exec('php Address.php') . "\n" ;
$output .= shell_exec('php BussinesCard.php') . "\n" ;
$output .= shell_exec('php Card.php') . "\n" ;
$output .= shell_exec('php CardOperation.php') . "\n" ;
$output .= shell_exec('php Charge.php') . "\n" ;
$output .= shell_exec('php Credit.php') . "\n" ;
$output .= shell_exec('php CreditPayment.php') . "\n" ;
$output .= shell_exec('php CreditPaymentCard.php') . "\n" ;
$output .= shell_exec('php CreditPaymentCharge.php') . "\n" ;
$output .= shell_exec('php Debit.php') . "\n" ;
$output .= shell_exec('php DepositAccount.php') . "\n" ;
$output .= shell_exec('php Product.php') . "\n" ;
$output .= shell_exec('php FinancialAsset.php') . "\n" ;
$output .= shell_exec('php Interest.php') . "\n" ;
$output .= shell_exec('php Person.php') . "\n" ;
$output .= shell_exec('php IsAutorized.php') . "\n" ;
$output .= shell_exec('php Loan.php') . "\n" ;
$output .= shell_exec('php Owns.php') . "\n" ;
$output .= shell_exec('php SavingsAccount.php') . "\n" ;

echo "<pre>$output</pre>";






?>