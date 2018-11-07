$(document).ready(function(){
    listar();
});

$("#btnagregar").click(function(){
   document.location.href = "mensaje.vista.php"; 
});

$("#btnfiltrar").click(function(){
    listar(); 
});
$(document).ready(function(){
     cargarComboMensaje("#cboeventomensaje", "seleccione");
 
});

function listar(){
    var fecha1 = $("#txtfecha1").val();
    var fecha2 = $("#txtfecha2").val();
    var tipo   = $("#rbtipo:checked").val();//toma el valor del que esta seleccionado
    
    $.post
    (
        "../controlador/sms.cliente.listar.controlador.php",
        {
            p_fecha1: fecha1,
            p_fecha2: fecha2,
            p_tipo: tipo
        }
    ).done(function(resultado){
        var datosJSON = resultado;
        
        if (datosJSON.estado===200){
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
           // html += '<th style="text-align: center">OPCIONES</th>';
            html += '<th>CODIGO CLIENTE</th>';
            html += '<th>NOMBRES</th>';
            html += '<th>FECHA</th>';
            html += '<th>EVENTO</th>';
            html += '<th>MENSAJE</th>';
            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                html += '<tr>';
                html += '<td align="center">'+item.codcli+'</td>';
                html += '<td>'+item.cl+'</td>';
                html += '<td>'+item.fecha+'</td>';
                html += '<td>'+item.descrp+'</td>';
                html += '<td>'+item.mensj+'</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';
            
            $("#listado").html(html);
            
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "desc"]]
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



$("#myModal").on("shown.bs.modal", function(){
    $("#txtnombre").focus();
});


function leerDatosSms( codigo ){
    
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
                    $("#txtnombre").val( item.nombres );
                    $("#txtapellidos").val( item.apellido_paterno+ " " +item.apellido_materno);                    
                    $("#txtmovil").val( item.telefono_movil );
                    $("#txtcumple").val( item.fecha_cumpleanios );
                    $("#txtbodas").val( item.fecha_aniversario_boda );
                    $("#txtcumplefam1").val( item.fecha_cumpleanio_familiar1 );
                    $("#txtcumplefam2").val( item.fecha_cumpleanio_familiar2 );
                    
                    //Ejecuta el evento change para llenar las categorías que pertenecen a la linea seleccionada
                    
                    $("#txttipooperacion").val("editar");
                    
                });
                
            }else{
                swal("Mensaje del sistema", resultado , "warning");
            }
        });   
}


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
