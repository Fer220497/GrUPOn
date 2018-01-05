<?php
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

    /**
     * Muestra el producto pasado por referencia
     */
    function muestraProducto($id){
        global $esquema;
        global $arrayComunidades;
        global $arrayCategorias;
        $query = "SELECT * FROM PRODUCTO WHERE ID_PRODUCTO='$id'";
        $result = realizarQuery($esquema, $query);
        $fila = mysqli_fetch_array($result);
        $table = '<table border="1">'
                . '<tr>'
                . '<td>'.$fila['nombre'].'</td></tr>'
                . '<tr><td>Descripci&oacute;n: '.$fila['descripcion'].'</td></tr>'
                . '<tr><td>Descuento: '.$fila['porcentaje_descuento'].'%</td><td>Precio: '.$fila['precio'].'&euro;</td><td>Unidades Restantes:'.$fila['cantidad_disponible'].'</td></tr>'
                . '<tr><td>Categor&iacute;a: '.$arrayCategorias[$fila['nombre_categoria']].'</td><td>Ofertado en: '.$arrayComunidades[$fila['nombre_ca']].'</td></tr>';
        return $table;
    }
    
?>
