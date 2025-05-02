<?php
$host = '127.0.0.1';
$port = '3307';
$dbname = 'pokedex';
$user = 'pokedex_user';
$pass = 'pokedex123';

try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
