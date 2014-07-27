$(document).ready(function() {
	
	//Enviar Nuevo correo
	$('#btn_Correo').click(function(){
		$("#cargando").animate({'width': '100%'},2000);
		var nombres=$('#correo_nombres').val();
		var apellidos=$('#correo_apellidos').val();
		var correo=$('#correo_correo').val();
		var telefono=$('#correo_telefono').val();
		var comentario=$('#correo_comentario').val();
		var archivos = document.getElementById("correo_hoja");
		var archivo = archivos.files;
		var data = new FormData();
		for(i=0; i<archivo.length; i++){
			data.append('archivo'+i,archivo[i]);	
		}
		data.append('nombres',nombres);
		data.append('apellidos',apellidos);
		data.append('correo',correo);
		data.append('telefono',telefono);
		data.append('comentario',comentario);
		
		if (nombres && apellidos && correo && telefono && comentario && archivo) {
			$.ajax({
				url:'php/correo.php?id=send', 
				type:'POST', 
				contentType:false, 
				data:data,
				processData:false, 
				cache:false 
			}).done(function(msg){
				$('.mensaje').html(msg).fadeIn().fadeOut(6000);
				$("#cargando").animate({'width': '0%'},2000);
					$('#correo_nombres').val("");
					$('#correo_apellidos').val("");
					$('#correo_correo').val("");
					$('#correo_telefono').val("");
					$('#correo_comentario').val("");
					$('#correo_hoja').val("");
			});
		}else{
			$('.mensaje').html('Llena todo correctamente').fadeIn().fadeOut(4000);
		};
	});
});