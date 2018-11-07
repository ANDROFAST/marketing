$(document).ready(function(){
    listar();
});

$("#btnagregar").click(function(){
   document.location.href = "compra.vista.php"; 
});

$("#btnfiltrar").click(function(){
    listar(); 
});

function listar(){
    var fecha1 = $("#txtfecha1").val();
    var fecha2 = $("#txtfecha2").val();
    var tipo   = $("#rbtipo:checked").val();//toma el valor del que esta seleccionado
    
    $.post
    (
        "../controlador/compra.listado.controlador.php",
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
            
            html += '<th style="text-align: center">OPCIONES</th>';
            html += '<th>NUMERO</th>';
            html += '<th>TIPO COMPROBANTE</th>';
            html += '<th>SERIE</th>';
            html += '<th>DOCUMENTO</th>';
            html += '<th>FECHA</th>';
            html += '<th>PROVEEDOR</th>';
            html += '<th>RUC</th>';
            html += '<th>SUBTOTAL</th>';
            html += '<th>IGV</th>';
            html += '<th>TOTAL</th>';
            html += '<th>PORCENTAJE IGV</th>';
            html += '<th>DNI USUARIO</th>';
            html += '<th>ESTADO</th>';           
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                if( item.estado === "Emitido" ){
                    html += '<tr>';
                    html += '<td align="center">';
                    html += '<button type="button" class="btn btn-danger btn-xs" onclick="anular(' + item.nro_compra + ')"><i class="fa fa-close"></i></button>';
                    html += '</td>'; 
                }else{
                    html += '<tr style="text-decoration:line-through; color:red">';
                    html += '<td align="center">';                    
                    html += '</td>';
                }
                
                html += '<td align="center">'+item.nro_compra+'</td>';
                html += '<td>'+item.tipo_doc+'</td>';
                html += '<td>'+item.serie+'</td>';
                html += '<td>'+item.documento+'</td>';
                html += '<td>'+item.fecha+'</td>';
                html += '<td>'+item.razon_social+'</td>';
                html += '<td>'+item.ruc+'</td>';
                html += '<td>'+item.sub_total+'</td>';
                html += '<td>'+item.igv+'</td>';
                html += '<td>'+item.total+'</td>';
                html += '<td>'+item.impuesto+'</td>';               
                html += '<td>'+item.dni_usuario+'</td>';  
                html += '<td>'+item.estado+'</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';
            
            $("#listado").html(html);
            
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "desc"]],
                "sScrollX" : "100%",
                "sScrollXInner": "150%",
                "bScrollCollapse": true,
                "bPaginate": true
            });
       
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
        
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error"); 
    });
    
}

function anular(numero_compra){
   swal({
            title: "Confirme",
            text: "¿Esta seguro de anular la venta seleccionada?",

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
                    "../controlador/compra.anular.controlador.php",
                    {
                        p_numero_compra: numero_compra
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
