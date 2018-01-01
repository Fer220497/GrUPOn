<?php
        /**
         * Función que genera un HTML con un array de errores 
         * (el array de errores debe contener unicamente strings)
         * @param string $error
         * @return string
         */
        function muestraErrores($error){
            $bloqueHTML = '<div class="error"><h1>Se han producido los siguientes errores:</h1><ul>';
            foreach($error as $err){
                $bloqueHTML .= "<li>$err</li>";
            }
            $bloqueHTML .= '</ul></div>';
            return $bloqueHTML;          
        }
        


        /**
         * Esta funcion genera un login en forma de string
         * @return string
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