<?php
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    $correo = $_SESSION['cuenta'];
    if($_SESSION['tipo'] === 'cliente'){
        $sql = "SELECT * FROM CUENTA,CLIENTE WHERE CUENTA.CORREO='$correo' AND CLIENTE.CORREO='$correo'";
        $result = realizarQuery('grupon', $sql);
        $filas = mysqli_fetch_array($result);
        echo muestraDatosCliente($filas);
    }else{
        $sql = "SELECT * FROM CUENTA,EMPRESA WHERE EMPRESA.CORREO='$correo' AND CUENTA.CORREO='$correo'";
        $result = realizarQuery('grupon', $sql);
        $filas = mysqli_fetch_array($result);
        echo muestraDatosEmpresa($filas);
    }
    
    if(isset($_POST['borrar'])){
        
    }

    /**
     * Muestra los datos del cliente.
     * @param type $arrayClientes
     */
    function muestraDatosCliente($arrayClientes){
        
    }
    
    /**
     * Muestra los datos de la empresa
     * @param type $arrayEmpresas
     */
    function muestraDatosEmpresa($arrayEmpresas){
        
    }
    
    /**
     * Muestra el botón de borrar
     * @return string
     */
    function muestraFormulario(){
        return '<form action="" method="post">
                    <input type="submit" name="borrar" vale="Borrar Cuenta"/>
                </form>';
        
    }

?>

