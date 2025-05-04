<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="public/css/style.css">
    
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
    <img src="public/img/logo.png" alt="Logo" class="header-logo">
    <h1>POKÉDEX</h1>

<!--    <form action="" method="POST" class="login-form">-->
<!--        <label><b>Usuario</b></label>-->
<!--        <input type="text" name="username" placeholder="Ingrese su nombre de usuario">-->
<!--        <label><b>Contraseña</b></label>-->
<!--        <input type="password" name="password" placeholder="Ingrese su contraseña">-->
<!--        <button type="submit">Iniciar Sesión</button>-->
<!--        --><?php
//            require_once 'login.php';
//
//            if (isset($_POST['username']) && isset($_POST['password'])) {
//                inicioSesion($_POST['username'], $_POST['password']);
//                if (isset($_SESSION['errorLogin'])) {
//                    echo "<div class='error-msg'>" . $_SESSION['errorLogin'] . "</div>";
//                } else {
//                    header('Location: indexAdmin.php');
//                    exit();
//                }
//            }
//        ?>
<!--    </form>-->
    <div>
        <a href="app/views/login.php">Iniciar Sesion</a>
    </div>

    <div>
        <a href="app/views/register.php">Registrarse</a>
    </div>

</header>

<!-- Contenido principal para mostrar el pokemon -->
<div class="container">
    <form action="" method="post" class="search-form">
        <input type="text" name="busqueda" placeholder="Buscar Pokemon por nombre, tipo o numero">
        <button type="submit">Buscar</button>
    </form>

    <div class="w3-margin-top">
        <?php
        require_once 'app/views/ListadoPokemon.php';
        require_once 'app/views/tablaTipos.php';
        echo "<div class='w3-row-padding'>";

        foreach($_SESSION['resultadoBusqueda'] as $fila){
            echo "<div class='w3-quarter'>";
            echo "<div class='w3-card'>";
            echo "<a href='app/views/mostrar_pokemon.php?numero=" . $fila["Numero"] . "'class='w3-hover-opacity'>"; //link prueba
            echo "<img src='" . $fila["Imagen"] . "' alt='Pokemon' style='max-width:100%; max-height:100%;'>";
            echo "</a>";
            echo "<div class='w3-container'>";
            echo "<h2>" . $fila["Nombre"] . "</h2>";
            echo "<p>Numero: " . $fila["Numero"] . "</p>";
            tablaTipos($fila["Tipo"]);
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        if(isset($_SESSION['errorBusqueda'])) {
            echo $_SESSION['errorBusqueda'];
        }

        echo "</div>";
        ?>
    </div>
</div>

</body>
</html>
