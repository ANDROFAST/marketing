$(document).ready(function(){
    cargarComboDepartamento("#cbodepartamento");
    cargarComboDepartamento("#cbodepartamentoamodal");
    cargarComboDepartamento("#cbodepartamentoamodal1");
    cargarComboDepartamento("#cbodepartamentoamodal2");
    listar();
    cargarTipoCliente();
    readOnlyEstado();    
    
    var hoy = new Date();
    var dd= hoy.getDate();
    var mm= hoy.getMonth()+1;
    var yyyy= hoy.getFullYear();
    
    if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }
    hoy= dd+'/'+mm+'/'+yyyy;
    console.log(hoy);
    //$("#txtfecharegistro").val(hoy);
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

$("#cbodepartamentoamodal1").change(function(){
    cargarComboProvincia("#cboprovinciamodal1", "#cbodepartamentoamodal1");
    cargarComboDistrito("#cbodistritomodal1", "#cbodepartamentoamodal1", "#cboprovinciamodal1");
});

$("#cbodepartamentoamodal2").change(function(){
    cargarComboProvincia("#cboprovinciamodal2", "#cbodepartamentoamodal2");
    cargarComboDistrito("#cbodistritomodal2", "#cbodepartamentoamodal2", "#cboprovinciamodal2");
});

$("#cboprovinciamodal").change(function(){
    cargarComboDistrito("#cbodistritomodal", "#cbodepartamentoamodal", "#cboprovinciamodal");   
});
$("#cboprovinciamodal1").change(function(){    
    cargarComboDistrito("#cbodistritomodal1", "#cbodepartamentoamodal1", "#cboprovinciamodal1");
});

$("#cboprovinciamodal2").change(function(){    
    cargarComboDistrito("#cbodistritomodal2", "#cbodepartamentoamodal2", "#cboprovinciamodal2");
});


function listar()
{
    $("#listado").load("../controlador/Cliente.controlador.php?action=1", function ()
    {
        $("#tabla-listado").dataTable();

    });
}

function cargarTipoCliente()
{
    $("#opcion_cliente").load("../controlador/Cliente.controlador.php?action=2");
}

$("#txtdni").change(function ()
{
    var caracteresDNI = $("#txtdni").val();
    if (caracteresDNI.length>0) {               
        validarDNIRUC($("#opcion_cliente").val());            
    }
    
});

$("#txtruc").change(function ()
{
    var caracteresDNI = $("#txtruc").val();
    if (caracteresDNI.length>0) {               
        validarDNIRUC($("#opcion_cliente").val());            
    }
    
});

function validarDNIRUC(opcionTP)
{
    var valor;    
    //var opcionTP = $("#opcion_cliente").val;
    if(opcionTP==1 ){
        valor= $("#txtdni").val();        
    }
    if(opcionTP==2){
        valor= $("#txtruc").val();
    }
    
         
    $.post(
            "../controlador/consultarClienteDniRuc.controlador.php",
            {   
                p_valor: valor,
                p_valortp: opcionTP
            }
          ).done(function(resultado){   
            if(valor.length>0){
              if(resultado.replace(/^\s+/g,'').replace(/\s+$/g,'')==='NE'){
                  console.log('todo ok');
                  if(opcionTP==1)                  
                  {
                      $('#txtdni').prop('class', 'form-control');
                      $('#parsley-id-dni').prop('class', 'hidden');
                      $('#txtruc').prop('class', 'form-control');
                      $('#parsley-id-ruc').prop('class', 'hidden');
                      $('#btnAgregarModal').prop('class', 'btn btn-success');
                  }
                  if(opcionTP==2){
                      $('#txtdni').prop('class', 'form-control');
                      $('#parsley-id-dni').prop('class', 'hidden');
                      $('#txtruc').prop('class', 'form-control');
                      $('#parsley-id-ruc').prop('class', 'hidden');
                      $('#btnAgregarModal').prop('class', 'btn btn-success');
                  }
              }else{
                  console.log('el cliente ya existe');                  
                  if(opcionTP==1)
                  {
                    $('#txtdni').prop('class', 'form-control parsley-error');
                    $('#parsley-id-dni').prop('class', 'list-group');  //parsley-errors-list filled
                    $('#txtruc').prop('class', 'form-control');
                    $('#parsley-id-ruc').prop('class', 'hidden');
                    $('#btnAgregarModal').prop('class', 'hidden');
                  
                  }
                  if(opcionTP==2)
                  {
                    $('#txtdni').prop('class', 'form-control');
                    $('#parsley-id-dni').prop('class', 'hidden');
                    $('#txtruc').prop('class', 'form-control parsley-error');
                    $('#parsley-id-ruc').prop('class', 'list-group');   
                    $('#btnAgregarModal').prop('class', 'hidden');
                  }
                  
              }
            }else{
                if(opcionTP==1)                  
                  {
                    $('#txtdni').prop('class', 'form-control');
                    $('#parsley-id-dni').prop('class', 'hidden');
                    $('#txtruc').prop('class', 'form-control');
                    $('#parsley-id-ruc').prop('class', 'hidden');
                    $('#btnAgregarModal').prop('class', 'btn btn-success');
                  }
                  if(opcionTP==2){
                      $('#txtdni').prop('class', 'form-control');
                    $('#parsley-id-dni').prop('class', 'hidden');
                    $('#txtruc').prop('class', 'form-control');
                    $('#parsley-id-ruc').prop('class', 'hidden');
                    $('#btnAgregarModal').prop('class', 'btn btn-success');
                  }
            }
          });       
};

function readOnlyEstado()
{
    var codigoEstado = $("#opcion_cliente").val();
    var estado = (codigoEstado!=1)?true:false;
    $("#txtdni").prop('readonly', estado).val('');
    $("#txtnombres").prop('readonly', estado).val('');
    $("#txtapepaterno").prop('readonly', estado).val('');
    $("#txtapematerno").prop('readonly', estado).val('');
    
    
    var estado1=(codigoEstado!=2)?true:false;
        $("#txtruc").prop('readonly', estado1).val('');
        $("#txtrazonsocial").prop('readonly', estado1).val('');   
        
    validarDNIRUC(codigoEstado);    
}

$("#opcion_cliente").change(function ()
{
    readOnlyEstado();    
 //   var opcionTP = $("#opcion_cliente").val();    
});

function agregar()
{
    $("#txtcodigo").prop('readonly', true);
    $("#txtcodigo").val('');
    $("#opcion_cliente").val('');
    //$("#txtfecharegistro").val('');
    $("#txtdni").val('');
    $("#txtruc").val('');
    $("#txtapepaterno").val('');
    $("#txtapematerno").val('');
    $("#txtnombres").val('');
    $("#txtrazonsocial").val('');
    $("#txttelefonofijo").val('');
    $("#txttelefonomovil").val('');
    $("#txtdireccion").val('');
    $("#txtcorreo").val('');
    //$("#txtfecharegistro").val('');
    $("#opcion_estado").val('');   
       
    $("#txttipooperacion").val('agregar');
    
       $("#txtdireccion_web").val('');        
    $("#titulo_modal").html("Registrar cliente");
    $("#cbodepartamentoamodal").val("");
    
    $("#cbodepartamentoamodal").change();
                    
    $("#myModal").on("shown.bs.modal", function(){
        $("#cboprovinciamodal").val("");         
    });
    
    $("#cbodistritomodal").val("");
       
}

$("#frmagregar").submit(function (event)
{
    
    event.preventDefault();
    console.log($(this).serialize());
    $.
        post
    (

        "../controlador/Cliente.controlador.php?action=3",
        {
            
            p_arrayagregar: $(this).serialize()
        }
    )
        .done(function (resultado)
        {
                alert(resultado);
            if (resultado.replace(/^\s+/g,'').replace(/\s+$/g,'')!='false')
            {
                swal({
                    title: "¡Excelente!",
                    text: "Registro agregado correctamente." ,
                    type: "success"
                });            
                    listar();                
                $("#btnCerrarModal").click();
            }
        })
        .fail(function(error)
        {
            swal({
                title: "Ha ocurrido un error!",
                text: error.responseText,
                type: "error"
            });
        });
});


$("#frmEditarNatural").submit(function (event)
{
    
    event.preventDefault();
    $.
        post
    (

        "../controlador/Cliente.controlador.php?action=6",
        {            
            p_array: $(this).serialize()
        }
    )
        .done(function (resultado)
        {
//            alert(resultado);
//                    echo ($resultado)?json_encode($resultado):'false';
            if (resultado!='false')
            {
                swal({
                    title: "¡Excelente!",
                    text: "Registro actualizado correctamente.",
                    type: "success"
                });

                    listar();

                $("#btnCerrarModal1").click();
            }
        })
        .fail(function(error)
        {
            swal({
                title: "Ha ocurrido un error!",
                text: error.responseText,
                type: "error"
            });
        });
});


function editar(codigo)
{
//    
    $("#titulo_modal1").html("Editar cliente Natural");
    $("#txttipooperacion1").val('editar');
   
    $("#txtcodigo1").val(codigo);
//alert(codigo);
    $.
        post
    (
        "../controlador/Cliente.controlador.php?action=4",
        {
            p_codigo: codigo
        }
    )
        .done(function (resultado)
        {
//            alert(resultado)
            var data = $.parseJSON(resultado);
            $("#txtcodigo1").prop('readonly', true);

            $("#txtdni1").val(data['dni']);
            $("#txtapepaterno1").val(data['apellido_paterno']);
            $("#txtapematerno1").val(data['apellido_materno']);
            $("#txtnombres1").val(data['nombres']);
            $("#txtcorreo1").val(data['email']);
            $("#txttelefonomovil1").val(data['telefono_movil']);
            $("#txtdireccion1").val(data['direccion']);
            $("#txtfecharegistro1").val(data['fecha_registro']);
            $("#opcion_estado1").val(data['estado']);
            $("#txttelefonofijo1").val(data['telefono_fijo']);
            
            $("#cbodepartamentoamodal1").val( data['codigo_departamento'] );
            
            $("#cbodepartamentoamodal1").change();

            $("#editarModal").on("shown.bs.modal", function(){
                $("#cboprovinciamodal1").val( data.codigo_provincia );         
            });

            $("#cboprovinciamodal1").change(); 

            $("#editarModal").on("shown.bs.modal", function(){
                $("#cbodistritomodal1").val( data.codigo_distrito );
            });             

        })
        .fail(function(error)
        {
            swal({
                title: "Ha ocurrido un error!",
                text: error.responseText,
                type: "error"
            });
        });
      
}


$("#frmEditarJuridico").submit(function (event)
{
    
    event.preventDefault();
    $.
        post
    (

        "../controlador/Cliente.controlador.php?action=7",
        {            
            p_array: $(this).serialize()
        }
    )
        .done(function (resultado)
        {
            if (resultado!='false')
            {
                swal({
                    title: "¡Excelente!",
                    text: "Registro actualizado correctamente.",
                    type: "success"
                });

                    listar();

                $("#btnCerrarModal2").click();
            }
        })
        .fail(function(error)
        {
            swal({
                title: "Ha ocurrido un error!",
                text: error.responseText,
                type: "error"
            });
        });
});


function editarJ(codigo)
{
//    
    $("#titulo_modal2").html("Editar cliente Juridico");
    $("#txttipooperacion2").val('editar');

    $("#txtcodigo2").val(codigo);
//alert(codigo);
    $.
        post
    (
        "../controlador/Cliente.controlador.php?action=4",
        {
            p_codigo: codigo
        }
    )
        .done(function (resultado)
        {
            var data = $.parseJSON(resultado);
            $("#txtcodigo2").prop('readonly', true);

            $("#txtrucc").val(data['ruc']);
            $("#txtrazonsocial2").val(data['razon_social']);
            $("#txtcorreo2").val(data['email']);
            $("#txtdireccion_web2").val(data['direccion_web']);
            $("#txttelefonomovil2").val(data['telefono_movil']);
            $("#txtdireccion2").val(data['direccion']);
            $("#txtfecharegistro2").val(data['fecha_registro']);
            $("#opcion_estado2").val(data['estado']);
            $("#txttelefonofijo2").val(data['telefono_fijo']);            
            $("#cbodepartamentoamodal2").val( data['codigo_departamento'] );
            
            $("#cbodepartamentoamodal2").change();

            $("#editarJuridicoModal").on("shown.bs.modal", function(){
                $("#cboprovinciamodal2").val( data.codigo_provincia );         
            });

            $("#cboprovinciamodal2").change(); 

            $("#editarJuridicoModal").on("shown.bs.modal", function(){
                $("#cbodistritomodal2").val( data.codigo_distrito );
            });
           
        })
        .fail(function(error)
        {
            swal({
                title: "Ha ocurrido un error!",
                text: error.responseText,
                type: "error"
            });
        });
      

}

function eliminar(codigo)
{
  
    swal({
            title: "¿Estás seguro?",
            text: "Estás apunto de eliminar el cliente con código: "+ codigo,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#62cb31",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            closeOnCancel: false },
        function (isConfirm)
        {
            if (isConfirm)
            {
                $.post
                (
                    "../controlador/Cliente.controlador.php?action=5",
                    {
                        p_codigo_cliente : codigo
                    }
                )
                    .done(function (resultado)
                    {
                      //    alert(resultado);
                        if (resultado)
                        {
                            swal("Eliminado", "El cliente con código: "+ codigo+" ha sido eliminado.", "success");
                            listar();
                        }
                        else
                        {
                            swal("Error", "Imposible eliminar.", "error");
                        //           listar();
                        }
                    })
                    .fail(function (error)
                    {
                        swal("Ha ocurrido un error!",error.responseText,"error");
                    });

            } else
            {
                swal("Cancelado", "El cliente no ha sido eliminado.", "error");
            }
        });
}



