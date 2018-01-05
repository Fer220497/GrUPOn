/**
 * Recibe un id y un string de la siguiente forma 1,2,3,4
 * Añade el id al final
 * @param string $id
 * @param string $carritoActual
 * @return string
 */
function addCarrito(id, carritoActual){
    var array = carritoActual.split(",");
    array.push(id);
    var string = array.join();
    return string;
}
/**
 * Recibe un id y un string de la siguiente forma 1,2,3,4
 * Elimina el id
 * @param string $id
 * @param string $carritoActual
 * @return string
 */
function removeCarrito(id, carritoActual){
    array = carritoActual.split(",");
    var i = array.indexOf(id);
    if(i != -1) {
        array.splice(i, 1);
    }
    var string = array.join();
    return string;
}