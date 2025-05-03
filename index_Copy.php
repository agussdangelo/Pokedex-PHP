<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link rel="stylesheet" href="style.css">

    
    <!-- Logo -->
    <style>
        .header-logo {
            height: 100px;
        }
    </style>
</head>
<body>

<!-- Encabezado -->
<header>
    <img src="../img/logo.png" alt="Logo" class="header-logo">
    <h1>POKÉDEX</h1>

    <form action="" method="POST" class="login-form">
        <label><b>Usuario</b></label>
        <input type="text" name="username" placeholder="Ingrese su nombre de usuario">
        <label><b>Contraseña</b></label>
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <button type="submit">Iniciar Sesión</button>
        <?php
            require_once 'login.php';

            if (isset($_POST['username']) && isset($_POST['password'])) {
                inicioSesion($_POST['username'], $_POST['password']);
                if (isset($_SESSION['errorLogin'])) {
                    echo "<div class='error-msg'>" . $_SESSION['errorLogin'] . "</div>";
                } else {
                    header('Location: indexAdmin.php');
                    exit();
                }
            }
        ?>
    </form>
</header>

<!-- Contenido principal para mostrar el pokemon -->
<div class="container">

</div>

</body>
</html>
