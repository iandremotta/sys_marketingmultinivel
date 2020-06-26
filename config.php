<?php
global $pdo;
try {
    $pdo = new PDO("mysql:dbname=db_mmn;host=localhost", "root", "root");
} catch (PDOException $e) {
    echo "Error -> " . $e->getMessage();
}

$limite = 4;
$patentes = array();
