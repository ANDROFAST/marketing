

$(document).on("keyup", "#txtnombrecliente", function (evento) {
   // if (evento.which === 13){ 
    listar();
    /*
    alert("mi"+$("#txtmaxiteraciones").val());
    alert("conf"+$("#txtconfianza").val());
    alert("sp"+$("#txtsopminimo").val());
    */
    //}
});

function listar(){
   var cc ;
   if($("#txtcodigocliente").val()==''){
       cc=0;
   }else{
       cc=$("#txtcodigocliente").val()
   }
   console.log(cc);
   
    $.post(
            "../controlador/ranking.listar.controlador.php", { p_cc : cc}
        ).done(function(resultado){
                $("#listadoRAC").empty();
                $("#listadoRAC").append(resultado);
                $("#tabla-listado").dataTable({
                "aaSorting": [[3, "desc"]],
                "sScrollX" : "100%",
                "sScrollXInner": "101%",
                "bScrollCollapse": true,
                "bPaginate": true
            });
            });
}

$(document).ready(function(){
    listar();     
});
$("#btngenerarconocimiento").click(function(){
    window.open("../controlador/ranking.generar.array.controlador.php?p_confi="+$("#txtconfianza").val()+"&p_maxiter="+$("#txtmaxiteraciones").val()+"&p_sm="+$("#txtsopminimo").val()+" ", "_blank");
    //window.open("../controlador/ranking.generar.array.controlador.php?p_confi=50&p_maxiter=20&p_sm=2","_blank");
})

/*
$("#frmgenerarreglas").submit(function(evento){
    evento.preventDefault();
     
    swal({
        title: "Confirme",
        text: "¿Está de acuerdo con los datos ingresados para generar las reglas de asociación?",
        
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
               console.log("datos: "+$("#frmgrabar").serialize());
                $.post(
                    "../controlador/ranking.generar.array.controlador.php",
                    {
                       p_datosFormulario: $("#frmgenerarconocimiento").serialize()                       
                    }
                  ).done(function(resultado){                    
             // console.log("Dato: "+resultado);
                      if (resultado === 'exito'){
            
                          swal({
                                title: "Exito",
                                text: "Base de conocimientos generada exitosamente!", //datosJSON.mensaje
                                type: "success",
                                showCancelButton: false,                                
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                            });
                            
                           window.open("../controlador/ranking.generar.array.controlador.php?", "_blank");
                    
                      }else{
                          swal("Mensaje del sistema", "Ocurrió un problema, contáctese con el administrador del sistema" , "warning");
                      }


                  }).fail(function(error){
                        var datosJSON = $.parseJSON( error.responseText );
                        swal("Error", datosJSON.mensaje , "error");
                  }) ;
                
            }
    });    
    
});

*/

$("#frmgenerarconocimiento").submit(function(evento){
    evento.preventDefault();
    var cc ;
   if($("#txtcodigocliente").val()==''){
       cc=0;
   }else{
       cc=$("#txtcodigocliente").val()
   }
   
    swal({
        title: "Confirme",
        text: "¿Está de acuerdo con los datos ingresados para generar la base de conocimientos?",
        
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
               console.log("datos: "+$("#frmgrabar").serialize());
                $.post(
                    "../controlador/ranking.generar.conocimiento.controlador.php",
                    {
                   //     p_datosFormulario: $("#frmgenerarconocimiento").serialize(),
                        p_codigo : cc
                    }
                  ).done(function(resultado){                    
              console.log("Dato: "+resultado);
                      if (resultado === 'exito'){
              swal({
                                title: "Exito",
                                text: "Base de conocimientos generada exitosamente!", //datosJSON.mensaje
                                type: "success",
                                showCancelButton: false,                                
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                            });
                    
                      }else{
                          swal("Mensaje del sistema", "Ocurrió un problema, contáctese con el administrador del sistema" , "warning");
                      }


                  }).fail(function(error){
                        var datosJSON = $.parseJSON( error.responseText );
                        swal("Error", datosJSON.mensaje , "error");
                  }) ;
                
            }
    });    
    
});


$("#frmgrabar").submit(function(evento){
    evento.preventDefault();
    
    swal({
        title: "Confirme",
        text: "¿Esta seguro de enviar el mensaje?",
        
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
               console.log("datos: "+$("#frmgrabar").serialize());
                $.post(
                    "../controlador/enviarmensaje.php",
                    {
                        p_datosFormulario: $("#frmgrabar").serialize()                       
                    }
                  ).done(function(resultado){                    
                     //   var datosJSON = resultado;
                        //document.location.href="ranking.articulos.vista.php";
var data = $.parseJSON(resultado);
               // alert(data);
                //console.log("djst"+data.response); object
                console.log("djst"+data.status);
                      if (data.status === 200){
              swal({
                                title: "Exito",
                                text: "Mensaje enviado", //datosJSON.mensaje
                                type: "success",
                                showCancelButton: false,
                                //confirmButtonColor: '#3d9205',
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                            },
                            function(){
                                document.location.href="ranking.articulos.vista.php";
                            });
                      }else{
                          swal("Mensaje del sistema", "El mensaje no pudo ser enviado, contáctese con el administrador del sistema" , "warning");
                      }


                  }).fail(function(error){
                        var datosJSON = $.parseJSON( error.responseText );
                        swal("Error", datosJSON.mensaje , "error");
                  }) ;
                
            }
    });    
});
