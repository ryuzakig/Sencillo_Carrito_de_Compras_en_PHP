<?php

	/* Recepcionamos los datos enviados asincrónicamente */
	
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$sitio = $_POST['sitio'];
	$mensaje = $_POST['mensaje'];
	
	/* Definimos el correo donde enviaremos el mensaje y el asunto */
	
	$destino = "sau.1519@gmail.com";
	$asunto = "Contacto sitio Web";
	
	/* Definimos el formato del mensaje a enviar */
	
	$cuerpo = "<strong>Nombre: </strong>".$nombre."<br />
			   <strong>Correo: </strong>".$correo."<br />
			   <strong>Sitio Web: </strong>".$sitio."<br />
			   <strong>Mensaje: </strong>".$mensaje;
	
	/* Definimos las cabeceras del mensaje */
	
	$cabecera = "MIME-Version: 1.0\r\n";
	$cabecera .= "Content-type:text/html; charset=iso-8859-1\r\n";
	$cabecera .= "From: $correo\r\n";
	$cabecera .= "Reply-to: $correo\r\n";
	$cabecera .= "Cc: $correo\r\n";
	
	/* Enviamos vía correo, devolviendo un mensaje en caso de éxito o falla */ 
	
	if(mail($destino, $asunto, $cuerpo, $cabecera)) {
		echo 'Su mensaje ha sido enviado. De ser necesario, nos pondremos en contacto con Ud.';
	}
	else {
		echo 'No se pudo enviar el mensaje. Int&eacute;ntelo nuevamente';
	}
	
	
	
?>