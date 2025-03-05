<?php
$conf["username"]= 'root';
$conf["password"]= '';
$conf["host"]= 'localhost';
$conf["database"]= 'BityByBit';

$con = mysqli_connect($conf["host"], $conf["username"], $conf["password"], $conf["database"]);

if ($con == false) {
    echo "kan geen verbinding maken met de database!";
}


