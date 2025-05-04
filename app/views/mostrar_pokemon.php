<?php
session_start();

if(isset($_GET["numero"])){
    $conexion = mysqli_connect("127.0.0.1", "pokedex_user", "pokedex123", "pokedex", 3307);

    if(!$conexion){
        die("Conexion fallida: " . mysqli_connect_error());
    }

    $numeroPokemon = $_GET["numero"];
    $resultado = mysqli_query($conexion, "SELECT * FROM pokemon WHERE Numero = '$numeroPokemon'");

    if (mysqli_num_rows($resultado) == 0){
        $_SESSION['errorBusqueda'] = "<p style='color: red'>No se encontraron resultados para el numero de Pokemon: " . $numeroPokemon . "</p>" . "<br>";
        header("Location: index.php"); 
        exit();
    }

    $_SESSION['pokemonMostrado'] = mysqli_fetch_assoc($resultado);

    $pokemon = $_SESSION['pokemonMostrado'];
    $idTipoPokemon = $pokemon['Tipo'];
    $resultadoTipo = mysqli_query($conexion, "SELECT * FROM tipo WHERE identificador = '$idTipoPokemon'");
    $tipoPokemon = mysqli_fetch_assoc($resultadoTipo);

    $_SESSION['tipoPokemonMostrado'] = $tipoPokemon;

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/css/style.css">


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
    <img src="../../public/img/logo.png" alt="Logo" class="header-logo">

    <a href="../../index.php" class="text-decoration-none text-white"><h1>POKÉDEX</h1></a>

    <div class="d-flex justify-content-between flex-column pr-2">
        <div class="w-100 border border-2 border-white p-2 hover-box">
            <a href="../../app/views/login.php" class="text-white text-decoration-none hover-link">Iniciar Sesion</a>
        </div>

        <div class="w-100 border border-2 border-white mt-3 p-2 hover-box">
            <a href="../../app/views/register.php" class="text-white text-decoration-none hover-link">Registrarse</a>
        </div>
    </div>
</header>

<div class="w3-container">
<?php
require_once 'tablaTipos.php';

if(isset($_SESSION['pokemonMostrado'])) {
    $pokemon = $_SESSION['pokemonMostrado'];

    $numeroPokemon = strval($pokemon["Numero"]);
    $numeroPokemon = str_pad($numeroPokemon, 3, "0", STR_PAD_LEFT);
    $rutaImagen = "../../public/img/" . $numeroPokemon . ".png";

    echo "<div class='w3-card'>";
    echo "<div class='w3-container'>";
    echo "<img src='{$rutaImagen}' alt='{$pokemon['Nombre']}' style='max-width:100%;'>";
    echo "<h2>" . $pokemon["Nombre"] . "</h2>";
    echo "<p>Numero: " . $pokemon["Numero"] . "</p>";

    if(isset($_SESSION['tipoPokemonMostrado'])) {
        $tipoPokemon = $_SESSION['tipoPokemonMostrado'];

        $idTipoPokemon = $tipoPokemon["Identificador"];

        tablaTipos($idTipoPokemon);
    } else {
        echo "<p>Tipo: Desconocido</p>";
    }

    echo "<p>Descripcion: " . $pokemon["Descripcion"] . "</p>";
    echo "<a href='/Pokedex-PHP/index.php'>Volver</a> ";
    echo "</div>";
    echo "</div>";
}
?>
</div>

</body>
</html>


