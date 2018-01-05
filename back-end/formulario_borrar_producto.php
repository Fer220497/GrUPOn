<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    if(isset($_POST['borrar']) && isset($_POST['check'])){
        $id = $_SESSION['id_producto_borrar'];
        unset($_SESSION['id_producto_borrar']);
        $sql = "DELETE FROM PRODUCTOS WHERE PRODUCTO_ID=$id";
        realizarQuery($esquema, $sql);  //OP DELETE SOBRE CUENTA, CLIENTE Y EMPRESA
        //header('Location: ../back-end/logout.php'); LLEVALRO AL MENU PRINCIPAL?
    }
    
    /**
     * Muestra el botón de borrar
     * @return string
     */
    function muestraFormularioBorrar(){
        return '<form action="" method="post">
                    <input type="submit" name="borrar" value="Borrar Producto"/> Marcar si est&aacute;s seguro de que quieres borrar el producto <input type="checkbox" name="check" value="Borrar"/>
                </form>';
        
    }
?>
