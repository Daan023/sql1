<html>
<head>
    <style>
        #box1{
            border: 2px solid black;
            position: absolute;
            top: 60px;
            left: 20px;
            width: 725px;
            height: 400px;
        }

        #box2{
            border: 2px solid black;
            position: absolute;
            top: 60px;
            right: 100px;
            width: 800px;
            height: 250px;
        }

        #box3{
            border: 2px solid black;
            position: absolute;
            top: 330px;
            right: 100px;
            width: 800px;
            height: 600px;
        }


        table {
            margin-left: 10px;
            width: 95%;
            height: 90%;
            border: 2px solid black;
            background-color: lightgray;
        }
        .head {
            padding: 10px;
            float: left;
            background-color: lightblue;
        }
        #hdiv {
            margin-left: 13px;
        }
    </style>




</head>
<body>
    <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include   "db.php";

?>
 <div id="hdiv">
 <div class="head"><a href='index.php'>Sales</a></div>
 <div class="head"><a href='customers.php'>Customers</a></div>
 <div class="head"><a href='product.php'>Product catalogus</a></div>
 </div>



<?php

echo '<div id="box1"> ' . 'Overzicht van het aantal orders per status en per jaar, voor de jaren 2004 en 2005 uit de tabel orders'. printTable($con,  " SELECT YEAR(orderDate) AS jaar, status, COUNT(status) AS aantal FROM orders WHERE YEAR(orderDate) = 2004 OR YEAR(orderDate) = 2005 GROUP BY status, YEAR(orderDate) ORDER BY jaar DESC, status;") . '</div>';
echo '<div id="box2"> '. 'Overzicht van het totaal van alle ontvangen betalingen per jaar, uit de tabel payments' . printTable($con, "SELECT YEAR(paymentDate) AS jaar, COUNT(*) AS aantalBetalingen, SUM(amount) AS totaalbetalingen FROM payments GROUP BY YEAR(paymentDate) ORDER BY `jaar` DESC ") . '</div>';
echo '<div id="box3"> '. 'Overzicht van de orders met een orderdatum in 2005, met de status shipped en waarbij het veld comments gevuld is' . printTable($con, "SELECT orderNumber, orderDate AS orderdatum, status, comments FROM orders WHERE orderDate BETWEEN '2005-01-01' AND '2005-12-31' AND comments IS NOT NULL AND status = 'Shipped';") . '</div>';


?>
</form>
</body>




