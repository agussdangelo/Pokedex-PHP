<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
</head>
<body>
<h1>Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsuario']) ?>!</h1>
<p>Estás dentro del sistema.</p>
<a href="logout.php">Cerrar sesión</a>
</body>
</html>
