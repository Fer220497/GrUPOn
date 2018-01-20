/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 
   <style>
            .tab-content {
                display: none;
               
            }

            .tab-content.current {
                display: inherit;
            }
        </style>
 * 
 */
/*
function previewProducto($result) {
    $productos = 1;
    $numpaginas=1;
    $str = '<div class="w3-container w3-white w3-border w3-round w3-section tab-content current" id="tab-'.$numpaginas.'"  >';
    while ($fila = mysqli_fetch_array($result)) {
        $productos++;
        $numpaginas=1;
        if ($productos == 11) {
            $productos = 0;
            $numpaginas++;
            $str .= '</div>';
            $str .= '<div class="w3-container w3-white w3-border w3-round w3-section tab-content" id="tab-'.$numpaginas.'" >';
        }//productos
            $str .= '<div class="w3-container w3-center w3-section w3-border w3-border-white w3-hover-border-blue w3-third"><a href="producto.php?id=' . $fila["id_producto"] . '")" >';
            $p_desc = (100 - $fila["porcentaje_descuento"]) * $fila["precio"] / 100;
            $str .= '<div class="w3-container"><div class="zoom"><img class="w3-image" src="' . '../imagenesSubidas/' . $fila['ruta_imagen'] . '"alt="' . $fila["nombre"] . '"/></div></div>' .
                    '<div class="w3-container"><div class="w3-container"><span style="font-weight: bold">' . $fila["nombre"] . ' </span><span class="w3-tag w3-small w3-padding w3-red" style="transform:rotate(-5deg)">-' . $fila["porcentaje_descuento"] . '%</span></div>' .
                    '<div class="w3-container"><span style="text-decoration: line-through">' . $fila["precio"] . '&euro;</span><span style="font-weight: bold"> ' . $p_desc . '&euro;</div></div>';
            $str .= '</a></div>';
        
    }
    $str .= '</div>';
    $i=1;   
    $str .= '<ul class="tabs">';
    $str .= '<li class="tab-link current" data-tab="tab-'.$i.'">'.$i.'</li>';
    $i=2;
    while($i<=$numpaginas){
            $str .= '<li class="tab-link" data-tab="tab-'.$i.'">'.$i.'</li>';
         $i++;
    }
    $str .='</ul>';
    return $str;
}




 <script>
            $(document).ready(function () {
                var $paginas = $('div.pagina').hide();

                $paginas.eq(0).show();

                $('ul.tabs li').click(function () {
                    var $tab_id = $(this).attr('data-tab');
                   
                    $('ul.tabs li').removeClass('current');
                    $('.tab-content').removeClass('current');

                    $(this).addClass("current");
                    $("#" + $tab_id).addClass("current");
                });




                // $('button.paginacion').pagina();
                $('.zoom').zoom();

            });
        </script>




/*
 function validaSoloTexto(cadena) {
 var patron = /^[a-zA-Z]+$/;
 
 if (cadena.val().length == 0) {
 cadena.css("background-color", "red");
 } else {
 if (cadena.val().match(patron))
 cadena.css("background-color", "blue");
 else
 cadena.css("background-color", "red");
 }
 }
 function validaAltura(altura) {
 
 if (altura.val().length == 0) {
 altura.css("background-color", "red");
 }
 
 if (validaSoloNumerico(altura.val()) == true) {
 if (altura.val() > 100 && altura.val() < 299) {
 altura.css("background-color", "blue");
 } else {
 altura.css("background-color", "red");
 }
 } else {
 altura.css("background-color", "red");
 }
 }
 
 function validaSoloNumerico(cadena) {
 var patron = /^[0-9]+$/;
 
 if (cadena.length == 0) {
 return false;
 }
 
 if (cadena.match(patron))
 return true
 else
 return false;
 }
 
 function validaPagWeb(cadena) {
 var patron = /^paginaWeb.com\//;
 
 if (cadena.val().length == 0) {
 cadena.css("background-color", "red");
 }
 if (cadena.val().match(patron))
 cadena.css("background-color", "blue");
 else
 cadena.css("background-color", "red");
 }
 
 function validaTelefono(cadena) {
 var patron = /^[6][0-9]{8}$/;
 
 if (cadena.val().length == 0) {
 cadena.css("background-color", "red");
 }
 
 if (cadena.val().match(patron))
 cadena.css("background-color", "blue");
 else
 cadena.css("background-color", "red");
 }
 */

      