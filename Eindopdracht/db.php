<?php
//bestand met databasegegevens
$conf["user"] = 'root';
$conf["pass"] = '';
$conf["host"] = 'localhost';
$conf["database"] = 'classicmodels';

$con = mysqli_connect($conf["host"], $conf["user"], $conf["pass"], $conf["database"]);

if ($con === false) // Verbinding is mislukt!
{
    echo "Kan geen verbinding maken met de database";
}

function createProductLineSelect($db, $productLine)
{
    $sql = 'select productLine from productlines';
    $result =  mysqli_query($db, $sql);


    $html = '<select name="productLine" style="margin: 10px">';
    while ($row = mysqli_fetch_row($result)){
        //var_dump($row);
        $selected = '';
        if ( $row[0] === $productLine) { $selected = 'selected = "selected"'; }
        $html .= '<option val="' . $row[0] . '"' . $selected . '>' . $row[0] .'</option>';
    }
    $html .= '</select>';

    return $html;
}

function printTable($db, $query)
{
    $result =  mysqli_query($db, $query);
    $count = mysqli_num_rows($result);
    // var_dump($result);

    $table = '<table border ="1" >';

    $th = array();
    $table .= "<thead>";
    $table .= "<tr>";
    while ($field = mysqli_fetch_field($result)){
        $table .= "<th>" . $field->name . "</th>";
    }
    $table .= "</tr>";
    $table  .=  "</thead>";

    $table .= "<tbody>";
    while ($row = mysqli_fetch_row($result)){
        // var_dump($row);
        $table .= "<tr>";
        foreach ($row as $value){
            $table .= "<td>" . $value . "</td>";
        }
        $table .= "</tr>";
    }
    $table .= "</tbody>";
    $table .=  "</table>";



    return  $table;
}