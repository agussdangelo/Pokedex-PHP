<?php
 //testeando
 /*require_once 'obtenerTiposPokemones.php';
 $tipo_pokemones_db = obtenerTiposPokemones();
var_dump($tipo_pokemones_db);*/
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/POKEDEX-PHP/public/css/style-crear-pokemon.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/zephyr/bootstrap.min.css"
    integrity="sha512-CWXb9sx63+REyEBV/cte+dE1hSsYpJifb57KkqAXjsN3gZQt6phZt7e5RhgZrUbaNfCdtdpcqDZtuTEB+D3q2Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Document</title>
</head>

<body class="min-vh-100 bg-light">
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
            <input class="form-control me-2" type="search" placeholder="Ingrese el nombre, tipo o numero de pokemon..."
              aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Que es este pokemon?</button>
          </form>
        </div>
      </div>
    </nav>
  </header>


  <div class="container-fluid d-flex   justify-content-center bg-light">
    <div class="card shadow-lg w-75 mt-3">
      <div class="row g-0">
        <!-- Left side align-items-center-->
        <div
          class="col-md-5 left-panel d-flex flex-column justify-content-center align-items-center text-white text-center">
          <img id="previewImage" src="#" alt="Image Preview" class="img-thumbnail mt-3"
            style="max-width: 300px; display: none;">
        </div>

        <!-- Right side -->
        <div class="col-md-7 p-5">

          <h4 class="mb-3">Crear un nuevo pokemon</h4>

          <form method="post" action="procesar-creacion-pokemon.php" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-md-12">
                <label for="numero" class="form-label mt-2">Numero identificador</label>
                <input type="number" name="numero" class="form-control" placeholder="Numero identificador">
              </div>

              <div class="col-md-12">
                <label for="nombreUsuario" class="form-label mt-2">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
              </div>

              <div class="col-md-12">
                <label for="exampleSelect1" class="form-label mt-2">Tipo de pokemon</label>
                <select class="form-select" id="exampleSelect1" name="tipo_pokemon">
                  <option value="" disabled selected>Seleccione un tipo de pokemon</option>
                  <?php
                  require_once 'obtenerTiposPokemones.php';
                  $tipo_pokemones_db = obtenerTiposPokemones();

                  while($fila = mysqli_fetch_array($tipo_pokemones_db)){
                    echo "<option value=".$fila['Identificador'].">".$fila['Nombre']."</option>";
                  }

                  ?>
                
                </select>
              </div>
            </div>

            <div>
              <label for="exampleTextarea" class="form-label mt-2">Descrpcion</label>
              <textarea class="form-control" name="descripcion" id="exampleTextarea" rows="3"></textarea>
            </div>

            <div class="col-md-12">
              <label for="formFile" class="form-label mt-2">Imagen del pokemon</label>
              <input class="form-control" type="file" name="img_pokemon" id="formFile" accept="image/*">
            </div>

            <button type="submit" class="btn btn-danger w-100 mt-3 py-2">Dar de alta</button>

          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Optional: Bootstrap Icons CDN (for Facebook/Twitter icons) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <script>
    /*Para previsualizar imagen elegida */
    document.getElementById('formFile').addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const previewImage = document.getElementById('previewImage');
          previewImage.src = e.target.result;
          previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>


</html>