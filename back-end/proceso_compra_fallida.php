<?php

require_once '../back-end/lectura_producto.php';

/**
 * Función que devuelve el mensaje de fallo al finalizar la compra.
 * @return string
 */
function pagoFallido() {
   return ' <div class="w3-jumbo w3-panel w3-pale-red w3-leftbar w3-border-red">
  <p>Lo sentimos, el pago no se ha realizado con &eacute;xito :(</p>
</div> ';
}