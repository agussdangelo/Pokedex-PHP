<?php
session_start();
/*if (!isset($_SESSION['usuario_id'])) {
    header('Location: /index.php');
    exit;
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area privada</title>
</head>

<body>
    <?php if(isset($_SESSION['usuario'])): ?> <!--Checkea pregunta si existe la variable-->
    <h2>Bienvenido, <?=htmlspecialchars($_SESSION['usuario']) ?>!</h2>
    <p>Estas logueado</p>
    <p><a href="logout.php">Cerrar sesion </a> </p>
    
    <?php else: ?>
        <h2>No estas logueado </h2>
        <p><a href = "login.php">Iniciar sesion</a></p>
    <?php endif; ?>
</body>
</html>