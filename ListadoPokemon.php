<?php

if(isset($_POST["busqueda"])){
    unset($_SESSION['errorBusqueda']);
    $conexion = mysqli_connect("localhost", "root", "", "pokedex pw2");

    if(!$conexion){
        die("Conexion fallida: " . mysqli_connect_error());
    }

    $busqueda = $_POST["busqueda"];
    $error = "<p style='color: red'>No se encontraron resultados para la busqueda: " . $busqueda . "</p>" . "<br>";

    if(is_string($busqueda) && !is_numeric($busqueda)){
        $resultado = mysqli_query($conexion, "SELECT * FROM POKEMON WHERE Nombre LIKE '%$busqueda%' ORDER BY Numero ASC ");
    }else{
        $resultado = mysqli_query($conexion, "SELECT * FROM POKEMON WHERE Numero = '$busqueda' ORDER BY Numero ASC");
    }

    if (mysqli_num_rows($resultado) == 0){
        $_SESSION['errorBusqueda'] = $error;
    }


    $_SESSION['resultadoBusqueda'] = array();
    while($fila = mysqli_fetch_assoc($resultado)){
        $_SESSION['resultadoBusqueda'][] = $fila;
    }
}else{

    $conexion = mysqli_connect("localhost", "root", "", "pokedex pw2");


    if(!$conexion){
        die("Conexion fallida: " . mysqli_connect_error());
    }

    $resultado = mysqli_query($conexion, "SELECT * FROM pokemon ORDER BY Numero ASC");

    $_SESSION['resultadoBusqueda'] = array();
    while($fila = mysqli_fetch_assoc($resultado)){
        $_SESSION['resultadoBusqueda'][] = $fila;
    }
}