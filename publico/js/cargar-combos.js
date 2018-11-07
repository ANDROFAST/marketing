
function cargarComboLinea(p_nombreCombo, p_tipo){
    $.post
    (
	"../controlador/linea.cargar.combo.controlador.php"
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione una linea</option>';
            }else{
                html += '<option value="0">Todas las lineas</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_linea+'">'+item.descripcion+'</option>';
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

function cargarComboMarca(p_nombreCombo, p_tipo){
    $.post
    (
	"../controlador/marca.cargar.combo.controlador.php"
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione una marca</option>';
            }else{
                html += '<option value="0">Todas las marcas</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_marca+'">'+item.descripcion+'</option>';
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

function cargarComboCategoria(p_nombreCombo, p_tipo, p_codigoLinea){
    $.post
    (
	"../controlador/categoria.cargar.combo.controlador.php",
        {
            p_codigoLinea: p_codigoLinea
        }
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione una linea</option>';
            }else{
                html += '<option value="0">Todas las lineas</option>';
            }

            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_categoria+'">'+item.descripcion+'</option>';
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
       