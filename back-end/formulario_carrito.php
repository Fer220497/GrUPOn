<?php
    require_once '../back-end/funciones.php';
    
    if(isset($_POST['borraCarrito'])){
        $carrito = $_COOKIE['carrito'];
        if(!isset($_POST['id_prod'])){
            $error[] = 'Has trampeado el formulario';
        }else{
            if(!in_array($_POST['id_prod'],$carrito)){
                $error[] = 'Has trampeado el carrito';
            }
        }
        if(!isset($error)){
            $carrito = array_diff($carrito, [$POST['id_prod']]);
            setcookie('carrito',$carrito,60*60*24*30);
            header('carrito.php');
        }
    }
    function borrarProductoCarrito($id_prod){
        global $error;
        if(isset($error)){
            echo muestraErrores($error);
        }
        $form = '<form method="post" action="">'
                . '<input type="hidden" name="id_prod" value="'.$id_prod.'"/>'
                . '<input type="submit" value="Borrar" name="borraCarrito"/></form>';
        return $form;
    }
?>