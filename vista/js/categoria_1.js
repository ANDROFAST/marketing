function listar(){
    $.post(
            "../controlador/categoria.listar.controlador.php"
        ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $("#tabla-listado").dataTable();
            });
}

$(document).ready(function(){
    listar();     
});

function agregar(){
    $("#myModalLabel").empty().append("Agregar nueva categoría");
    $("#txttipooperacion").val("agregar");    
    $("#txtcodigo").val("");    
    $("#txtdescrip").val(""); 
  
};

$("#myModal").on('shown.bs.modal', function(){
    $("#txtdescrip").focus();
    
});

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
                        "../controlador/categoria.agregar.editar.controlador.php",
                         {
                             p_datosFormulario: $("#frmgrabar").serialize()
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
    $("#titulomodal").empty().append("Editar datos de la categoría");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/categoria.leer-datos.controlador.php",
            {
                p_codigo : codigo
            }
            ).done(function(resultado){                
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codigo_categoria);
                $("#txtdescrip").val(datos.descripcion);                
                
            }).fail(function(error){
                alert(error.responseText);
            });
};

function eliminar(codigo){

      swal({
		title: "Está seguro de eliminar el registro?",
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
                            "../controlador/categoria.eliminar.controlador.php",
                            {
                                codigoCategoria : codigo
                            }
                        ).done(function(resultado){
                            if (resultado==="exito"){               
                                listar();
                                swal("Éxito!", "El registro se eliminó.", "success");
                            }
                        }).fail(function(error){
                            alert(error.responseText);
                        });                        
            }
	});
}

