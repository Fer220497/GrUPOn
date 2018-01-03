<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';

    $correo = $_SESSION['cuenta'];

    //Primero traemos los datos del cliente de la DB
    $sql = "SELECT * FROM CUENTA,CLIENTE WHERE CUENTA.CORREO='$correo' AND CLIENTE.CORREO='$correo'";

    $resultado = realizarQuery('grupon', $sql);
    $fila = mysqli_fetch_array($resultado);
    
    $nombre = $fila['nombre_cliente'];
    $apellidos = $fila['apellidos_cliente'];
    
    


?>