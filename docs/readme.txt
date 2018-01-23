===============================================================================================================
   _____ _____  _    _ _____   ____  _   _  
  / ____|  __ \| |  | |  __ \ / __ \| \ | | 
 | |  __| |__) | |  | | |__) | |  | |  \| | 
 | | |_ |  _  /| |  | |  ___/| |  | | . ` | 
 | |__| | | \ \| |__| | |    | |__| | |\  | 
  \_____|_|  \_\\____/|_|     \____/|_| \_|

Created by: Fernando Sánchez de Nieva Fernández, Juan Manuel Ucero Calderón & Pedro Zamorano Camacho
===============================================================================================================

INFORME DE LA APLICACIÓN: https://docs.google.com/document/d/1uhwpkJr2B1blhWr6guJHVvxbJwJG1qhRnoXy6_ffQFE/edit?usp=sharing

VISIÓN ORIGINAL DEL PROYECTO:
Ususario se registra y define sus gustos y dice la ciudad donde vive. Para confirmar el registro usa un captcha.
Cookies para ver a qué categorías entra más el usuario para luego mostrar en la página principal ofertas en su ciudad y ordenadas por afinidad.
Los usuarios recibirán correos diarios sobre las ofertas de las categorías que le interesan en su ciudad.
Un usuario puede convertirse en usuario empresa desde el menú de opciones del usuario.
Para ello, nosotros deberiamos controlar si puede o no convertirse en empresa. Por defecto, se le dará luz verde para convertirse en empresa.
Una vez una cuenta gana el status de empresa, tiene una variable de sesión que demuestra que es empresa.
Una cuenta empresa puede publicar ofertas. Para ello, debe tener puesto primero en la configuración el lugar de la empresa mediante google maps
y su link payme de paypal.

LINKS QUE NOS HAN AYUDADO A CREAR ESTE PROYECTO:
Carrito: https://www.uno-de-piera.com/carrito-de-compras-con-php/

Paypal: https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/buy_now_step_1/

Google Maps: https://stackoverflow.com/questions/5757533/allowing-users-to-add-markers-to-google-maps-and-getting-the-coordinates

Maps: https://developers.google.com/maps/documentation/javascript/examples/place-search

Añadir recaptcha: https://webdesign.tutsplus.com/es/tutorials/how-to-integrate-no-captcha-recaptcha-in-your-website--cms-23024

Keys recaptcha de testeo:

    Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
    Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
