function listar(){
    $.post(
            "../controlador/tipo.listar.controlador.php"
        ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $("#tabla-listado").dataTable();
            });
}

$(document).ready(function(){
    listar();     
    cargarComboCategoria();
});

function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo tipo");
    $("#txttipooperacion").val("agregar");    
    $("#txtcodigo").val("");    
    $("#txtdescrip").val(""); 
    $("#txtcategoria").val(""); 
  
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
                        "../controlador/tipo.agregar.editar.controlador.php",
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
    $("#titulomodal").empty().append("Editar datos del tipo");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/tipo.leer-datos.controlador.php",
            {
                p_codigo : codigo
            }
            ).done(function(resultado){                
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codigo_tipo);
                $("#txtdescrip").val(datos.descripcion);                
                $("#txtcategoria").val(datos.codigo_categoria);                
                
            }).fail(function(error){
                alert(error.responseText);
            });
};


function cargarComboCategoria(){
    $("#txtcategoria").load("../controlador/combo.categorias.controlador.php?modal=no");    
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
                            "../controlador/tipo.eliminar.controlador.php",
                            {
                                codigoTipo : codigo
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
