<?php 
    
    // ?? si esta variable no esta defiinida se define con un  string vacio cero''
    $nombre = $_POST['nombre'] ?? '';
    $archivo = $_POST['archivo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';


    $respuesta=[];
    $bandera= true;


    if($nombre == ''){
        $respuesta += ['nombre' => 'Ingrese un nombre al proyecto'];
        $bandera= false;
    }

    if($bandera){

    }
    
    json_encode($respuesta);
?>