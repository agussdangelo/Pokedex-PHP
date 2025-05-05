<?php

function obtenerTiposPokemones(){

    $ruta_config = dirname(dirname(__DIR__)) . "/repo/config.ini";
    $config = parse_ini_file($ruta_config);
    //$config = parse_ini_file("/Pokedex-PHP/repo/config.ini");

    var_dump($ruta_config);
    
    //conectarnos
    $database = mysqli_connect(
                                $config["host"],
                                $config["user"],
                                $config["pass"],
                                $config["db"],
                                $config["puerto"]) or die("Error al conectar con la base de datos");//recomendable manejar errores para que no se cierre a lo brusco

    //obtener datos
    $sql = "SELECT * FROM tipo";

    $datos =mysqli_query($database, $sql); 

    return $datos;
}