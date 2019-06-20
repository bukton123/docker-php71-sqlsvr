<?php
$serverName = "localhost"; //serverName\instanceName ถ้าฐานข้อมูลอยู่ในเครื่องเราใช้ localhost 
$connectionInfo = array(
    "Database" => "test",
    "UID" => "sa",
    "PWD" => "123456"
);

$conn = sqlsrv_connect( $serverName, $connectionInfo);

if ( $conn ) {
    echo "Connection established.<br />";
} else {
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}

phpinfo();

