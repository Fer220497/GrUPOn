/**
 * Setea las cookies del carrito
 */
function iniciarCarrito() {
    //añadir // en caso de querer reiniciar con el login
    if (getCookie("carrito") == "") {
        setCookie("carrito", "", 1);
    }
}

/**
 * Añade un producto según el id dado al carrito.
 * @param int id
 * @param int cantidadDisponible
 */
function addCarrito(id, cantidadDisponible) {
    if(getCookie(id) == ""){
        setCookie(id, 0, 1); 
    } 
    if(getCookie("carrito") == ""){
        setCookie("carrito", id, 1);
        setCookie(id, 1, 1);
        var bloqueHTML = '<div class="w3-panel w3-green w3-display-container">' +
            '<span onclick="this.parentElement.style.display=\'none\'"' +
            'class="w3-button w3-red w3-large w3-display-topright">&times;</span>' +
            '<h1>&iexcl;Se ha a&ntilde;adido el producto correctamente!</h1></div>';  
    }else{
        cantidadActual = getCookie(id);
        cantidadActualInt = parseInt(cantidadActual);
        cantidadActualInt += 1;
        if(cantidadActualInt > parseInt(cantidadDisponible)){
            var bloqueHTML = '<div class="w3-panel w3-red w3-display-container">' +
                '<span onclick="this.parentElement.style.display=\'none\'"' +
                'class="w3-button w3-red w3-large w3-display-topright">&times;</span>' +
                '<h1>&iexcl;No hay tanta cantidad disponible!</h1></div>'    
        }else{
            var array = getCookie("carrito").split(",");
            array.push(id);
            var string = array.join();
            var cookie_name = "carrito";
            setCookie(cookie_name, string, 1);
            setCookie(id, cantidadActualInt, 1);

            var bloqueHTML = '<div class="w3-panel w3-green w3-display-container">' +
            '<span onclick="this.parentElement.style.display=\'none\'"' +
            'class="w3-button w3-red w3-large w3-display-topright">&times;</span>' +
            '<h1>&iexcl;Se ha a&ntilde;adido el producto correctamente!</h1></div>';  
        }
    }
    $('.contenedorProducto').append(bloqueHTML);

}

/**
 * Recibe un id y un string de la siguiente forma 1, 2, 3, 4
 * Elimina el id
 * @param string $id
 * @param string $carritoActual
 * @return string
 */
function removeCarrito(index) {
    var carritoActual = getCookie("carrito");
    var array = carritoActual.split(",");
    var idProducto = array[index];
    array.splice(index, 1);
    array = array.join();
    
    var cookie_name = "carrito";
    setCookie(cookie_name, array, 1);
    
    cantidadProducto = getCookie(idProducto);
    cantidadProductoInt = parseInt(cantidadProducto);
    cantidadProductoInt--;
    setCookie(idProducto, cantidadProductoInt, 1);
    location.reload();
}

/**
 * Setea una cookie con los parámetros dados.
 * @param string cname
 * @param int cvalue
 * @param int exdays
 */
function setCookie(cname, cvalue, exdays) {

    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/**
 * Devuelve el valor de una cookie.
 * @param string cname
 * @return string
 */
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

categorias = {viajes: "Viajes",
    entretenimiento: "Entretenimiento",
    gastronomia: "Gastronomía",
    electronica: "Electrónica",
    ropa: "Ropa",
    salud_y_belleza: "Salud y belleza",
    deporte: "Deporte",
    general: "General",
};

categoriasLogged = {viajes: "Viajes",
    entretenimiento: "Entretenimiento",
    gastronomia: "Gastronomía",
    electronica: "Electrónica",
    ropa: "Ropa",
    salud_y_belleza: "Salud y belleza",
    deporte: "Deporte",
    general: "General",
    tus_gustos: "Tus Gustos"
};