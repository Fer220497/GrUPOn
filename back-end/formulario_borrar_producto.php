<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    if(isset($_POST['borrar']) && isset($_POST['check'])){
        $id = null; //HAY QUE ENCONTRAR UNA FORMA DE OBTENER EL ID DEL PRODUCTO
        $sql = "DELETE FROM PRODUCTOS WHERE PRODUCTO_ID=$id";
        realizarQuery('grupon', $sql);  //OP DELETE SOBRE CUENTA, CLIENTE Y EMPRESA
        //header('Location: ../back-end/logout.php'); LLEVALRO AL MENU PRINCIPAL?
    }
    
    echo muestraProducto(1);
    
    /**
     * Muestra el producto pasado por referencia
     */
    function muestraProducto($id){
        global $arrayComunidades;
        global $arrayCategorias;
        $query = "SELECT * FROM PRODUCTO WHERE ID_PRODUCTO='$id'";
        $result = realizarQuery('grupon', $query);
        $fila = mysqli_fetch_array($result);
        $table = '<table border="1">'
                . '<tr>'
                . '<td>'.$fila['nombre'].'</td></tr>'
                . '<tr><td>Descripci&oacute;n: '.$fila['descripcion'].'</td></tr>'
                . '<tr><td>Descuento: '.$fila['porcentaje_descuento'].'%</td><td>Precio: '.$fila['precio'].'&euro;</td><td>Unidades Restantes:'.$fila['cantidad_disponible'].'</td></tr>'
                . '<tr><td>Categor&iacute;a: '.$arrayCategorias[$fila['nombre_categoria']].'</td><td>Ofertado en: '.$arrayComunidades[$fila['nombre_ca']].'</td></tr>';
        return $table;
    }
    
    /**
     * Muestra el botón de borrar
     * @return string
     */
    function muestraFormularioBorrar(){
        return '<form action="" method="post">
                    <input type="submit" name="borrar" value="Borrar Producto"/> Marcar si est&aacute;s seguro de que quieres borrrar la cuenta <input type="checkbox" name="check" value="Borrar"/>
                </form>';
        
    }
?>
