function listar(){
    $.post(
            "../controlador/articulo.listar.controlador.php"
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



function cargarComboTipo( nombreCombo ){
    var codigoCategoria;
    var modal;
    
    if (nombreCombo === "#txttipo"){ //modal
        codigoCategoria = $("#txtcategoria").val(); 
        modal = "si";
    }else{
        codigoCategoria = $("#txtcategoria_prin").val(); 
        modal = "no";
    }
        
    $.post(
            "../controlador/tipo.cargar-combo.controlador.php",
            {
                p_codigo_categoria: codigoCategoria,
                modal: modal
            }
          ).done(function(resultado){
              $(nombreCombo).html(resultado);
              //alert(resultado);
          });
}

$("#txtcategoria").change(function(){
   cargarComboTipo("#txttipo");
});

function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo artículo");
    $("#txttipooperacion").val("agregar");    
    $("#txtcodigo").val("");    
    $("#txtnombre").val(""); 
    $("#txtpresentacion").val(""); 
    $("#txtprecio").val(""); 
    $("#txtstock").val(""); 
    $("#txtcategoria").val(""); 
    $("#txttipo").val(""); 
    $("#txtestado").val(""); 
    $("#txtfoto").val(""); 
  
};

$("#frmgrabar").submit(function(evento){
    evento.preventDefault();
    
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
    
                            var archivo_foto = $('#txtfoto').prop('files')[0];

                            var datos_frm = new FormData();
                            datos_frm.append( "p_datos", $("#frmgrabar").serialize() );
                            datos_frm.append( "p_foto", archivo_foto);
                         //   console.log($("#frmgrabar").serialize());
                            console.log(archivo_foto);
                            $.ajax({
                                url: "../controlador/articulo.agregar.editar.controlador.php",
                                dataType: 'text',  
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: datos_frm,                         
                                type: 'post',
                                success: function(resultado){
                                    console.log(resultado);
                                    if (resultado === "exito"){
                                        
                                        listar();
                                        swal("Éxito!", "Se ha grabado correctamente!", "success");
                                     //   setTimeout(4700,document.location.reload());
                                        
                                        //$("#btncerrar").click();
                                        
                                    }
                                },
                                error: function(error){
                                     alert(error.responseText);
                                }
                             });
    
                }
	});
});

function cargarComboCategoria(){
    $("#txtcategoria").load("../controlador/combo.categorias.controlador.php?modal=no");    
};

function editar(codigo){
    $("#titulomodal").empty().append("Editar datos del artículo");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/articulo.leer-datos.controlador.php",
            {
                p_codigo : codigo
            }
            ).done(function(resultado){                
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codigo_articulo);
                $("#txtnombre").val(datos.nombre);                
                $("#txtpresentacion").val(datos.presentacion);                
                $("#txtprecio").val(datos.precio_venta);                
                $("#txtstock").val(datos.stock);                                               
                $("#txtestado").val(datos.estado);    
                $("#txtcategoria").val(datos.codigo_categoria);                                                          
                $("#txtcategoria").change();
              
              $("#myModal").on('shown.bs.modal', function(){
                  $("#txttipo").val(datos.codigo_tipo);
              });
                
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
                            "../controlador/articulo.eliminar.controlador.php",
                            {
                                codigoArea : codigo
                            }
                        ).done(function(resultado){
                            if (resultado==="exito"){               
                                listar();
                                swal("Éxito!", "El registro se dió de baja exitosamente.", "success");
                            }
                        }).fail(function(error){
                            alert(error.responseText);
                        });                        
            }
	});
}


$("#myModal").on('shown.bs.modal', function(){
    $("#txtnombre").focus();
});


function verFoto(codigoArt, nombre){
    var foto = '<img src="../imagenes/articulos/' + codigoArt + '.jpg" width="100%"/>';
    var titulo = "<h4><b>" + nombre +"</b></h4>";
    $("#verFoto").html(foto);
    $("#tituloFoto").html(titulo);
}

function cerrarFoto(){
    $('#miFoto').modal('toggle');
}
