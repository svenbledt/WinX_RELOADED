<?php
$host = '185.254.96.204';
$port = '3306';
$dbname = 'db_winx';
$username = 'winx';
$password = 'opportunity';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $pe) {
    die("Konnte nicht mit der Datenbank $dbname verbinden:" . $pe->getMessage());
}
