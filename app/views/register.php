<?php
$pdo = require_once __DIR__ . '/../../repo/Database.php';


$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $contraseña = $_POST['contraseña'];

    if (empty($nombreUsuario) || empty($contraseña)) {
        $errors[] = "Todos los campos son obligatorios.";
    }

    if (strlen($contraseña) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombreUsuario = ?");
        $stmt->execute([$nombreUsuario]);

        if ($stmt->rowCount() > 0) {
            $errors[] = "El nombre de usuario ya existe.";
        } else {
            $hash = password_hash($contraseña, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombreUsuario, contraseña) VALUES (?, ?)");
            $stmt->execute([$nombreUsuario, $hash]);

            header('Location: ../../index.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Pokedex - Programación Web II - UNLaM</h1>
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h4 class="card-title text-center">Registro de Usuario</h4>

            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="nombreUsuario" class="form-label">Nombre de usuario</label>
                    <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <input type="password" name="contraseña" id="contraseña" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </form>
        </div>

        <div class="text-center mt-3">
            <a href="../../index.php">¿Ya tenés una cuenta? Iniciar sesión</a>
        </div>

    </div>
</div>
</body>
</html>
