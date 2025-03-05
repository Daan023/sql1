<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "db.php";
?>

<html>
<head>
    <style>

        #box1 {
            border: 2px solid black;
            position: absolute;
            top: 60px;
            left: 20px;
            width: 800px;
            height: 350px;
        }

        #box2 {
            border: 2px solid black;
            position: absolute;
            top: 60px;
            right: 20px;
            width: 800px;
            height: 150px;
        }

        .box3 {
            border: 2px solid black;
            position: absolute;
            top: 250px;
            right: 20px;
            width: 800px;
            height: auto;

        }

        table {
            margin-left: 10px;
            width: 95%;
            height: 20%;
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
<div class="box3">
    Zoek klanten met een beginletter:
    <form action="customers.php" method="post">
        <input type="text" name="search"/>
        <input type="submit" value="Filter"/>
    </form>

    <?php
       // $search = $_POST['search'];
    //echo "Alle klanten beginnend met de letter: " . $search;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $search = $_POST['search'];

        echo "Alle klanten beginnend met de letter: " . $search . '<br>';

        $query = "SELECT customerName, CONCAT(contactFirstName, contactLastName) AS contactFullName, phone FROM customers WHERE customerName LIKE '$search%';";

        $result =  mysqli_query($con, $query);
        $count = mysqli_num_rows($result);

        echo "Het aantal klanten in deze selectie is: " . $count;




        echo printTable($con, $query);
    }

    ?>
</div>
</body>




<div id="hdiv">
    <div class="head"><a href='index.php'>Sales</a></div>
    <div class="head"><a href='customers.php'>Customers</a></div>
    <div class="head"><a href='product.php'>Product catalogus</a></div>
</div>

<?php
echo "<div id='box1'>" . "Klanten in de USA, Australie en Japan met een kredietlimiet van 100.000" . printTable($con, "SELECT customerName, country, creditLimit FROM customers WHERE creditLimit > 100000 AND Country IN ('USA', 'Japan', 'Australia'); ") . "</div>";
echo "<div id='box2'>" . "Overzicht van landen met meer dan 10 klanten in dat land" . printTable($con, "SELECT country, COUNT(*) AS aantalCustomers FROM customers WHERE country IN ('USA', 'Germany', 'france') GROUP BY country; ") . "</div>";