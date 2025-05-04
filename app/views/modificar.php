<?php
if(isset($_POST['nombre']) && isset($_POST['numero']) && isset($_POST['tipo']) && isset($_POST['descripcion'])) {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
}else{
    $error = "No se han recibido los datos del Pokemon";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Pokemon</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/css/style.css">
    <style>
        .form-container {
            margin-top: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input[type=text] {
            width: 100%;
            padding: 10px;
            margin: 6px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .form-container button:hover {
            opacity: 0.8;
        }
        .header-logo {
            height: 100px;
        }
    </style>
</head>
<body>

<header>
    <img src="../../public/img/logo.png" alt="Logo" class="header-logo">
    <a href="../../index.php" class="text-decoration-none text-white"><h1>POKÉDEX</h1></a>

    <form action="" method="POST" class="login-form">
        <label><b>Usuario</b></label>
        <input type="text" name="username" placeholder="Ingrese su nombre de usuario">
        <label><b>Contraseña</b></label>
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <button type="submit">Iniciar Sesión</button>
        <?php
        require_once '../../../login.php';

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
    <div class="w3-container">
        <div class="w3-margin-top">
            <div class="form-container">
                <h2>Modificar Pokemon</h2>
                <p>Datos actuales del Pokemon:</p>
                <form action="actualizar_pokemon.php" method="post" enctype="multipart/form-data">
                    <label for="nombre">Nombre:</label>
                    <input type="hidden" name="nombre" value="<?php if(isset($_POST['nombre'])){ echo $nombre; } ?>">
                    <input type="text" name="nombre" value="<?php if(isset($_POST['nombre'])){ echo $nombre; } ?>" disabled>
                    <label for="numero">Numero:</label>
                    <input type="hidden" name="numero" value="<?php if(isset($_POST['numero'])){ echo $numero; } ?>">
                    <input type="text" name="numero" value="<?php if(isset($_POST['numero'])){ echo $numero; }  ?>" disabled>
                    <label for="tipo">Tipo:</label>
                    <input type="hidden" name="tipo" value="<?php if(isset($_POST['tipo'])){echo $tipo;} ?>">
                    <input type="text" name="tipo" value="<?php if(isset($_POST['tipo'])){echo $tipo;}  ?>" disabled>
                    <label for="descripcion">Descripcion:</label>
                    <input type="hidden" name="descripcion" value="<?php if(isset($_POST['descripcion'])){echo $descripcion;}?>">
                    <input type="text" name="descripcion" value="<?php if(isset($_POST['descripcion'])){echo $descripcion;}?>" disabled>

                    <p>Modifica los datos del Pokemon:</p>
                    <label for="nuevo_nombre">Nuevo Nombre:</label>
                    <input type="text" name="nuevo_nombre" REQUIRED>
                    <label for="nuevo_numero">Nuevo Numero:</label>
                    <input type="text" name="nuevo_numero" REQUIRED>
                    <label for="nuevo_tipo">Nuevo Tipo:</label>
                    <select name="nuevo_tipo" id="nuevo_tipo">
                        <option value="1">Normal</option>
                        <option value="2">Fuego</option>
                        <option value="3">Agua</option>
                        <option value="4">Planta</option>
                        <option value="5">Electrico</option>
                        <option value="6">Hielo</option>
                        <option value="7">Lucha</option>
                        <option value="8">Veneno</option>
                        <option value="9">Tierra</option>
                        <option value="10">Volador</option>
                        <option value="11">Psiquico</option>
                        <option value="12">Bicho</option>
                        <option value="13">Roca</option>
                        <option value="14">Fantasma</option>
                        <option value="15">Dragon</option>
                        <option value="16">Siniestro</option>
                        <option value="17">Acero</option>
                        <option value="18">Hada</option>
                    </select>
                    <br>
                    <label for="nueva_descripcion">Nueva Descripcion:</label>
                    <input type="text" name="nueva_descripcion" REQUIRED>
                    <label for="nueva_imagen">Nueva Imagen:</label>
                    <input type="file" name="nueva_imagen" accept="image/*" REQUIRED>
                    <button type="submit">Guardar Cambios</button>

                </form>
                <form action="eliminar_pokemon.php" method="post">
                    <input type="hidden" name="nombre" value="<?php echo $nombre;?>">
                    <input type="hidden" name="numero" value="<?php echo $numero;?>">
                    <button type="submit" id="eliminar-pokemon" style="background-color: #af4c4c">Eliminar Pokemon</button>
                </form>

                <?php
                    if(isset($error)) {
                    echo "<p style='color: red'>$error</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>






