<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=pokedex;charset=utf8", 'pokedex_user', 'pokedex123');
    echo "✅ Conexión exitosa";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
