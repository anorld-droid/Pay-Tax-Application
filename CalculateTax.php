<?php

$basicSalary = $_POST['basicSalary'];
$houseAllowance = $_POST['houseallowance'];
$communtingAllowance = $_POST['communtingAllowance'];
$definedContributions = $_POST['definedContributions'];
$benevolentFunds = $_POST['benevolentFunds'];
$nssf = $_POST['nssf'];
$nhif = $_POST['nhif'];
$tax = 0;


define("PENSIONRELIEF", ($basicSalary * (10 / 100)));
define("PENSIONCONTRIBUTION", ($basicSalary * (10 / 100)));
define("UNIONDUES", ($basicSalary * 1 / 100));
define("INITIALAMT", 24000);
define("NEXTAMT", 8333);
define("EXTRAAMT", 32333);
define("TAXRELIEF", 2400);




$grossPay = $basicSalary + $houseAllowance + $communtingAllowance;
$taxblePay = $grossPay - $definedContributions - PENSIONRELIEF;

if ($taxblePay <= INITIALAMT) {
    $tax = INITIALAMT * (10 / 100);
} elseif ($taxblePay > INITIALAMT) {
    $tempTax1 = INITIALAMT * (10 / 100);
   
    $tempTax2 = $taxblePay * (25 / 100);
    $tax = $tempTax1 + $tempTax2;

    if ($taxblePay > EXTRAAMT) {
        $taxblePay = $taxblePay - EXTRAAMT;
        $tempTax3 = $taxblePay * (30 / 100);

        $tax += $tempTax3;
    }
}
$tax = $tax - TAXRELIEF;
$statutories = $nhif + $nssf;
$paye = $tax + $statutories;

echo "your P.A.Y.E is $paye".'<br>';

$totalDeductions = PENSIONCONTRIBUTION + $benevolentFunds + UNIONDUES;
$netPay = $grossPay - $tax - $totalDeductions;

echo "your NET PAY is $netPay".'<br>';

?>