<?php

session_start();

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if (isset($_POST['busqueda'])) {
    if(!isset($_POST['nombre'])){
        $errores[] = 'Debes introducir nombre';
    }
    if(!isset($errores)){
        $nombre = $_POST['nombre'];
        $sql = 'SELECT * FROM PRODUCTO WHERE nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%"';
        $result = realizarQuery("grupon", $sql);
        $result = mysqli_fetch_array($result);
        echo 'Hay ' . count($result) . 'coincidencias';
    }
}
if (!isset($_POST['busqueda']) || isset($errores)){
    if(isset($errores)){
        muestraErrores($errores);
    }
    echo formularioBusquedaProducto();
}

function formularioBusquedaProducto() {
    $form = '<form actrion="" method="post">' .
            '<input type="text" name="nombre"/>' .
            '<input type="submit" value="Buscar" name="busqueda"/>' .
            '</form>';
    
    return $form;
}
