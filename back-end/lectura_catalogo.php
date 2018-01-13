<?php
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';


    function mostrarCatalogo($id){
        global $esquema;
        global $arrayCategorias;
        $html="";
        $sql = "SELECT * FROM catalogo WHERE id_catalogo='$id'";
        $result = realizarQuery($esquema, $sql);
        $fila = mysqli_fetch_array($result);
        $html .= '<table border="1"><tr><td>Nombre: '.$fila['nombre'].'</td><td>Categor&iacute;a: '.$arrayCategorias[$fila['nombre_categoria']].'</td></tr></table>';
        
        $sql="SELECT * FROM producto WHERE id_catalogo='$id'";
        $result = realizarQuery($esquema, $sql);
        /**
        $html.='<table border="1">';
        while($fila = mysqli_fetch_array($result)){
            $html.='<tr><td><a href="producto.php" onclick="setCookie(\'' . $cookie_name . '\',\'' . $fila[0] . '\',1)">'
                    . '<img src="'.$fila["ruta_imagen"].'" alt="'.$fila["nombre"].'"></a></td></tr>'
                    . '<tr><td><a href="producto.php" onclick="setCookie(\'' . $cookie_name . '\',\'' . $fila[0] . '\',1)">'.$fila["nombre"].'</a></td></tr>';
        }
        $html.='</table>';
        **/
        $html .= previewProducto($result);
        return $html;
    }
?>

