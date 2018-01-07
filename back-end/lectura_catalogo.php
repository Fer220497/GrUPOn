<?php
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';


    function mostrarCatalogo(){
        $id=$_COOKIE["catalogoVisitado"];
        global $esquema;
        global $arrayCategorias;
        $sql = "SELECT * FROM CATALOGO WHERE ID_CATALOGO='$id'";
        $result = realizarQuery($esquema, $sql);
        $fila = mysqli_fetch_array($result);
        $table = '<table border="1"><tr><td>Nombre: '.$fila['nombre'].'</td><td>Categor&iacute;a: '.$arrayCategorias[$fila['nombre_categoria']].'</td></tr></table>';
        return $table;
    }
?>

