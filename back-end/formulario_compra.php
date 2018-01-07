<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    if(isset($_POST['compra'])){
        
    }
    function mostrarFormularioCompra(){
        $form = '<form method="post" action=""><input type="submit" value="Comprar" name="compra"/></form>';
    }

?>
