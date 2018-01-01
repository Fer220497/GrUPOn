<?php
    require_once '../back-end/libs/recaptchalib.php';
    require_once '../back-end/conexion_db.php';
    require_once '../back-end/funciones.php';
    
    if(isset($_POST['login'])){
        
    }else{
        echo formularioLogin();
    }
    
    /**
    * Esta funcion genera un login en forma de string
    * @return string
    */
   function formularioLogin() {

       global $recaptcha;

       $form = ' <form action="" method="post">' .
               ' Correo: <input type="text" name="correo" /><br/>' .
               ' Contrase&ntilde;a: <input type="password" name="pwd" /><br/>' .
               $recaptcha .
               ' <input type="submit" name="login" value="Enviar"/>' .
               ' </form>';
       return $form;
   }

?>