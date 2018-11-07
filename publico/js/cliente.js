$(document).ready(function(){
    cargarComboDepartamento("#cbodepartamento");
    cargarComboDepartamento("#cbodepartamentoamodal");
    listar();
});

$("#cbodepartamento").change(function(){
    cargarComboProvincia("#cboprovincia", "#cbodepartamento");
    cargarComboDistrito("#cbodistrito", "#cbodepartamento", "#cboprovincia");
    listar();
});
        
$("#cboprovincia").change(function(){
    cargarComboDistrito("#cbodistrito", "#cbodepartamento", "#cboprovincia");
    listar();
});

$("#cbodistrito").change(function(){
    listar();
});

$("#cbodepartamentoamodal").change(function(){
    cargarComboProvincia("#cboprovinciamodal", "#cbodepartamentoamodal");
    cargarComboDistrito("#cbodistritomodal", "#cbodepartamentoamodal", "#cboprovinciamodal");
});

$("#cboprovinciamodal").change(function(){
    cargarComboDistrito("#cbodistritomodal", "#cbodepartamentoamodal", "#cboprovinciamodal");
});

function listar(){
    var codigoDep = $("#cbodepartamento").val();
    
    if (codigoDep === null || codigoDep === ''){
        codigoDep = '';
    }
    
    var codigoProv = $("#cboprovincia").val();
   
    if (codigoProv === null || codigoProv === ''){
        codigoProv = '';
    }
    
    var codigoDist = $("#cbodistrito").val();
    
    if (codigoDist === null || codigoDist === ''){
        codigoDist = '';
    }
    
    $.post
    (
        "../controlador/cliente.listar.controlador.php",
        {
            p_dep: codigoDep,
            p_prov: codigoProv,
            p_dist: codigoDist
        }
    ).done(function(resultado){
        var datosJSON = resultado;
        
        if (datosJSON.estado===200){
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th>CODIGO</th>';
            html += '<th>NOMBRE DEL CLIENTE</th>';
            html += '<th>DNI</th>';
            html += '<th>DIRECCIÓN</th>';
            html += '<th>TELEFONO</th>';
            html += '<th>UBIGEO</th>';
	    html += '<th style="text-align: center">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                html += '<tr>';
                html += '<td align="center">'+item.codigo+'</td>';
                html += '<td>'+item.cliente+'</td>';
                html += '<td>'+item.dni+'</td>';
                html += '<td>'+item.dir+'</td>';
                html += '<td>'+item.telefono+'</td>';
                html += '<td>'+item.ubigeo+'</td>';
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

function eliminar(codigo){
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
                    "../controlador/cliente.eliminar.controlador.php",
                    {
                        codigo: codigo
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
                    "../controlador/cliente.agregar.editar.controlador.php",
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


$("#btnagregarcl").click(function(){
    $("#txttipooperacion").val("agregar");
    
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
    
});

$("#myModal").on("shown.bs.modal", function(){
    $("#txtnombre").focus();
});

function leerDatos( codigo ){
    
    $.post
        (
            "../controlador/cliente.leer.datos.controlador.php",
            {
                p_codigo: codigo
            }
        ).done(function(resultado){
            var datosJSON = resultado;
            if (datosJSON.estado === 200){
                
                $.each(datosJSON.datos, function(i,item) {
                    $("#txtcodigo").val( item.codigo_cliente );
                    $("#txtdni").val( item.nro_documento_identidad );
                    $("#txtnombre").val( item.nombres );
                    $("#txtapellidos").val( item.apellido_paterno+ " " +item.apellido_materno);                    
                    $("#txtdireccion").val( item.direccion );
                    $("#txttelef").val( item.telefono_fijo );
                    $("#txtemail").val( item.email );
                    $("#txtweb").val( item.direccion_web );
                    $("#cbodepartamentoamodal").val( item.codigo_departamento );
                    
                    //Ejecuta el evento change para llenar las categorías que pertenecen a la linea seleccionada
                    $("#cbodepartamentoamodal").change();
                    
                    $("#myModal").on("shown.bs.modal", function(){
                        $("#cboprovinciamodal").val( item.codigo_provincia );         
                    });
                    
                    $("#cboprovinciamodal").change(); 
                    
                    $("#myModal").on("shown.bs.modal", function(){
                        $("#cbodistritomodal").val( item.codigo_distrito );
                    });
                    
                    $("#txttipooperacion").val("editar");
                    
                });
                
            }else{
                swal("Mensaje del sistema", resultado , "warning");
            }
        });   
}

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
                    $("#txtdni").val( item.nro_documento_identidad );
                    $("#txtnombre").val( item.nombres );
                    $("#txtapellidos").val( item.apellido_paterno+ " " +item.apellido_materno);                    
                    $("#txtdireccion").val( item.direccion );
                    $("#txttelef").val( item.telefono_fijo );
                    $("#txtemail").val( item.email );
                    $("#cbodepartamentoamodal").val( item.codigo_departamento );
                    
                    //Ejecuta el evento change para llenar las categorías que pertenecen a la linea seleccionada
                    $("#cbodepartamentoamodal").change();
                    $("#cboprovinciamodal").val( item.codigo_provincia );
                    /*$("#myModal").on("shown.bs.modal", function(){
                        $("#cboprovinciamodal").val( item.codigo_provincia );         
                    });*/
                    
                    $("#cboprovinciamodal").change(); 
                    
                    //$("#myModal").on("shown.bs.modal", function(){
                        $("#cbodistritomodal").val( item.codigo_distrito );
                    //});
                    
                    //$("#txttipooperacion").val("editar");
                    
                });
                
            }else{
                swal("Mensaje del sistema", resultado , "warning");
            }
        });   
}
