<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function inicioSesion($usuario, $contrasenia)
{
    $conexion = mysqli_connect("127.0.0.1", "pokedex_user", "pokedex123", "pokedex", 3307);

    if (!$conexion) {
        die("Falla en la conexion: " . mysqli_connect_error());
    }

    if (empty($usuario) || empty($contrasenia)) {
        $_SESSION['errorLogin'] = "<p style='color: red'>Complete todos los datos</p>";
        return false;
    }

    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $contrasenia = mysqli_real_escape_string($conexion, $contrasenia);

    $consulta = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) === 1) {

        $fila = mysqli_fetch_assoc($resultado);
        $hashGuardado = $fila['contrasenia']; //capturo la contrasenia

        if(password_verify($contrasenia, $hashGuardado)){
            $_SESSION['usuario'] = $usuario;
            unset($_SESSION['errorLogin']);
            return true;
        }else{
            $_SESSION['errorLogin'] = "<p style='color: red'>El usuario o contraseña son incorrectos</p>";
            return false;
        }
        
    } else {
        $_SESSION['errorLogin'] = "<p style='color: red'>El usuario o contraseña son incorrectos</p>";
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
   
    if (inicioSesion($username, $password)) {
        header('Location: ../../app/views/home.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white; /* Fondo blanco */
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 400px;
            background-color: #fff;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #d32f2f; /* Botones rojos */
            cursor: pointer;
            width: 100%;
            margin: 10px 0;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #cc0000; /* Cambio de color al pasar el mouse */
        }

        .btn:focus {
            outline: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 75%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input:focus {
            border-color: red; /* Resalta el borde cuando el campo está enfocado */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Iniciar Sesión</h2>

    <!-- Formulario de Inicio de Sesión -->
    <form action="../../app/views/login.php" method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Usuario" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn">Iniciar Sesión</button>
    </form>

    <!-- Formulario de Registro -->
    <form action="register.php" method="POST">
        <button type="submit" class="btn">Registrarse</button>
    </form>

    <!-- Mostrar error si no se loguea correctamente -->
    <?php
    if (isset($_SESSION['errorLogin'])) {
        echo "<div class='error-msg'>" . $_SESSION['errorLogin'] . "</div>";
    }
    ?>
</div>

</body>
</html>

