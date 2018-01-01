Ususario se registra y define sus gustos y dice la ciudad donde vive. Para confirmar el registro usa un captcha.
Cookies para ver a qué categorías entra más el usuario para luego mostrar en la página principal ofertas en su ciudad y ordenadas por afinidad.
Los usuarios recibirán correos diarios sobre las ofertas de las categorías que le interesan en su ciudad.
Un usuario puede convertirse en usuario empresa desde el menú de opciones del usuario.
Para ello, nosotros deberiamos controlar si puede o no convertirse en empresa. Por defecto, se le dará luz verde para convertirse en empresa.
Una vez una cuenta gana el status de empresa, tiene una variable de sesión que demuestra que es empresa.
Una cuenta empresa puede publicar ofertas. Para ello, debe tener puesto primero en la configuración el lugar de la empresa mediante google maps
y su link payme de paypal.

Carrito: https://www.uno-de-piera.com/carrito-de-compras-con-php/

Paypal: https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/buy_now_step_1/

Google Maps: https://stackoverflow.com/questions/5757533/allowing-users-to-add-markers-to-google-maps-and-getting-the-coordinates

Maps: https://developers.google.com/maps/documentation/javascript/examples/place-search

Añadir recaptcha: https://webdesign.tutsplus.com/es/tutorials/how-to-integrate-no-captcha-recaptcha-in-your-website--cms-23024

Combo provincias España:

    <select name="provincia">
    	<option value='0'>(Seleccionar)</option>
    	<option value='2'>Ãlava</option>
    	<option value='3'>Albacete</option>
    	<option value='4'>Alicante/Alacant</option>
    	<option value='5'>AlmerÃ­a</option>
    	<option value='6'>Asturias</option>
    	<option value='7'>Ãvila</option>
    	<option value='8'>Badajoz</option>
    	<option value='9'>Barcelona</option>
    	<option value='10'>Burgos</option>
    	<option value='11'>CÃ¡ceres</option>
    	<option value='12'>CÃ¡diz</option>
    	<option value='13'>Cantabria</option>
    	<option value='14'>CastellÃ³n/CastellÃ³</option>
    	<option value='15'>Ceuta</option>
    	<option value='16'>Ciudad Real</option>
    	<option value='17'>CÃ³rdoba</option>
    	<option value='18'>Cuenca</option>
    	<option value='19'>Girona</option>
    	<option value='20'>Las Palmas</option>
    	<option value='21'>Granada</option>
    	<option value='22'>Guadalajara</option>
    	<option value='23'>GuipÃºzcoa</option>
    	<option value='24'>Huelva</option>
    	<option value='25'>Huesca</option>
    	<option value='26'>Illes Balears</option>
    	<option value='27'>JaÃ©n</option>
    	<option value='28'>A CoruÃ±a</option>
    	<option value='29'>La Rioja</option>
    	<option value='30'>LeÃ³n</option>
    	<option value='31'>Lleida</option>
    	<option value='32'>Lugo</option>
    	<option value='33'>Madrid</option>
    	<option value='34'>MÃ¡laga</option>
    	<option value='35'>Melilla</option>
    	<option value='36'>Murcia</option>
    	<option value='37'>Navarra</option>
    	<option value='38'>Ourense</option>
    	<option value='39'>Palencia</option>
    	<option value='40'>Pontevedra</option>
    	<option value='41'>Salamanca</option>
    	<option value='42'>Segovia</option>
    	<option value='43'>Sevilla</option>
    	<option value='44'>Soria</option>
    	<option value='45'>Tarragona</option>
    	<option value='46'>Santa Cruz de Tenerife</option>
    	<option value='47'>Teruel</option>
    	<option value='48'>Toledo</option>
    	<option value='49'>Valencia/ValÃ©ncia</option>
    	<option value='50'>Valladolid</option>
    	<option value='51'>Vizcaya</option>
    	<option value='52'>Zamora</option>
    	<option value='53'>Zaragoza</option>
    </select>
    $provincias = array(
    		'2' =>'&Aacute;lava',
    		'3' =>'Albacete',
    		'4' =>'Alicante/Alacant',
    		'5' =>'Almer&iacute;a',
    		'6' =>'Asturias',
    		'7' =>'&Aacute;vila',
    		'8' =>'Badajoz',
    		'9' =>'Barcelona',
    		'10' =>'Burgos',
    		'11' =>'C&aacute;ceres',
    		'12' =>'C&aacute;diz',
    		'13' =>'Cantabria',
    		'14' =>'Castell&oacute;n/Castell&oacute;',
    		'15' =>'Ceuta',
    		'16' =>'Ciudad Real',
    		'17' =>'C&oacute;rdoba',
    		'18' =>'Cuenca',
    		'19' =>'Girona',
    		'20' =>'Las Palmas',
    		'21' =>'Granada',
    		'22' =>'Guadalajara',
    		'23' =>'Guip&uacute;zcoa',
    		'24' =>'Huelva',
    		'25' =>'Huesca',
    		'26' =>'Illes Balears',
    		'27' =>'Ja&eacute;n',
    		'28' =>'A Coru&ntilde;a',
    		'29' =>'La Rioja',
    		'30' =>'Le&oacute;n',
    		'31' =>'Lleida',
    		'32' =>'Lugo',
    		'33' =>'Madrid',
    		'34' =>'M&aacute;laga',
    		'35' =>'Melilla',
    		'36' =>'Murcia',
    		'37' =>'Navarra',
    		'38' =>'Ourense',
    		'39' =>'Palencia',
    		'40' =>'Pontevedra',
    		'41' =>'Salamanca',
    		'42' =>'Segovia',
    		'43' =>'Sevilla',
    		'44' =>'Soria',
    		'45' =>'Tarragona',
    		'46' =>'Santa Cruz de Tenerife',
    		'47' =>'Teruel',
    		'48' =>'Toledo',
    		'49' =>'Valencia/Val&eacute;ncia',
    		'50' =>'Valladolid',
    		'51' =>'Vizcaya',
    		'52' =>'Zamora',
    		'53' =>'Zaragoza'
    		);
