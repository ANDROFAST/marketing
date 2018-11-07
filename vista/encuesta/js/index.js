$(document).ready(function(){
    $('#formulario').css('opacity',0.4).hover(function(){
      $(this).fadeTo(200,1);
   }, function(){
      $(this).fadeTo(200,0.4);
   });
   
   $("#registrar").click(function(){  
        $(".error").fadeOut().remove();
	var validar = true;	
        
        if ($("#nombre").val() === "") {  
            $("#nombre").focus().after('<span class="error">Ingrese su nombre</span>');  
            validar = false;  
        }  
        if ($("#apeP").val() === "") {  
                                $("#apeP").focus().after('<span class="error">Ingrese su apellido paterno</span>');  
            validar = false;  
        }  
        if ($("#apeM").val() === "") {  
            $("#apeM").focus().after('<span class="error">Ingrese su apellido materno</span>');   
            validar = false;  
        } 
        if (!$('input[name="sexo"]').is(':checked')){
            $("#sexo").focus().after('<span class="error">Seleccione su sexo</span>');   
            validar = false;  
        }
        if ($("#usuario").val() === "") {  
            $("#usuario").focus().after('<span class="error">Ingrese su usuario</span>');   
            validar = false;  
        }
        if ($("#contrasena").val() === "") {  
            $("#contrasena").focus().after('<span class="error">Ingrese su contraseña</span>');   
            validar = false;  
        }
        if ($("#contrasenah").val() === "") {  
            $("#contrasenah").focus().after('<span class="error">Ingrese nuevamente su contraseña</span>');   
            validar = false;  
        }
        return validar;
    });
   
    $("#nombre, #apeP, #apeM, #usuario, #contrasena, #contrasenah").bind('blur keyup', function(){  
        if ($(this).val() !== "") {  			
            $('.error').fadeOut();
            return false;  
        }
    });
});

function ocultarMensaje(){
    $('.error').fadeOut();
}

function redireccionar(){
    window.location= 'login.php';
}

function soloNumeros(e) {
	tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla === 0) {
		return true;
	}
	if (tecla === 8) {
		return true;
	}
	if (tecla === 46) {
		return true;
	}
	if (tecla === 44) {
		return true;
	}
	if (tecla === 40) {
		return true;
	}
	if (tecla === 41) {
		return true;
	}
	if (tecla === 180) {
		return true;
	}
	if (tecla === 193) {
		return true;
	}
	if (tecla === 201) {
		return true;
	}
	if (tecla === 205) {
		return true;
	}
	if (tecla === 211) {
		return true;
	}
	if (tecla === 218) {
		return true;
	}
	if (tecla === 225) {
		return true;
	}
	if (tecla === 233) {
		return true;
	}
	if (tecla === 237) {
		return true;
	}
	if (tecla === 243) {
		return true;
	}
	if (tecla === 250) {
		return true;
	}
	patron = /[0-9\s]/; // 4
	te = String.fromCharCode(tecla); // 5

	return patron.test(te); // 6
}

function soloLetras(e) {
	tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla === 0) {
		return true;
	}
        if (tecla === 8) {
		return true;
	}
	if (tecla === 46) {
		return true;
	}
	if (tecla === 44) {
		return true;
	}
	if (tecla === 40) {
		return true;
	}
	if (tecla === 41) {
		return true;
	}
	if (tecla === 180) {
		return true;
	}
	if (tecla === 193) {
		return true;
	}
	if (tecla === 201) {
		return true;
	}
	if (tecla === 205) {
		return true;
	}
	if (tecla === 211) {
		return true;
	}
	if (tecla === 218) {
		return true;
	}
	if (tecla === 225) {
		return true;
	}
	if (tecla === 233) {
		return true;
	}
	if (tecla === 237) {
		return true;
	}
	if (tecla === 243) {
		return true;
	}
	if (tecla === 250) {
		return true;
	}
	patron = /[A-Za-zñÑ\s]/; // 4
	te = String.fromCharCode(tecla); // 5

	return patron.test(te); // 6
}