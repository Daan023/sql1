<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include   "db.php";

?>
<html>
<head>
    <style>


        #box1{
            border: 2px solid black;
            position: absolute;
            top: 60px;
            left: 20px;
            width: 800px;
            height: 300px;
        }

        .box2 {
            border: 2px solid black;
            position: absolute;
            top: 60px;
            right: 20px;
            width: 800px;
            height: auto;
        }

        table {
            width: 95%;
            height: 90%;
            border: 2px solid black;
            background-color: lightgray;
        }

         table{
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

    <div class="box2">
        <form action="product.php" method="post">
            <?php
                $productLine = 'Classic Cars';
                //  print print_r($_POST,1);
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $productLine = $_POST['productLine'];
                }
                print createProductLineSelect($con, $productLine);


            ?>

            <input type="submit" value="Filter"/>
        </form>

        <?php
            echo "De geselecteerde productline is: " . $productLine ;

            $query = "SELECT productCode, productName, buyPrice as price FROM `products` where productLine = '$productLine'" ;

            $result =  mysqli_query($con, $query);
            $count = mysqli_num_rows($result);

            echo '</br>';
            echo  "Aantal prodcuten = " . $count;


            echo printTable($con, $query);

         ?>
    </div>

</head>
<body>

<div id="hdiv">
    <div class="head"><a href='index.php'>Sales</a></div>
    <div class="head"><a href='customers.php'>Customers</a></div>
    <div class="head"><a href='product.php'>Product catalogus</a></div>
</div>

<?php



echo '<div id="box1"> ' . 'Overzicht van aantallen en totale voorraadwaarde per productLine'. printTable($con, "SELECT productLine, COUNT(productVendor) AS aantalproducten, CONCAT('€', FORMAT(MSRP * quantityInStock, 2 , 'de_DE')) AS waardeVoorraad FROM products GROUP BY productLine; ") . '</div>';