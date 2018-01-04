<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    $correo = $_SESSION['cuenta'];
    
    if(isset($_POST['borrar']) && isset($_POST['check'])){
            $sql = "DELETE FROM CUENTA WHERE CORREO='$correo'";
            realizarQuery('grupon', $sql);  //OP DELETE SOBRE CUENTA, CLIENTE Y EMPRESA
            header('Location: ../back-end/logout.php');
        }
    
    
    /**
     * Muestra el botón de borrar
     * @return string
     */
    function muestraFormularioBorrar(){
        return '<form action="" method="post">
                    <input type="submit" name="borrar" value="Borrar Cuenta"/> Marcar si est&aacute;s seguro de que quieres borrrar la cuenta <input type="checkbox" name="check" value="Borrar"/>
                </form>';
        
    }

?>

