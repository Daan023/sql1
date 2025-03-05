<?php
global $con;
include 'configdb.php';
$sql = "select productnr, omschrijving, prijs from Producten";
$result = mysqli_query($con, $sql);

$aantalr = mysqli_num_rows($result);
echo "Aantal klanten = " . $aantalr;

echo '<br> <br>';

echo '<table border="1" bgcolor="grey" >';
echo '<tr>';
$f0 = mysqli_fetch_field_direct($result, 0);
echo '<td width="100"> <b>' . $f0->name ;
$f1 = mysqli_fetch_field_direct($result, 1);
echo '<td width="150"> <b>' . $f1->name ;
$f2  = mysqli_fetch_field_direct($result, 2);
echo '<td width="100"> <b>' . $f2->name ;
echo '<tr/>';



echo '<table border="1" bgcolor="grey" >';
while  ($row = mysqli_fetch_assoc($result)) {

    echo '<tr>';

    echo '<td width="100">' . $row['productnr'];
    echo '<td width="150">' . $row['omschrijving'];
    echo '<td width="100">' . $row['prijs'];

    echo '<tr/>';
}




