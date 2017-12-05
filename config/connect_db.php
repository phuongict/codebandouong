<?php
$host = 'localhost';
$port = 3306;
$db_user = 'root';
$db_pass = '';
$db_name = 'bandouong';

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name, $port);
if(mysqli_connect_errno()){
    echo 'Error connect to Database: '.mysqli_connect_error();
    die();
}
mysqli_set_charset($conn, 'utf8');
$GLOBALS['conn'] = $conn;