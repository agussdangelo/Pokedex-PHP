<?php
session_start();

if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    unset($_SESSION['resultadoBusqueda']);
    unset($_SESSION['errorBusqueda']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css"
        integrity="sha512-CWXb9sx63+REyEBV/cte+dE1hSsYpJifb57KkqAXjsN3gZQt6phZt7e5RhgZrUbaNfCdtdpcqDZtuTEB+D3q2Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Panel de usuario</title>
</head>

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
                        <?php if(isset($_SESSION['usuario'])){
                                echo "<h2 class='h3 text-white text-center pe-2'>Hola,". htmlspecialchars($_SESSION['usuario'])."!</h2> ";
                                echo "<a class='btn btn-secondary' href='logout.php'>Cerrar sesión</a>";
                            
                            }else{
                                header('Location: ../../index.php');
                                exit;
                            }       
                        ?> <!--Checkea pregunta si existe la variable-->
                        
                        
                    </div>

                </div>
                <div class="w-100">
                    <form action="" method="post" class="d-flex">
                        <input id="busqueda" name ="busqueda" class="form-control me-2" type="text" placeholder="Ingrese el nombre, tipo o numero de pokemon..." aria-label="Search">
                        <button class="btn btn-secondary my-1 my-sm-0" style="padding: 4px 7px;" type="submit">Que es este pokemon?</button>
                        
                    </form>
                </div>
            </div>
        </nav>
    </header>

<body>
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
                    require_once 'tablaTipos.php';
                    require_once 'ListadoPokemon.php';
                    require_once 'obtenerPokemonesDB.php';
                    //var_dump($_SESSION['resultadoBusqueda'] );
                    
                    $pokemonesAMostrar= [];

                    if(isset($_SESSION['resultadoBusqueda']) && !empty($_SESSION['resultadoBusqueda'])) {
                        $pokemonesAMostrar= $_SESSION['resultadoBusqueda'];
                        unset($_SESSION['errorBusqueda']);    
                        
                    }else{
                        $pokemones_db = obtenerPokemonesDB();
                        $pokemonesAMostrar = [];
                        
                        while($fila = mysqli_fetch_array($pokemones_db)) {
                            $pokemonesAMostrar[] = $fila;
                        }
                    }
                    foreach($pokemonesAMostrar as $fila){
                        echo '<div class="row">';
                        echo '<div class="col" style = "width: 10%; height:20%">';
                        echo "<img src='/Pokedex-PHP/public" . $fila["Imagen"] . "' alt='Pokemon' style='height: 10em;;'>";
                        echo '</div>';
                        echo '<div class="col">';
                        tablaTipos($fila['Tipo']);
                        echo '</div>';
                        echo '<div class="col">'.$fila['Numero'].'</div>';
                        echo '<div class="col">'.$fila['Nombre'].'</div>';
                        echo '<div class="col">'.$fila['Descripcion'].'</div>';
                        echo '<div class="col">';
                        echo '<button type="button" class="btn btn-danger me-1 btn-eliminar-pokemon" data-bs-toggle="modal" data-bs-target="#confirmarEliminarModal" data-pokemon-id="' . $fila['Identifcador'] . '" data-pokemon-nombre="' . htmlspecialchars($fila['Nombre']) . '">Eliminar</button>';
                        echo '<a href="crear-pokemon.php?id=' . $fila['Identifcador'] . '&nombre=' . urlencode($fila['Nombre']) . '&tipo=' . urlencode($fila['Tipo']) . '&numero=' . $fila['Numero'] . '&descripcion=' . urlencode($fila['Descripcion']) . '&imagen=' . urlencode($fila['Imagen']) . '" class="btn btn-dark">Editar</a>';
                        echo'</div>';
                        echo '</div>';
                    }
                    
                    
                    if(isset($_SESSION['errorBusqueda'])) {
                        echo $_SESSION['errorBusqueda'];
                        
                    }


                    ?>
                </div>
                <a class="btn btn-lg btn-danger w-100" href="crear-pokemon.php">Nuevo pokemon</a>
    
            </div>
        </div>
    </main>
    <div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar a <span id="pokemon-a-eliminar"></span>? Esta acción es irreversible.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="#" id="enlace-eliminar" class="btn btn-danger">Eliminar</a>
      </div>
    </div>
  </div>
</div>

<script>
  const botonesEliminar = document.querySelectorAll('.btn-eliminar-pokemon');
  const enlaceEliminar = document.getElementById('enlace-eliminar');
  const nombrePokemonEliminar = document.getElementById('pokemon-a-eliminar');

  botonesEliminar.forEach(boton => {
    boton.addEventListener('click', function() {
      const pokemonId = this.dataset.pokemonId;
      const pokemonNombre = this.dataset.pokemonNombre;
      enlaceEliminar.href = 'eliminar-pokemon.php?id=' + pokemonId;
      nombrePokemonEliminar.textContent = pokemonNombre;
    });
  });
</script>
    <script>
       const inputBusqueda = document.getElementById('busqueda');

        inputBusqueda.addEventListener('input', function(){
            if(this.value === ''){
                window.location.href = 'home.php?reset=1';
            }
        });

    </script>
</body>
</html>