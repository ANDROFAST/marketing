function listar(){
    $.post(
            "../controlador/personal.listar.controlador.php"
        ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $("#tabla-listado").dataTable();
            });
}

function cargarComboCargo(){
    $("#txtcodigo_cargo").load("../controlador/combo.cargos.controlador.php?modal=no");    
};

function cargarComboArea(){
    $("#txtcodigo_area").load("../controlador/combo.areas.controlador.php?modal=no");    
};

function cargarComboJefe(){
    /*
    var to=$("#txttipooperacion").val();
    var dni=$("#txtdni_personal").val();
    console.log(to);        
    if(to==="editar"){
        $("#txtjefe").load("../controlador/combo.jefes-editar.controlador.php?modal=no&dni="+codigo+"");    
    }
    if(to==="agregar"){
        $("#txtjefe").load("../controlador/combo.jefes.controlador.php?modal=no");    
    }
    */
     $("#txtjefe").load("../controlador/combo.jefes.controlador.php?modal=no");    
};

function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo personal");
    $("#txttipooperacion").val("agregar");
    $("#txtdni_personal").val("");    
    $("#txtapellido_paterno").val("");     
    $("#txtapellido_materno").val("");     
    $("#txtnombres").val("");     
    $("#txtdireccion").val("");     
    $("#txttelefono_fijo").val("");     
    $("#txtemail").val("");     
    $("#txttelefono_movil1").val("");     
    $("#txttelefono_movil2").val("");     
    $("#txtestado_personal").val("");     
    $("#txtcodigo_cargo").val("");     
    $("#txtjefe").val("");     
    $("#txtcodigo_area").val("");       
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
                imageUrl: "../imagenes/pregunta.png"
	},
	function(isConfirm){
            if (isConfirm){
   
                $.post(
                        "../controlador/personal.agregar-editar.controlador.php",
                         {
                             p_datos_formulario: $("#frmgrabar").serialize()
                         }
                     ).done(function(resultado){

                        if(resultado==="exito"){
                            listar();
                            swal("Éxito!", "Se ha grabado correctamente!", "success");
                            $("#btncerrar").click();
                        }

                     }).fail(function(error){
                         alert(error.responseText);
                     });
        
            }
	});
   
});


function editar(codigo){
    $("#myModalLabel").empty().append("Editar datos del personal");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/personal.leer-datos.controlador.php",
            {
                p_codigo : codigo
            }
            ).done(function(resultado){                
                var datos = $.parseJSON(resultado);                  
                $("#txtdni_personal").val(datos.dni);    
                $("#txtapellido_paterno").val(datos.apellido_paterno);     
                $("#txtapellido_materno").val(datos.apellido_materno);     
                $("#txtnombres").val(datos.nombres);     
                $("#txtdireccion").val(datos.direccion);     
                $("#txttelefono_fijo").val(datos.telefono_fijo);     
                $("#txtemail").val(datos.email);     
                $("#txttelefono_movil1").val(datos.telefono_movil1);     
                $("#txttelefono_movil2").val(datos.telefono_movil2);     
                $("#txtestado_personal").val(datos.estado);                
                $("#txtcodigo_cargo").val(datos.codigo_cargo); 
                $("#txtjefe").val(datos.dni_jefe); 
                $("#txtcodigo_area").val(datos.codigo_area); 
                
            }).fail(function(error){
                alert(error.responseText);
            });
};

function eliminar(codigo){

      swal({
		title: "Está seguro de dar de baja el registro seleccionado?",
		text: "Confirme",		
                showCancelButton: true,
                confirmButtonColor: "#009688",
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                closeOnConfirm: false,    		
                imageUrl: "../imagenes/pregunta.png"
	},
	function(isConfirm){
            if (isConfirm){
                    $.post(
                            "../controlador/personal.darbaja.controlador.php",
                            {
                                p_dni : codigo
                            }
                        ).done(function(resultado){
                            if (resultado==="exito"){               
                                listar();
                                swal("Éxito!", 'Se acaba de cambiar el estado de esta persona a "INACTIVO".', "success");
                            }
                        }).fail(function(error){
                            alert(error.responseText);
                        });
                        
            }
	});
}


$(document).ready(function(){
    listar();
    cargarComboCargo();
    cargarComboArea();        
    cargarComboJefe();
});

