/**
 * Recibe un id y un string de la siguiente forma 1,2,3,4
 * Añade el id al final
 * @param string $id
 * @param string $carritoActual
 * @return string
 */

function iniciarCarrito() {
    //añadir // en caso de querer reiniciar con el login
    //if (getCookie("carrito")=="") {
        setCookie("carrito", "", 1);
    //}
    setCookie("categoria", "general", 1);
}
function addCarrito(id, carritoActual) {
    var var_string = id;
    alert("Valor del id producto" + var_string);
    var valueofCarrito = getCookie("carrito");
    alert("Valor actual del carrito" + valueofCarrito);
    if (valueofCarrito == "") {
        setCookie("carrito", var_string, 1);
    } else {

        var array = getCookie("carrito").split(",");
        array.push(id);
        var string = array.join();
        var cookie_name = "carrito";
        setCookie(cookie_name, string, 1);

    }

}
/**
 * Recibe un id y un string de la siguiente forma 1,2,3,4
 * Elimina el id
 * @param string $id
 * @param string $carritoActual
 * @return string
 */
function removeCarrito(index) {
    alert("Eliminar producto numero ".concat(index, " del array"));
    var carritoActual = getCookie("carrito");
    var array = carritoActual.split(",");
    array.splice(index, 1);
    array = array.join();

    var cookie_name = "carrito";
    setCookie(cookie_name, array, 1);
    /*
     array.splice(index,1);
     alert(array);
     var string = array.join();
     var cookie_name = "carrito";
     setCookie(cookie_name, string, 1);*/
    location.reload();
}
function setCookie(cname, cvalue, exdays) {

    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

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

function checkCookie() {
    var valueofCarrito = getCookie("carrito");
    if (valueofCarrito != "") {

    } else {

    }
    
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