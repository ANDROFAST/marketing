

function cargarComboTipo(p_nombreCombo, p_tipo){
    $.post
    (
	"../controlador/tipo.cargar.combo.controlador.php"
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione un tipo</option>';
            }else{
                html += '<option value="0">Todos los tipos</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_tipo+'">'+item.descripcion+'</option>';
            });
            
            $(p_nombreCombo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarComboPregunta(p_nombreCombo, p_tipo){
    $.post
    (
    "../controlador/respuesta.cargar.combo.controlador.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione una pregunta</option>';
            }else{
                html += '<option value="0">Todos las preguntas</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_pregunta+'">'+item.descripcion+'</option>';
            });
            
            $(p_nombreCombo).html(html);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}



/*INICIO: BUSQUEDA DE CLIENTES*/
$("#txtnombrepr").autocomplete({
    source: "../controlador/proveedor.autocompletar.controlador.php",
    minLength: 3, //Filtrar desde que colocamos 2 o mas caracteres
    focus: f_enfocar_registro,
    select: f_seleccionar_registro
});

function f_enfocar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtnombrepr").val(registro.razon_social);
    event.preventDefault();
}

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtnombrepr").val(registro.razon_social);
    $("#txtcodigopr").val(registro.ruc);
    
    event.preventDefault();
}
       