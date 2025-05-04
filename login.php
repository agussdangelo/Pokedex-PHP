<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function inicioSesion($usuario, $contrasenia)
{
    $conexion = mysqli_connect("localhost", "root", "", "pokedex","3307");

    if (!$conexion) {
        die("Falla en la conexion: " . mysqli_connect_error());
    }

    if (empty($usuario) || empty($contrasenia)) {
        $_SESSION['errorLogin'] = "<p style='color: red'>Complete todos los datos</p>";
        return false;
    }

    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $contrasenia = mysqli_real_escape_string($conexion, $contrasenia);

    $consulta = "SELECT * FROM UsuariosAdministrador WHERE Usuario = '$usuario' AND Constrasenia = '$contrasenia'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) === 1) {
        $_SESSION['usuario'] = $usuario;
        unset($_SESSION['errorLogin']);
        return true;
    } else {
        $_SESSION['errorLogin'] = "<p style='color: red'>El usuario o contraseña son incorrectos</p>";
        return false;
    }
}
?>
