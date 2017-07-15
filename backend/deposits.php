<?php
header('Content-type: application/json');

include 'db/config.php';

$results = mysql_query("SELECT * FROM accounts");

if (mysql_num_rows($results) > 0) {

    $rows = array();

    while ($r = mysql_fetch_assoc($results)) {

        $rows['dataObj'][] = $r;

    }

    echo json_encode($rows);

}
