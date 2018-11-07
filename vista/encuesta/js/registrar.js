$(document).ready(function(){
    ocultarMensaje();
   $("#registrar").click(function(){  
        $(".error").fadeOut().remove();
	var validar = true;	
        
        if ($("#perfiles").val() === "0") {  
            $("#perfiles").focus().after('<span class="error">Seleccione un perfil</span>');  
            validar = false;  
        } 
        if ($("#descripcion").val() === "") {  
            $("#descripcion").focus().after('<span class="error">Ingrese una pregunta</span>');   
            validar = false;  
        } 
        return validar;
    });
   
    $("#descripcion").bind('blur keyup', function(){  
        if ($(this).val() !== "") {  			
            $('.error').fadeOut();
            return false;  
        }
    });
    
    $("#perfiles").bind( "click", function() {
        if ($(this).val() !== "0") {  			
            $('.error').fadeOut();
            return false;  
        }
    });
});

function ocultarMensaje(){
    $('.error').fadeOut();
}

function regresar(valor){
    if(valor === 1){
        window.location= 'registrar.php';
    }else if(valor === 2){
        window.location= 'panelControl.php';
    }
}