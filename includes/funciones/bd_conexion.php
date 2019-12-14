<?php
    $host = '127.0.0.1';
    $usuario = 'root';
    $contraseña = '';
    $base_datos = 'gdlwebcamp';

    $conexion = new mysqli($host,$usuario,$contraseña,$base_datos);

    if($conexion->connect_error){
        echo $error->$conexion->connect_error;
    }
?>