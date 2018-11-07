$(document).ready(function(){
   $("#entrar").click(function(){  
        $(".error").fadeOut().remove();
	var validar = true;	
        
        if ($("#usuario").val() === "") {  
            $("#usuario").focus().after('<span class="error">Ingrese su usuario</span>');   
            validar = false;  
        }
        if ($("#contrasena").val() === "") {  
            $("#contrasena").focus().after('<span class="error">Ingrese su contraseña</span>');   
            validar = false;  
        }
        return validar;
    });
   
    $("#usuario, #contrasena").bind('blur keyup', function(){  
        if ($(this).val() !== "") {  			
            $('.error').fadeOut();
            return false;  
        }
    });
});

function ocultarMensaje(){
    $('.error').fadeOut();
}