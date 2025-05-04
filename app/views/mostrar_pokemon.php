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
    <h1>POKÉDEX</h1>

<!--    <form action="" method="POST" class="login-form">-->
<!--        <label><b>Usuario</b></label>-->
<!--        <input type="text" name="username" placeholder="Ingrese su nombre de usuario">-->
<!--        <label><b>Contraseña</b></label>-->
<!--        <input type="password" name="password" placeholder="Ingrese su contraseña">-->
<!--        <button type="submit">Iniciar Sesión</button>-->
<!--        --><?php
//        require_once 'login.php';
//
//        if (isset($_POST['username']) && isset($_POST['password'])) {
//            inicioSesion($_POST['username'], $_POST['password']);
//            if (isset($_SESSION['errorLogin'])) {
//                echo "<div class='error-msg'>" . $_SESSION['errorLogin'] . "</div>";
//            } else {
//                header('Location: indexAdmin.php');
//                exit();
//            }
//        }
//        ?>
<!--    </form>-->
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
    echo "</div>";
    echo "</div>";
}
?>
</div>

</body>
</html>


