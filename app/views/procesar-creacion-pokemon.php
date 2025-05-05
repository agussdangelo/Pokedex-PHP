<?php
//tomar los datos del formulario de crear pokemon
if(isset($_POST['numero'])){
    $numero = $_POST['numero'];

    echo $numero;
}

if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
    echo $nombre;
}

if(isset($_POST['tipo_pokemon'])){
    $tipo = $_POST['tipo_pokemon'];
    echo $tipo;
}

if(isset($_POST['descripcion'])){
    $descripcion = $_POST['descripcion'];
    echo $descripcion;
}


define('PROJECT_ROOT', dirname(dirname(__DIR__)));

if (isset($_FILES['img_pokemon']) && $_FILES['img_pokemon']['error'] == UPLOAD_ERR_OK) {
    $nombreTemporal = $_FILES['img_pokemon']['tmp_name'];
    $nombreFinal = basename($_FILES['img_pokemon']['name']);

    $rutaCarpetaImg = PROJECT_ROOT . '/public/img';
    $destino_fisico = $rutaCarpetaImg . '/' . $nombreFinal; // Ruta física para guardar
    $destino_web = '/Pokedex-PHP/public/img/' . $nombreFinal;   // Ruta web para mostrar

    var_dump($destino_fisico); //testeando

    if (!is_dir($rutaCarpetaImg)) {
        if (mkdir($rutaCarpetaImg, 0777, true)) {
            echo "Carpeta '" . htmlspecialchars($rutaCarpetaImg) . "' creada.<br>";
        } else {
            echo "Error al crear la carpeta '" . htmlspecialchars($rutaCarpetaImg) . "'. Asegúrate de tener permisos en el directorio padre.<br>";
        }
    }

    if (move_uploaded_file($nombreTemporal, $destino_fisico)) {
        /*echo "Imagen subida exitosamente: <a href='" . htmlspecialchars($destino_web) . "'>" . htmlspecialchars($nombreFinal) . "</a>";
        echo "<br><img src='" . htmlspecialchars($destino_web) . "' style='max-width:300px'>";*/
        $url_img ='/img'.'/'.$nombreFinal;

    } else {
        echo "Hubo un error al mover la imagen al destino físico: " . htmlspecialchars($destino_fisico);
    }
} else {
    echo "No se subió ninguna imagen o hubo un error en la subida. Error code: " . ($_FILES['img_pokemon']['error'] ?? 'Desconocido');
}

//guardar en la bbdd
$ruta_config = dirname(dirname(__DIR__)) . "/repo/config.ini";
    $config = parse_ini_file($ruta_config);
    //$config = parse_ini_file("/Pokedex-PHP/repo/config.ini");

    //var_dump($ruta_config);
    
    //conectarnos
    $database = mysqli_connect(
                                $config["host"],
                                $config["user"],
                                $config["pass"],
                                $config["db"],
                                $config["puerto"]) or die("Error al conectar con la base de datos");//recomendable manejar errores para que no se cierre a lo brusco

    $nombreSeguro = mysqli_real_escape_string($database, $nombre);
    $numeroSeguro = mysqli_real_escape_string($database, $numero);
    $tipoSeguro = mysqli_real_escape_string($database, $tipo);
    $descripcionSeguro = mysqli_real_escape_string($database, $descripcion);

    //insertar datos
    $sql = "INSERT INTO pokemon (Numero, Imagen, Nombre, Tipo, Descripcion) VALUES ('$numeroSeguro','$url_img','$nombreSeguro','$tipoSeguro','$descripcionSeguro')";

     


    if (mysqli_query($database, $sql)) {
        // La URL a la que quieres redirigir
        $url_destino = "/Pokedex-PHP/app/views/home.php";
        
        // Realizar la redirección
        header("Location: " . $url_destino);
        exit(); //detener la ejecución del script actual

        /*echo "Pokemon guardado exitosamente.";
        $ultimo_id = mysqli_insert_id($database);
        echo " ID del nuevo registro: " . $ultimo_id;*/
    } else {
        echo "Error al guardar el pokemon: " . mysqli_error($database);
    }