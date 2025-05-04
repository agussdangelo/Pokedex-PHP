<?php
/*session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /POKEDEX-PHP/index.php');
    exit;
}*/
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css"
        integrity="sha512-CWXb9sx63+REyEBV/cte+dE1hSsYpJifb57KkqAXjsN3gZQt6phZt7e5RhgZrUbaNfCdtdpcqDZtuTEB+D3q2Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Panel de Usuario</title>
</head>

<body>
    <!--<h1>Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsuario']) ?>!</h1>-->
    <header>
        <nav class="navbar bg-dark" data-bs-theme="dark">
            <div class="container-fluid mt-2">
                <div class="d-flex justify-content-between  w-100 mb-4">
                    <div class="d-flex align-items-center me-2  ">
                        <img src="/POKEDEX-PHP/public/assets/pokebola.png" alt="pokebola" width="44" height="44" class="me-2">
                        <img src="/POKEDEX-PHP/public/assets/pokemon_logo.svg" alt="titulo-pokemon" height="44" class="me-2">
                    </div>
                    <h1 class="h2 text-white text-center m-0 ps-5 pe-5">Pokedex</h1>
                    <div class="d-flex justify-content-around w-30">
                        <h2 class="h3 text-white text-center pe-2">Admin</h2>
                        <a class="btn btn-secondary " href="logout.php">Cerrar sesión</a>
                    </div>

                </div>
                <div class="w-100">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search"
                            placeholder="Ingrese el nombre, tipo o numero de pokemon..." aria-label="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Que es este pokemon?</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="card border-danger mt-3 container d-flex justify-content-center align-items-center"
            style="max-width: 80%;">

            <div class="card-body w-100">
                <div class="table table-hover col-5 mx-auto mt-1 w-100">
                    <div class="row">
                        <div class="col">Imagen</div>
                        <div class="col">Tipo</div>
                        <div class="col">Numero</div>
                        <div class="col">Nombre</div>
                        <div class="col">Descripcion</div>
                        <div class="col">Acciones</div>
                    </div>
                    <?php 
                    define('PROJECT_ROOT', dirname(dirname(__DIR__)));
                    require_once PROJECT_ROOT . '/tablaTipos.php';
                    require_once 'obtenerPokemonesDB.php';
                    $pokemones_db = obtenerPokemonesDB();
                    while($fila = mysqli_fetch_array($pokemones_db)){
                        echo '<div class="row">';
                        echo '<div class="col" style = "width: 10%; height:20%">';
                        echo "<img src='/Pokedex-PHP" . $fila["Imagen"] . "' alt='Pokemon' style='height: 10em;;'>";
                        echo '</div>';
                        echo '<div class="col">';
                        tablaTipos($fila['Tipo']);
                        echo '</div>';
                        echo '<div class="col">'.$fila['Numero'].'</div>';
                        echo '<div class="col">'.$fila['Nombre'].'</div>';
                        echo '<div class="col">'.$fila['Descripcion'].'</div>';
                        echo '<div class="col">';
                        echo '<button type="button" class="btn btn-danger me-1">Eliminar</button>';
                        echo '<button type="button" class="btn btn-dark">Editar</button>';
                        echo'</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <a class="btn btn-lg btn-danger w-100" href="crear-pokemon.php">Nuevo pokemon</a>
    
            </div>
        </div>
    </main>


</body>

</html>