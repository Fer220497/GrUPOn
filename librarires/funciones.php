<?php


/*
 * Esta funcion genera un login en forma de string
 */
function formularioLogin() {

            $form = ' <form action="" method="post">' .
                    ' Correo: <input type="text" name="correo" >' .
                    ' Contraseña: <input type="password" name="contraseña" >' .
                    ' <input type="submit" name="login" value="Enviar">' .
                    ' </form>' ;
            return $form;
        }
        
        

        
    ?>