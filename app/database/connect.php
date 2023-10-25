<?php


$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'vapeshop';

/*

$host = 'localhost';
$user = '36226312_tarusiek';
$pass = 'NoweHaslo2022';
$db_name = '36226312_tarusiek';*/


$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}