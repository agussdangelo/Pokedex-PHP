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

    <div class="d-flex justify-content-between flex-column pr-2">
        <div class="w-100 border border-2 border-white p-2 hover-box">
            <a href="app/views/login.php" class="text-white text-decoration-none hover-link">Iniciar Sesion</a>
        </div>

        <div class="w-100 border border-2 border-white mt-3 p-2 hover-box">
            <a href="app/views/register.php" class="text-white text-decoration-none hover-link">Registrarse</a>
        </div>
    </div>
</header>

<!-- Contenido principal para mostrar el pokemon -->
<div class="container">
    <form action="" method="post" class="search-form">
        <input type="text" name="busqueda" placeholder="Buscar Pokemon por nombre, tipo o numero">
        <button type="submit">Buscar</button>
        <button><a href="index.php" class="text-decoration-none text-white">Limpiar</a></button>
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
            echo "<img src='" . $fila["Imagen"] . "' alt='Pokemon' style='max-width:100%; max-height:100%; padding: 10px;'>";
            echo "</a>";
            echo "<div class='w3-container mb-3'>";
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
