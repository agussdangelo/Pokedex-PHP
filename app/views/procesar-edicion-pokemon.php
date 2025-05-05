<?php
session_start();

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

$id = $_POST['id'] ?? null;
$numero = $_POST['numero'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$tipo = $_POST['tipo_pokemon'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$imagen_actual = $_POST['imagen_actual'] ?? '';

$nombreSeguro = mysqli_real_escape_string($database, $nombre);
$numeroSeguro = mysqli_real_escape_string($database, $numero);
$tipoSeguro = mysqli_real_escape_string($database, $tipo);
$descripcionSeguro = mysqli_real_escape_string($database, $descripcion);

$url_img = $imagen_actual;

if (isset($_FILES['img_pokemon']) && $_FILES['img_pokemon']['error'] == UPLOAD_ERR_OK) {
    define('PROJECT_ROOT', dirname(dirname(__DIR__)));
    $nombreTemporal = $_FILES['img_pokemon']['tmp_name'];
    $nombreFinal = basename($_FILES['img_pokemon']['name']);
    $rutaCarpetaImg = PROJECT_ROOT . '/public/img';
    $destino_fisico = $rutaCarpetaImg . '/' . $nombreFinal;
    $destino_web = '/Pokedex-PHP/public/img/' . $nombreFinal;
    $url_img = '/img/' . $nombreFinal;
    if (!is_dir($rutaCarpetaImg)) {
        mkdir($rutaCarpetaImg, 0777, true);
    }
    if (!move_uploaded_file($nombreTemporal, $destino_fisico)) {
        echo "Error al mover la nueva imagen.";
        exit();
    }
}

if ($id !== null) {
    $sql = "UPDATE pokemon SET Numero=?, Imagen=?, Nombre=?, Tipo=?, Descripcion=? WHERE Identifcador=?";
    $stmt = mysqli_prepare($database, $sql);
    mysqli_stmt_bind_param($stmt, "issisi", $numeroSeguro, $url_img, $nombreSeguro, $tipoSeguro, $descripcionSeguro, $id);

    if (mysqli_stmt_execute($stmt)) {
        $url_destino = "/Pokedex-PHP/app/views/home.php?mensaje=pokemon_actualizado";
    } else {
        echo "Error al actualizar el pokemon: " . mysqli_error($database);
        $url_destino = "/Pokedex-PHP/app/views/crear-pokemon.php?id=" . $id . "&error=actualizacion_fallida";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: ID de Pokémon no encontrado para la edición.";
    $url_destino = "/Pokedex-PHP/app/views/home.php?error=id_no_encontrado";
}

mysqli_close($database);

unset($_SESSION['resultadoBusqueda']);
unset($_SESSION['errorBusqueda']);
header("Location: " . $url_destino);
exit();
?>