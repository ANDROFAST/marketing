

$(document).ready(function(){
    cargarComboDepartamento("#cbodepartamentoamodal");
});

$("#cbodepartamentoamodal").change(function(){
    cargarComboProvincia("#cboprovinciamodal", "#cbodepartamentoamodal");
    cargarComboDistrito("#cbodistritomodal", "#cbodepartamentoamodal", "#cboprovinciamodal");
});

$("#cboprovinciamodal").change(function(){
    cargarComboDistrito("#cbodistritomodal", "#cbodepartamentoamodal", "#cboprovinciamodal");
});

$("#btnagregarcl").click(function(){
    alert( $("#frmgrabar").serialize());
    //evento.preventDefault();
                //procedo a grabar               
                /*$.post(
                    "../controlador/cliente.agregar.editar.controlador.php",
                    {
                        p_datosFormulario: $("#frmgrabar").serialize()                    
                    }                          
                  ).done(function(resultado){                    
		      var datosJSON = resultado;
                      alert($("#frmgrabar").serialize());
                      if (datosJSON.estado===200){
			  swal("Exito", datosJSON.mensaje, "success");
                          //$("#btncerrar").click(); //Cerrar la ventana 
                      }else{
                          swal("Mensaje del sistema", resultado , "warning");
                      }

                  }).fail(function(error){
			var datosJSON = $.parseJSON( error.responseText );
			swal("Error", datosJSON.mensaje , "error");
                  }) ;*/
});

/*$("#btnagregarcl").click(function(){
    alert("Hola");
    /*$("#txttipooperacion").val("agregar");
    
    $("#txtcodigo").val("");
    $("#txtnombre").val("");
    $("#txtapellidos").val("");
    $("#txtdni").val("");
    $("#txtdireccion").val("");
    $("#txttelef").val("");
    $("#txtemail").val("");
    $("#txtweb").val("");
    $("#cbodepartamentoamodal").val("");
    
    $("#cbodepartamentoamodal").change();
                    
    $("#myModal").on("shown.bs.modal", function(){
        $("#cboprovinciamodal").val("");         
    });
    
    $("#cbodistritomodal").val("");
    
    $("#titulomodal").text("Agregar nuevo cliente");
    
});*/

function leerDatosUsuario( codigo ){
    
    $.post
        (
            "../controlador/cliente.leer.datos.usuario.controlador.php",
            {
                p_codigo: codigo
            }
        ).done(function(resultado){
            var datosJSON = resultado;
            if (datosJSON.estado === 200){
                
                $.each(datosJSON.datos, function(i,item) {
                    $("#txtdni").val( item.dni );
                    $("#txtnombre").val( item.nombres );
                    $("#txtapellidos").val( item.apellido_paterno+ " " +item.apellido_materno);                    
                    $("#txtdireccion").val( item.direccion );
                    $("#txttelef").val( item.telefono_fijo );
                    $("#txtemail").val( item.email );
                    $("#txtweb").val( item.direccion_web );
                    $("#txtemail").val( item.email );
                    $("#txtcodigo").val( item.codigo_cliente );
                    $("#cbodepartamentoamodal").val( item.codigo_departamento );
                    
                    //Ejecuta el evento change para llenar las categorías que pertenecen a la linea seleccionada
                    /*$("#cbodepartamentoamodal").change(function(){
                        $("#cboprovinciamodal").val( item.codigo_provincia );
                    });
                    

                    $("#cboprovinciamodal").change(); 
                    
                    $("#cbodistritomodal").val( item.codigo_distrito );

                    $("#txttipooperacion").val("editar"); */                   
                });
                
            }else{
                swal("Mensaje del sistema", resultado , "warning");
            }
        });   
}

function cambiarClave(){
    var codigo =  $("#txtcodigo").val();
    var clave =  $("#txtpass2").val();

    $.post(
                    "../controlador/cliente.usuario.clave.editar.controlador.php",
                    {
                        p_codigo: codigo,
                        p_clave: clave
                    }                          
                  ).done(function(resultado){                    
		      var datosJSON = resultado;
                      
                      if( datosJSON.estado === 200 ){
			  swal("Exito", datosJSON.mensaje, "success");
                          //alert(datosJSON.mensaje);
                          document.location.href = "../controlador/sesioncl.cerrar.controlador.php";
                      }else{
                          swal("Mensaje del sistema", resultado , "warning");
                      }

                  }).fail(function(error){
			var datosJSON = $.parseJSON( error.responseText );
			swal("Error", datosJSON.mensaje , "error");
                  }) ;
}

function isIgual(){
    
    if( $("#txtpass1").val().length > 0 && $("#txtpass2").val().length > 0 ){
        if( $("#txtpass1").val() === $("#txtpass2").val() ){
            cambiarClave();
        }
        else{
            //alert("Las contraseñas no coinciden");
            swal("Fail", "Las contraseñas no coinciden", "warning");
        }
    }else{
        //alert("Debe ingresar una clave");
        swal("Fail", "Debe ingresar una clave", "warning");
    }
}

$("#btnenviar").click(function(){
    isIgual();
});

function agregarPedido(){
    
}


