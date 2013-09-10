$(function(){
	
	var valor;
	var i = 0;
	
	$('#nombre').focus(function(){
		
		$('#resultado-nombre').remove();
		$('#validar-nombre').append('<p class="advertencia">* Obligatorio</p>');
		
	});
	
	$('#nombre').blur(function(){
		
		$('.advertencia').remove();
		
		valor = $('#nombre').val();
		
		if(valor != '') {
			$('<img src="imagenes/accept.png" id="resultado-nombre" />').appendTo('#validar-nombre');
		}
		else {
			$('<img src="imagenes/delete.png" id="resultado-nombre" />').appendTo('#validar-nombre');
		}
		
	});
	
	$('#correo').focus(function(){
		
		$('#resultado-correo').remove();
		$('#validar-correo').append('<p class="advertencia">* Obligatorio</p>');
		
	});
	
	$('#correo').blur(function(){
		
		$('.advertencia').remove();
		
		valor = $('#correo').val();
		
		if(valor != '') {
			
			if(validaCorreo(valor)){
				
				$('<img src="imagenes/accept.png" id="resultado-correo" />').appendTo('#validar-correo');
			
			}
			else {
				$('<span id="resultado-correo">Correo no valido</span>').appendTo("#validar-correo");
			}
		}
		else {
			$('<img src="imagenes/delete.png" id="resultado-correo" />').appendTo('#validar-correo');
		}
		
	});
	
	$('#sitio').focus(function(){
		
		$('#validar-sitio').append('<p class="advertencia">* Opcional</p>');
		
	});
	
	$('#sitio').blur(function(){
		
		$('.advertencia').remove();
		
	});
	
	$('#mensaje').focus(function(){
		
		$('#resultado-mensaje').remove();
		$('#validar-mensaje').append('<p class="advertencia">* Obligatorio</p>');
		
	});
	
	$('#mensaje').blur(function(){
		
		$('.advertencia').remove();
		
		valor = $('#mensaje').val();
		
		if(valor != '') {
			$('<img src="imagenes/accept.png" id="resultado-mensaje" />').appendTo('#validar-mensaje');
		}
		else {
			$('<img src="imagenes/delete.png" id="resultado-mensaje" />').appendTo('#validar-mensaje');
		}
		
	});
	
	$('#enviar').click(function(){
		
		if($('#nombre').val()!= '' && $('#correo').val()!='' && $('#mensaje').val()!='') {
			
			$('.advertencia').remove();
			
			$('#envio').append('<img src="imagenes/ajax-loader.gif" alt="Procesando envio" id="cargando" />');
			
			var nombre = $('#nombre').val();
			var correo = $('#correo').val();
			var sitio = $('#sitio').val();
			var mensaje = $('#mensaje').val();
			
			$.ajax({
				url: 'envio.php',
				type: 'POST',
				data: 'nombre=' + nombre + '&correo=' + correo + '&sitio=' + sitio + '&mensaje=' + mensaje,
				
				success: function(resultado) {
					$('#respuesta').remove();
					$('#envio').append('<span id="respuesta">' + resultado + '</span>');
					$('#cargando').fadeOut(500, function() {
						$(this).remove();
					});
					
				}
			});
			
			return false;
		
			
		}
		else {
			$('#envio').append('<span class="advertencia">Debe completar los datos requeridos.</span>');
			return false;
		}
		
	});
	
	
});

function validaCorreo(correo) {
	
	var expresion = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return expresion.test(correo);

}