<?php

session_start();

require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

echo formularioBusquedaProducto() . '<br/>';

if (isset($_POST['busqueda'])) {
    if (!isset($_POST['nombre'])) {
        $errores[] = 'Debes introducir nombre';
    }
    if (!isset($errores)) {
        $nombre = $_POST['nombre'];
        $sql = 'SELECT * FROM PRODUCTO WHERE nombre LIKE "%' . $nombre . '%" OR descripcion LIKE "%' . $nombre . '%"';
        $result = realizarQuery("grupon", $sql);
        echo '<table border=1>';
        while ($fila = mysqli_fetch_row($result)) {
            echo '<tr><td>' . $fila[4] . '</td><td>' . $fila[6] . '</tr>';
        }
        echo '</table>';
    }
}
if (isset($errores)) {
    muestraErrores($errores);
}

function formularioBusquedaProducto() {
    $form = '<form actrion="" method="post">' .
            '<input type="text" name="nombre"/>' .
            '<input type="submit" value="Buscar" name="busqueda"/>' .
            '</form>';

    return $form;
}
