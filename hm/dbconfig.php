<?php

$db_host = "database";
$db_user = "natchasak";
$db_password = "SuN*0897925041";
$db_name = "kormoon";


$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);


$mysqli->set_charset("utf8");


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    
}