$(document).ready(function(){
    listar();
    
});

    
function listar() {
    
    $.post
    (
        "../controlador/encuesta.listado.controlador.php",
        {
            
        }
    ).done(function(resultado){
        var datosJSON = resultado;
        
        if (datosJSON.estado===200){
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th>CODIGO ENCUESTA</th>';
            html += '<th>FECHA DE CREACIÓN</th>';
	        html += '<th style="text-align: center">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                html += '<tr>';
                html += '<td >'+item.id+'</td>';
                html += '<td>'+item.fecha_encuesta+'</td>';
		html += '<td align="center">';
        html += '<button type="button" class="btn btn-success btn-xs" onclick="eliminar(' + item.id + ')"><i class="fa fa-sign-in"></i></button>';
		html += '&nbsp;&nbsp;';
        html += '<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.id + ')"><i class="fa fa-pencil"></i></button>';
		html += '&nbsp;&nbsp;';
		html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.id + ')"><i class="fa fa-close"></i></button>';
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