<?php
session_start();
$pdo = require_once 'repo/Database.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $contraseña = $_POST['contraseña'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombreUsuario = ?");
    $stmt->execute([$nombreUsuario]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombreUsuario'] = $usuario['nombreUsuario'];
        header('Location: app/views/home.php');
        exit;
    } else {
        $errors[] = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <title>Pokedex - Programacion Web II</title>
</head>
<body>
<h1 class="text-center">Pokedex - Programación Web II - UNLaM</h1>

<div class="container">
    <h2>Login</h2>
    <form action="" method="post">
        <label>
            <input type="text" name="nombreUsuario" placeholder="Nombre de usuario" class="form-control mb-2" required>
        </label>
        <label>
            <input type="password" name="contraseña" placeholder="Contraseña" class="form-control mb-2" required>
        </label>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>

    <?php foreach ($errors as $error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>

    <div class="text-center">
        <a href="app/views/register.php" class="btn btn-secondary mt-2">Registrarse</a>
    </div>

</div>
</body>
</html>
