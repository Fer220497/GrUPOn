<?php
    require_once '../back-end/funciones.php';
    //setcookie('carrito','1,2,3',time()+ 60*60*24*30);
    
    if(isset($_POST['borraCarrito'])){
        $carrito = explode(',',$_COOKIE['carrito']);
        if(!isset($_POST['id_prod'])){
            $error[] = 'Has trampeado el formulario';
        }else{
            if(!in_array($_POST['id_prod'],$carrito)){
                $error[] = 'Has trampeado el carrito';
            }
        }
        if(!isset($error)){
            $carrito = array_diff($carrito, [$_POST['id_prod']]);
            $string = implode(',', $carrito);
            setcookie('carrito',$string,60*60*24*30);
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