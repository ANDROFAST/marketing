function listar(){
    $.post(
            "../controlador/pregunta.listar.controlador.php"
        ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $("#tabla-listado").dataTable();
            });
}

$(document).ready(function(){
    listar();    
    cargarComboDepartamento("#cbodepartamento");
    
});

function cargarComboDepartamento( cbo ){
    $.post
    (
	"../controlador/pregunta.cargar.combo.controlador.php"
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = '<option value="">Seleccionar encuesta</option>';
            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id_encuesta+'">'+item.nombre_encuesta+'</option>';
            });
            
            $(cbo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarComboProvincia( cbo, cbodep ){
    var prov = $(cbodep).val();
    
    $.post
    (
	"../controlador/bloque.cargar.combo.controlador.php",
        { p_prov : prov }
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = '<option value="">Seleccionar bloque</option>';
            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id_bloque+'">'+item.nombre_bloque+'</option>';
            });
            
            $(cbo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}



$("#cbodepartamento").change(function(){
    cargarComboProvincia("#cboprovincia","#cbodepartamento");    
});


function agregar(){
    $("#myModalLabel").empty().append("Agregar nueva pregunta");
    $("#txttipooperacion").val("agregar");    
    $("#txtcodigo").val("");    
    $("#txtdescrip").val("");
    $("#txtorden").val(""); 
    $("#cbodepartamento").val(""); 
    $("#cboprovincia").val(""); 
  
};

$("#myModal").on('shown.bs.modal', function(){
    $("#txtdescrip").focus();
    
});

$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
console.log($("#frmgrabar").serialize());
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
                        "../controlador/pregunta.agregar.editar.controlador.php",
                         {
                             p_datosFormulario: $("#frmgrabar").serialize()
                         }
                     ).done(function(resultado){
                         alert(resultado);
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

function editar( codigodep , pro, dist){
    $("#titulomodal").empty().append("Editar datos de la pregunta");
    $("#txttipooperacion").val("editar");
    console.log('1'+codigodep);
    console.log('2'+pro);
    console.log('2'+dist);
    var var1,var2,var3;
    if(codigodep===1){
        var1='01';
    }
    if(codigodep===2){
        var1='02';
    }
    if(codigodep===3){
        var1='03';
    }
    if(codigodep===4){
        var1='04';
    }
    if(codigodep===5){
        var1='05';
    }
    if(codigodep===6){
        var1='06';
    }
    if(codigodep===7){
        var1='07';
    }
    if(codigodep===8){
        var1='08';
    }
    if(codigodep===9){
        var1='09';
    }
    if(codigodep!=9 && codigodep!=8 && codigodep!=7 && codigodep!=6 && codigodep!=5 && codigodep!=4 && codigodep!=3 && codigodep!=2 && codigodep!=1){
        var1=codigodep;
    }
    
    if(pro===1){
        var2='01';
    }
    if(pro===2){
        var2='02';
    }
    if(pro===3){
        var2='03';
    }
    if(pro===4){
        var2='04';
    }
    if(pro===5){
        var2='05';
    }
    if(pro===6){
        var2='06';
    }
    if(pro===7){
        var2='07';
    }
    if(pro===8){
        var2='08';
    }
    if(pro===9){
        var2='09';
    }
    if(pro!=9 && pro!=8 && pro!=7 && pro!=6 && pro!=5 && pro!=4 && pro!=3 && pro!=2 && pro!=1){
        var2=pro;
    }
    
    if(dist===1){
        var3='01';
    }
    if(dist===2){
        var3='02';
    }
    if(dist===3){
        var3='03';
    }
    if(dist===4){
        var3='04';
    }
    if(dist===5){
        var3='05';
    }
    if(dist===6){
        var3='06';
    }
    if(dist===7){
        var3='07';
    }
    if(dist===8){
        var3='08';
    }
    if(dist===9){
        var3='09';
    }
    if(dist!=9 && dist!=8 && dist!=7 && dist!=6 && dist!=5 && dist!=4 && dist!=3 && dist!=2 && dist!=1){
        var3=dist;
    }
    console.log('1'+var1);
    console.log('2'+var2);
    console.log('2'+var3);
    
    $.post(
            "../controlador/pregunta.leer-datos.controlador.php",
            {
                p_idencuesta : var1,
                p_idbloque : var2,
                p_idpregunta: var3
            }
            ).done(function(resultado){                
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.id_pregunta);
                $("#txtdescrip").val(datos.titulo_pregunta);
                $("#txtorden").val(datos.orden_pregunta); 
                $("#cbodepartamento").val(datos.id_encuesta);   
                $("#cbodepartamento").change();                   
                $("#myModal").on('shown.bs.modal', function(){
                  $("#cboprovincia").val(datos.id_bloque);                
                });
                
                
                
            }).fail(function(error){
                alert(error.responseText);
            });
};

function eliminar(codigodep , pro, dist){

var var1,var2,var3;
    if(codigodep===1){
        var1='01';
    }
    if(codigodep===2){
        var1='02';
    }
    if(codigodep===3){
        var1='03';
    }
    if(codigodep===4){
        var1='04';
    }
    if(codigodep===5){
        var1='05';
    }
    if(codigodep===6){
        var1='06';
    }
    if(codigodep===7){
        var1='07';
    }
    if(codigodep===8){
        var1='08';
    }
    if(codigodep===9){
        var1='09';
    }
    if(codigodep!=9 && codigodep!=8 && codigodep!=7 && codigodep!=6 && codigodep!=5 && codigodep!=4 && codigodep!=3 && codigodep!=2 && codigodep!=1){
        var1=codigodep;
    }
    
    if(pro===1){
        var2='01';
    }
    if(pro===2){
        var2='02';
    }
    if(pro===3){
        var2='03';
    }
    if(pro===4){
        var2='04';
    }
    if(pro===5){
        var2='05';
    }
    if(pro===6){
        var2='06';
    }
    if(pro===7){
        var2='07';
    }
    if(pro===8){
        var2='08';
    }
    if(pro===9){
        var2='09';
    }
    if(pro!=9 && pro!=8 && pro!=7 && pro!=6 && pro!=5 && pro!=4 && pro!=3 && pro!=2 && pro!=1){
        var2=pro;
    }
    
    if(dist===1){
        var3='01';
    }
    if(dist===2){
        var3='02';
    }
    if(dist===3){
        var3='03';
    }
    if(dist===4){
        var3='04';
    }
    if(dist===5){
        var3='05';
    }
    if(dist===6){
        var3='06';
    }
    if(dist===7){
        var3='07';
    }
    if(dist===8){
        var3='08';
    }
    if(dist===9){
        var3='09';
    }
    if(dist!=9 && dist!=8 && dist!=7 && dist!=6 && dist!=5 && dist!=4 && dist!=3 && dist!=2 && dist!=1){
        var3=dist;
    }
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
                            "../controlador/pregunta.eliminar.controlador.php",
                            {
                            p_idencuesta : var1,
                            p_idbloque : var2,
                            p_idpregunta: var3
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
