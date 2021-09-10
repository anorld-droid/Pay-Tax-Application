<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KRA TAX</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav id="header-nav" class="navbar navbar-default">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 "></div>
                    <div class="col-md-4">
                        <div class="navbar-header">
                            <div class="navbar-brand">
                                <h1>Employee:&nbsp;<?php echo $_POST["fname"] . "&nbsp; " . $_POST["lname"] . "&nbsp;" ?> </h1>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 "></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">

                <?php
                $basicSalary = $_POST['basicSalary'];
                $houseAllowance = $_POST['houseallowance'];
                $commutingAllowance = $_POST['commutingAllowance'];
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




                $grossPay = $basicSalary + $houseAllowance + $commutingAllowance;
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
                $totalDeductions = PENSIONCONTRIBUTION + $benevolentFunds + UNIONDUES;
                $netPay = $grossPay - $tax - $totalDeductions;

                echo "<table class=\"table\">";
                echo    "<thead>";
                echo        "<tr>";
                echo            "<th>Transaction</th>";
                echo            "<th>Amount</th>";
                echo            "<th>Balance</th>";
                echo        "</tr>";
                echo    "</thead>";
                echo    "<tr>";
                echo        "<td>Basic Pay</td>";
                echo        "<td>" . $basicSalary . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo    "<tr>";
                echo        "<td>House Allowance</td>";
                echo        "<td>" . $houseAllowance . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo    "<tr>";
                echo        "<td>Commuting Allowance</td>";
                echo        "<td>" . $commutingAllowance . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo    "<tr>";
                echo    "</tr>";
                echo        "<td>GROSS PAY</td>";
                echo        "<td>" . $grossPay . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo        "<td>Defined Contributions</td>";
                echo        "<td>" . $definedContributions . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo    "<tr>";
                echo        "<td>Benevolent Funds</td>";
                echo        "<td>" . $benevolentFunds . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo        "<td>NSSF</td>";
                echo        "<td>" . $nssf . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo        "<td>NHIF</td>";
                echo        "<td>" . $nhif . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo    "</tr>";
                echo        "<td>P.A.Y.E</td>";
                echo        "<td>" . $paye . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo    "</tr>";
                echo        "<td>NET PAY</td>";
                echo        "<td>" . $netPay . "</td>";
                echo        "<td> ..............</td>";
                echo    "</tr>";
                echo "<table>";
                ?>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>