$(document).ready(function(){
    cargarDepartamento();
    cargarProvincia("#cboprovinciamodal");
    cargarDistrito("#cbodistritomodal");
    cargarTipoCliente();
    readOnlyEstado();
    
});

function cargarDepartamento(){
    $("#cbodepartamentoamodal").load("../controlador/combo.departamento.controlador.php?modal=0");
}

function cargarProvincia(nombreCombo){
    $(nombreCombo).empty();
    
    var codigo_departamento = "";
        
    //if (nombreCombo == "#cboprovincia"){
        codigo_departamento = $("#cbodepartamentoamodal").val();
    //}
    
    $.post(
            "../controlador/provincia.cargar-combo.controlador.php",
            {
                p_prov: codigo_departamento
            }
          )
          .done(function(resultado){
              $(nombreCombo).empty();
              $(nombreCombo).append(resultado);
          })
          
          .fail(function(error){
              alert(error.responseText);
          });
}

function cargarDistrito(nombreCombo){
    $(nombreCombo).empty();
    
    var codigo_departamento = "";
    var codigo_provincia = "";
    
    //if (nombreCombo == "#cbodistrito"){
        codigo_departamento = $("#cbodepartamentoamodal").val();
        codigo_provincia = $("#cboprovinciamodal").val();
    //}
    
    $.post(
            "../controlador/distrito.cargar-combo.controlador.php",
            {
                p_dep: codigo_departamento,
                p_prov: codigo_provincia
            }
          )
          .done(function(resultado){
              $(nombreCombo).empty();
              $(nombreCombo).append(resultado);
          })
          .fail(function(error){
              alert(error.responseText);
          });
}

$("#cbodepartamentoamodal").change(function(){
    cargarProvincia("#cboprovinciamodal");
    cargarDistrito("#cbodistritomodal");
    //cargarDistrito();
});

$("#cboprovinciamodal").change(function(){
    cargarDistrito("#cbodistritomodal");
    //cargarDistrito();
});

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

function readOnlyEstado(){
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
};

$("#opcion_cliente").change(function (){
    readOnlyEstado();    
 //   var opcionTP = $("#opcion_cliente").val();    
});

function validarCondiciones()
{
    $('#condiciones').on('change', function(){
        $('#condiciones').val(this.checked ? 1 : 0);
    });
    console.log($("#condiciones").val());
//    if (!document.getElementById('condiciones').checked)
    if($("#condiciones").val()==0)
    {
        alert ("Debe aceptar terminos y condiciones");
        exit();
    }
}

function validarContraseña()
{
    var clave=$("#txtclave").val();
    var confirmar=$("#txtclaveconfirmar").val();
    if(clave!=confirmar)
    {
        alert ("Las contraseñas no coinciden");
        exit();
    }
}

function agregar()
{
    $("#txtcodigo").prop('readonly', true);
    $("#txtcodigo").val('');
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
    //$("#opcion_estado").val('');   
    $("#opcion_cliente").val('');   
       
    $("#txttipooperacion").val('agregar');
    
    $("#txtdireccion_web").val('');
    $("#cbodepartamentoamodal").val('');
    $("#cboprovinciamodal").val('');
    $("#cbodistritomodal").val(''); 
};

$("#frmagregar").submit(function (event)
{
    event.preventDefault();
    validarContraseña();
    validarCondiciones();
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
//                swal({
//                    title: "¡Excelente!",
//                    text: "Registro agregado correctamente." ,
//                    type: "success"
//                });            
                limpiar();               
//                $("#btnCerrarModal").click();
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

function redireccionar() {
    window.location = "../publico/register.php";
}

function limpiar() {
    $("#txtruc").val('');
    $("#txtrazonsocial").val('');
    $("#txtdni").val('');
    $("#txtnombres").val('');
    $("#txtapepaterno").val('');
    $("#txtapematerno").val('');
    $("#txtcorreo").val('');
    $("#txtclave").val('');
    $("#txttelefonofijo").val('');
    $("#txttelefonomovil").val('');
    $("#txtdireccion").val('');
}