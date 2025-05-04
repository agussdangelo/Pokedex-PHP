<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
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
    <a href="index.php" class="text-decoration-none text-white"><h1>POKÉDEX</h1></a>

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
    <main>
        <div class="container">
            <form action="" method="post" class="search-form">
                <input type="text" name="busqueda" placeholder="Buscar Pokemon por nombre, tipo o numero">
                <button type="submit">Buscar</button>
            </form>
            <?php
            require_once 'ListadoPokemon.php';
            require_once 'tablaTipos.php';

            echo "<div class='w3-row-padding'>";
            foreach($_SESSION['resultadoBusqueda'] as $fila){
                echo "<form action='app/views/modificar.php' method='POST'>";
                echo "<div class='w3-quarter'>";
                echo "<div class='w3-card'>";
                echo "<a href='mostrar_pokemon.php?numero=" . $fila["Numero"] . "' class='w3-hover-opacity'>"; //link prueba
                echo "<img src='" . $fila["Imagen"] . "' alt='Pokemon' style='max-width:100%; max-height:100%;'>";
                echo "</a>";
                echo "<div class='w3-container'>";
                echo "<input type='hidden' name='nombre' value='{$fila["Nombre"]}'>";
                echo "<h2>" . $fila["Nombre"] . "</h2>";
                echo "<input type='hidden' name='numero' value='{$fila["Numero"]}'>";
                echo "<p>Numero: " . $fila["Numero"] . "</p>";
                echo "<input type='hidden' name='tipo' value='{$fila["Tipo"]}'>";
                tablaTipos($fila["Tipo"]);
                echo "<input type='hidden' name='descripcion' value='{$fila["Descripcion"]}'>";
                echo "<button>Modificar</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
            }
            echo "</div>";
            if(isset($_SESSION['errorBusqueda'])) {
                echo $_SESSION['errorBusqueda'];
            }
            ?>
            </div>
        </div>
    </main>

</body>
</html>
