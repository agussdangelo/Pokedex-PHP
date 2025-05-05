<?php
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pokemon_id = $_GET['id'];

    // Conexión a la base de datos
    $ruta_config = dirname(dirname(__DIR__)) . "/repo/config.ini";
    $config = parse_ini_file($ruta_config);
    $database = mysqli_connect(
        $config["host"],
        $config["user"],
        $config["pass"],
        $config["db"],
        $config["puerto"]
    ) or die("Error al conectar con la base de datos");

    // Obtener la ruta de la imagen del Pokémon antes de eliminar el registro
    $sql_select_imagen = "SELECT Imagen FROM pokemon WHERE Identifcador = ?";
    $stmt_select_imagen = mysqli_prepare($database, $sql_select_imagen);
    mysqli_stmt_bind_param($stmt_select_imagen, "i", $pokemon_id);
    mysqli_stmt_execute($stmt_select_imagen);
    mysqli_stmt_bind_result($stmt_select_imagen, $ruta_imagen_relativa);
    mysqli_stmt_fetch($stmt_select_imagen);
    mysqli_stmt_close($stmt_select_imagen);

    $ruta_imagen_fisica = null;
    if (!empty($ruta_imagen_relativa)) {
        $ruta_base = dirname(dirname(__DIR__)) . "/public";
        $ruta_imagen_fisica = $ruta_base . $ruta_imagen_relativa;

        // Verificar si el archivo existe antes de intentar eliminarlo
        if (file_exists($ruta_imagen_fisica)) {
            if (unlink($ruta_imagen_fisica)) {
                // Éxito al eliminar el archivo
                $mensaje_archivo = " y su imagen asociada fue eliminada.";
                $tipo_archivo = 'success';
            } else {
                // Error al eliminar el archivo
                $mensaje_archivo = ", pero hubo un error al intentar eliminar su imagen asociada.";
                $tipo_archivo = 'warning';
            }
        } else {
            $mensaje_archivo = ", pero su archivo de imagen no fue encontrado.";
            $tipo_archivo = 'info';
        }
    } else {
        $mensaje_archivo = ", pero no se encontró información de la imagen.";
        $tipo_archivo = 'info';
    }

    // Preparar la consulta SQL para eliminar el Pokémon de la base de datos
    $sql_delete_pokemon = "DELETE FROM pokemon WHERE Identifcador = ?";
    $stmt_delete_pokemon = mysqli_prepare($database, $sql_delete_pokemon);

    if ($stmt_delete_pokemon) {
        mysqli_stmt_bind_param($stmt_delete_pokemon, "i", $pokemon_id);

        if (mysqli_stmt_execute($stmt_delete_pokemon)) {
            // Éxito al eliminar el Pokémon
            $_SESSION['mensaje'] = "Pokémon eliminado exitosamente" . $mensaje_archivo;
            $_SESSION['mensaje_tipo'] = 'success';
        } else {
            // Error al eliminar el Pokémon
            $_SESSION['mensaje'] = "Error al eliminar el Pokémon: " . mysqli_error($database) . $mensaje_archivo;
            $_SESSION['mensaje_tipo'] = 'danger';
        }

        mysqli_stmt_close($stmt_delete_pokemon);
    } else {
        $_SESSION['mensaje'] = "Error al preparar la consulta de eliminación del Pokémon: " . mysqli_error($database) . $mensaje_archivo;
        $_SESSION['mensaje_tipo'] = 'danger';
    }

    mysqli_close($database);
    header("Location: home.php");
    exit();

} else {
    $_SESSION['mensaje'] = "ID de Pokémon no válido para eliminar.";
    $_SESSION['mensaje_tipo'] = 'warning';
    header("Location: home.php");
    exit();
}

/*session_start();

// Verificar si se recibió el ID del Pokémon a eliminar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pokemon_id = $_GET['id'];

    // Conexión a la base de datos (tu código de conexión aquí)
    $ruta_config = dirname(dirname(__DIR__)) . "/repo/config.ini";
    $config = parse_ini_file($ruta_config);
    $database = mysqli_connect(
        $config["host"],
        $config["user"],
        $config["pass"],
        $config["db"],
        $config["puerto"]
    ) or die("Error al conectar con la base de datos");

    // Preparar la consulta SQL para eliminar el Pokémon
    $sql = "DELETE FROM pokemon WHERE Identifcador = ?";
    $stmt = mysqli_prepare($database, $sql);

    if ($stmt) {
        // Vincular el parámetro ID
        mysqli_stmt_bind_param($stmt, "i", $pokemon_id);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Redirigir con mensaje de éxito
            $_SESSION['mensaje'] = "Pokémon eliminado exitosamente.";
            $_SESSION['mensaje_tipo'] = 'success';
            header("Location: home.php");
            exit();
        } else {
            // Manejar errores de eliminación
            $_SESSION['mensaje'] = "Error al eliminar el Pokémon: " . mysqli_error($database);
            $_SESSION['mensaje_tipo'] = 'danger';
            header("Location: home.php");
            exit();
        }

        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
    } else {
        // Error al preparar la consulta
        $_SESSION['mensaje'] = "Error al preparar la consulta de eliminación: " . mysqli_error($database);
        $_SESSION['mensaje_tipo'] = 'danger';
        header("Location: home.php");
        exit();
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($database);

} else {
    // Si no se recibió un ID válido
    $_SESSION['mensaje'] = "ID de Pokémon no válido para eliminar.";
    $_SESSION['mensaje_tipo'] = 'warning';
    header("Location: home.php");
    exit();
}*/
?>