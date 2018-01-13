<?php
require_once '../back-end/conexion_db.php';
require_once '../back-end/funciones.php';

if(isset($_POST['enviado'])){
    if(!isset($_POST['comentario'])){
        $error[] = 'Tienes que enviar comentario';
    }
    if(!isset($_POST['valoracion'])){
        $error[] = 'Tienes que valorar el producto';
    }
    if(!isset($error)){
        if(strlen($_POST['comentario']) > 5000){
            $error[] = 'Comentario demasiado largo';
        }
        if($_POST['valoracion'] < 0 || $_POST['valoracion'] > 5){
            $error[] = 'La puntuacion no es valida';
        }
        $comment = filter_var($_POST['comentario'],FILTER_SANITIZE_STRING);
        $number = filter_var($_POST['valoracion'], FILTER_VALIDATE_INT);
        $number = filter_var($_POST['valoracion'], FILTER_SANITIZE_NUMBER_INT);
        if(!isset($error)){
            $comment = sanitarString($comment);
            $number = sanitarString($number);
            $query = "INSERT INTO comentarios VALUES ('".$_COOKIE['productoVisitado']
                    ."','".$_SESSION['cuenta']."','".$comment."','".$number."')";
            realizarQuery($esquema, $query);
            header('Location:producto.php');
        }
    }
}

if(isset($error)){
    echo muestraErrores($error);
}

?>