$(document).ready(function(){
    cargarComboPregunta("#cbopregunta","todos");
    cargarComboPregunta("#cbopreguntamodal","seleccione");
    listar();
});   

$("#cbopregunta").change(function(){
    listar();
});


function listar(){
    var codigoRespuesta = $("#cbopregunta").val();
    if (codigoRespuesta === null){
        codigoRespuesta = 0;
    }
    
    $.post
    (
        "../controlador/respuesta.listar.controlador.php",
        {
            codigoRespuesta: codigoRespuesta
        }
    ).done(function(resultado){
        var datosJSON = resultado;
        
        if (datosJSON.estado===200){
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            
            html += '<th>NÚM. DE VENTA</th>';
            html += '<th>FECHA DE VENTA</th>';
            html += '<th>CLIENTE</th>';
            html += '<th>FECHA RESPUESTA</th>';
            html += '<th>RESPUESTA</th>';
            html += '<th>VALOR</th>';
            html += '<th>PREGUNTA</th>';
	    html += '<th style="text-align: center">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                html += '<tr>';
                html += '<td align="center">'+item.numero_venta+'</td>';
                html += '<td align="center">'+item.fecha_venta+'</td>';
                html += '<td>'+item.cliente+'</td>';
                html += '<td>'+item.fecha_respuesta+'</td>';
                html += '<td>'+item.resp+'</td>';
                html += '<td>'+item.valor+'</td>';
                html += '<td>'+item.preg+'</td>';
		html += '<td align="center">';
		html += '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.codigo + ')"><i class="fa fa-pencil"></i></button>';
		html += '&nbsp;&nbsp;';
		html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.codigo + ')"><i class="fa fa-close"></i></button>';
		html += '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';
            
            $("#listado").html(html);
            
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "asc"]]
            });
            
            
            
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
        
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error"); 
    });
    
}

function eliminar(codigoRespuesta){
   swal({
            title: "Confirme",
            text: "¿Esta seguro de eliminar el registro seleccionado?",

            showCancelButton: true,
            confirmButtonColor: '#d93f1f',
            confirmButtonText: 'Si',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true,
            imageUrl: "../imagenes/eliminar.png"
	},
	function(isConfirm){
            if (isConfirm){
                $.post(
                    "../controlador/respuesta.eliminar.controlador.php",
                    {
                        codigoRespuesta: codigoRespuesta
                    }
                    ).done(function(resultado){
                        var datosJSON = resultado;   
                        if (datosJSON.estado===200){ //ok
                            listar();
                            swal("Exito", datosJSON.mensaje , "success");
                        }

                    }).fail(function(error){
                        var datosJSON = $.parseJSON( error.responseText );
                        swal("Error", datosJSON.mensaje , "error");
                    });
                
            }
	});
   
}

$("#frmgrabar").submit(function(evento){
    evento.preventDefault();
    
    swal({
		title: "Confirme",
		text: "¿Esta seguro de grabar los datos ingresados?",
		
		showCancelButton: true,
		confirmButtonColor: '#3d9205',
		confirmButtonText: 'Si',
		cancelButtonText: "No",
		closeOnConfirm: false,
		closeOnCancel: true,
                imageUrl: "../imagenes/pregunta.png"
	},
	function(isConfirm){ 

            if (isConfirm){ //el usuario hizo clic en el boton SI     
                
                //procedo a grabar
                
                $.post(
                    "../controlador/respuesta.agregar.editar.controlador.php",
                    {
                        p_datosFormulario: $("#frmgrabar").serialize()
                    }
                  ).done(function(resultado){                    
		      var datosJSON = resultado;

                      if (datosJSON.estado===200){
			  swal("Exito", datosJSON.mensaje, "success");
                          $("#btncerrar").click(); //Cerrar la ventana 
                          listar(); //actualizar la lista
                      }else{
                          swal("Mensaje del sistema", resultado , "warning");
                      }

                  }).fail(function(error){
			var datosJSON = $.parseJSON( error.responseText );
			swal("Error", datosJSON.mensaje , "error");
                  }) ;
                
            }
	});    
});

$("#btnagregar").click(function(){
    $("#txttipooperacion").val("agregar");
    
    $("#txtcodigo").val("");
    $("#txtnombre").val("");
    $("#txtprecio").val("");
    $("#cbotipomodal").val("");

    
    $("#titulomodal").text("Agregar nuevo articulo");
    
});

$("#myModal").on("shown.bs.modal", function(){
    $("#txtnombre").focus();
});

function leerDatos( codigoArticulo ){
    
    $.post
        (
            "../controlador/articulo.leer.datos.controlador.php",
            {
                p_codigoArticulo: codigoArticulo
            }
        ).done(function(resultado){
            var datosJSON = resultado;
            if (datosJSON.estado === 200){
                
                $.each(datosJSON.datos, function(i,item) {
                    $("#txtcodigo").val( item.codigo_articulo );
                    $("#txtnombre").val( item.nombre );
                    $("#txtprecio").val( item.precio_venta );
                    $("#cbotipomodal").val( item.codigo_tipo );

                    $("#txttipooperacion").val("editar");
                    
                });
                
            }else{
                swal("Mensaje del sistema", resultado , "warning");
            }
        })
    
}

