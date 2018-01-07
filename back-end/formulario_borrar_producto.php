<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    if(isset($_POST['borrar']) && isset($_POST['check'])){
        $id = $_COOKIE['productoVisitado'];
        $sql = "DELETE FROM lanzamientos WHERE id_producto=$id";
        realizarQuery($esquema, $sql);  //OP DELETE SOBRE CUENTA, CLIENTE Y EMPRESA
        $sql = "DELETE FROM producto WHERE id_producto=$id";
        realizarQuery($esquema, $sql);  //OP DELETE SOBRE CUENTA, CLIENTE Y EMPRESA
        header('Location: ../front-end/index.php');
    }
    
    /**
     * Muestra el botón de borrar
     * @return string
     */
    function muestraFormularioBorrar(){
        return '<form action="../back-end/formulario_borrar_producto.php" method="post">
                    <input type="submit" name="borrar" value="Borrar Producto"/> Marcar si est&aacute;s seguro de que quieres borrar el producto <input type="checkbox" name="check" value="Borrar"/>
                </form>';
        
    }
?>
