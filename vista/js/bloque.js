function listar(){
    $.post(
            "../controlador/bloque.listar.controlador.php"
        ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $("#tabla-listado").dataTable();
            });
}

$(document).ready(function(){
    listar();    
    cargarComboDepartamento();     
});

function cargarComboDepartamento(){
    $("#cbodepartamento").load("../controlador/combo.bloque.controlador.php?modal=si");    
};
function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo Bloque");
    $("#txttipooperacion").val("agregar");    
    $("#txtcodigo").val("");    
    $("#txtdescrip").val(""); 
    $("#txtorden").val("");
    $("#cbodepartamento").val(""); 
    
  
};

$("#myModal").on('shown.bs.modal', function(){
    $("#txtdescrip").focus();
    $("#txtorden").focus();
    
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
                        "../controlador/bloque.agregar.editar.controlador.php",
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

function editar( codigodep , pro){
    $("#titulomodal").empty().append("Editar datos del bloque");
    $("#txttipooperacion").val("editar");
    console.log('1'+codigodep);
    console.log('2'+pro);
    var var1,var2;
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
    console.log('1'+var1);
    console.log('2'+var2);
    
    $.post(
            "../controlador/bloque.leer-datos.controlador.php",
            {
                p_codigoe : var1,
                p_codigob : var2
            }
            ).done(function(resultado){                
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.id_bloque);
                $("#txtdescrip").val(datos.nombre_bloque);
                $("#txtorden").val(datos.orden_bloque); 
                $("#cbodepartamento").val(datos.id_encuesta);                
                
            }).fail(function(error){
                alert(error.responseText);
            });
};

function eliminar(codigodep , pro){
var var1,var2;
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
                            "../controlador/bloque.eliminar.controlador.php",
                            {
                                p_codigoe : var1 , 
                                p_codigob : var2
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
