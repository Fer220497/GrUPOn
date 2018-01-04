<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    if(isset($_POST['borrar']) && isset($_POST['check'])){
        $id = null; //HAY QUE ENCONTRAR UNA FORMA DE OBTENER EL ID DEL CATALOGO
        $sql = "DELETE FROM CATALOGO WHERE CATALOGO_ID=$id";
        realizarQuery('grupon', $sql);  //OP DELETE SOBRE
        //header('Location: ../back-end/logout.php'); LLEVALRO AL MENU PRINCIPAL?
    }
    
    echo mostrarCatalogo(1);
    echo muestraFormularioBorrar();

    function muestraFormularioBorrar(){
        return '<form action="" method="post">
                    <input type="submit" name="borrar" value="Borrar Cat&aacute;logo"/> Marcar si est&aacute;s seguro de que quieres borrrar el cat&aacute;logo <input type="checkbox" name="check" value="Borrar"/>
                </form>';
        
    }
    
    function mostrarCatalogo($id){
        global $arrayCategorias;
        $sql = "SELECT * FROM CATALOGO WHERE ID_CATALOGO='$id'";
        $result = realizarQuery('grupon', $sql);
        $fila = mysqli_fetch_array($result);
        $table = '<table border="1"><tr><td>Nombre: '.$fila['nombre'].'</td><td>Categor&iacute;a: '.$arrayCategorias[$fila['nombre_categoria']].'</td></tr></table>';
        return $table;
    }
    
?>