
function listar(){
    $.post(
            "../controlador/usuario.listar.controlador.php"
        ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $("#tabla-listado").dataTable();
            });
}

function cargarComboPersonal(){
    $("#cbopersonal").load("../controlador/combo.personal.controlador.php?modal=no");
};

$(document).ready(function(){
    listar();
    cargarComboPersonal();
 
});

function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo usuario");
    $("#txttipooperacion").val("agregar");
    $("#txtcodigo_usuario").val("");    
    $("#cbopersonal").val("");     
    $("#txtcontrasenna").val(""); 
    $("#opcion_estado").val("");   
    $('#cbopersonal').prop('class', 'form-control');
    $('#per').prop('class', 'show');
    $("#txtcontrasenna").prop('placeholder', 'contraseña');                
    $("#txtcontrasenna").removeClass('required');                
};


$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento

   swal({
		title: "Está seguro de grabar los datos?",
		text: "Confirme",		
                showCancelButton: true,
                confirmButtonColor: "#009688",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                closeOnConfirm: false,    		
                imageUrl: "../img/swa/pregunta.png"
	},
	function(isConfirm){
            if (isConfirm){
   
                $.post(
                        "../controlador/usuario.agregar-editar.controlador.php",
                         {
                             p_datos_formulario: $("#frmgrabar").serialize()
                         }
                     ).done(function(resultado){

                        if(resultado==="exito"){
                            listar();
                            swal("Éxito!", "Se ha grabado correctamente!", "success");
                            $("#btncerrar").click();
                            location.reload();
                        }

                     }).fail(function(error){
                         alert(error.responseText);
                     });
        
            }
	});
   
});


function editar(codigo){
    $("#myModalLabel").empty().append("Editar datos del usuario");
    $("#txttipooperacion").val("editar");
    
    
    $.post(
            "../controlador/usuario.leer-datos.controlador.php",
            {
                p_codigo : codigo
            }
            ).done(function(resultado){                
                var datos = $.parseJSON(resultado);
                $("#txtcodigo_usuario").val(datos.codigo_usuario);
               // $("#cbopersonal").val(datos.dni_usuario);              
                $('#cbopersonal').prop('class', 'hidden');                
                $('#per').prop('class', 'hidden');
              //  $("#txtcontrasenna").val(datos.clave);                
                $("#txtcontrasenna").prop('placeholder', 'Ingresa la nueva contraseña');                
                $("#opcion_estado").val(datos.estado);                
                $("#txtcontrasenna").prop('required', '');                
                
            }).fail(function(error){
                alert(error.responseText);
            });
};

function eliminar(codigo){

      swal({
		title: "Está seguro de dar de baja al registro?",
		text: "Confirme",		
                showCancelButton: true,
                confirmButtonColor: "#009688",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                closeOnConfirm: false,    		
                imageUrl: "../img/swa/pregunta.png"
	},
	function(isConfirm){
            if (isConfirm){
                    $.post(
                            "../controlador/usuario.eliminar.controlador.php",
                            {
                                p_codigo_usuario : codigo
                            }
                        ).done(function(resultado){
                            if (resultado==="exito"){               
                                listar();
                                swal("Éxito!", 'El estado del usuario cambio a "INACTIVO".', "success");
                            }
                        }).fail(function(error){
                            alert(error.responseText);
                        });
                        
            }
	});
}

