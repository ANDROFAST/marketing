
$(document).ready(function(){
    cargarComboTE("#cboevento", "seleccione");
    listarPedido(); 
    resumen();  
    
  //  total();
});


function cargarComboTE(p_nombreCombo, p_tipo){
    $.post
    (
    "../controlador/tipo.evento.cargar.combo.controlador.php"
    ).done(function(resultado){
    var datosJSON = $.parseJSON( JSON.stringify(resultado) );
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione un tipo de evento</option>';
            }else{
                html += '<option value="0">Todos los tipos de eventos</option>';
            }

            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.codigo_tipo_evento+'">'+item.descripcion+'</option>';
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

//var cajaTexto;
var array_codigo_lista;
function listarPedido(){
    var articulos = localStorage.getItem("articulos");
    var productos = articulos.split(";");
        
    for( var i = 0; i < productos.length - 1; i++ ){
        var item = productos[i].split(",");
        var pedido = "";        
      //  var codigo_articulo_lista;
        for( var j = 0; j < item.length; j++ ){            
            //se tiene que capturar el codigo del item[4] luego agregarlo a una lista-array para realizar una busqueda del nuevo valor que aparezca y así mostrar la nueva cantidad 
          /*
            codigo_articulo_lista=item[4];
            var objDetalle = new Object();            
            objDetalle.codigo_articulo_lista=codigo_articulo_lista;
             array_codigo_lista.push(objDetalle);                 
             console.log("ARCCLL -- "+array_codigo_lista);
            */
                //convierte arrayDetalle a JSON
                //var jsonDetalle = JSON.stringify(arrayDetalle);
            pedido = '<tr id='+i+'>'+
                    '<td class="hidden">'+ item[4] + '</td>' +
                    '<td class="text-center">'+ '<img style="width: 100px; height: 100px" src="' + item[0] + '"/></td>' +
                    '<td style="text-align:left;"><b>'+ item[1].toUpperCase() + '<br><br><br><br></b></td>' +                    
                    '<td id="precio'+i+'" style="text-align:right; color:red; font-weight: bold;">S/.'+ item[2] + '</td>' +
                    '<td class="text-center" style="font-weight: bold;" id="ccant'+i+'">'
                    + '<input onkeyup="ActualizarValor(this);" onchange="ActualizarValor(this);" style="font-weight: bold;" type="number" name="txtcant'+i+'" id="txtcant'+i+'" min="1" max="15" value="'+ item[3] +'" class="form-control">' + 
                    '</td>'+
                    '<td id="td_'+i+'" style="text-align:right;" style="font-weight: bold;" ><b>'+ 'S/.'+ (item[2]*item[3]).toFixed(2) + '</b></td>'+
                    '<td align="center" id="celiminar"><a href="javascript:void();"><button class="btn btn-danger btn-xs delete">Eliminar</button></a></td></tr>';
        }   
        $("#detallePedido").append(pedido);  
    }
} 

function ActualizarValor(va){
    
        var recibirValor=va.id; 
        $(document).on('change','#'+va.id, function(){
	//console.log("entro");
        
        var i = recibirValor.substring(7);
            var codigo=0,a=3,cant=4,imp=5;
            //control de datos precio  || actualización de cantidad e importe
            if(i==0){
                codigo;
                a;
                cant;
                imp;
            }
            if(i==1){
                codigo=7;
                a=10;
                cant=11;
                imp=12;
            }
            if(i==2){
                codigo=14;
                a=17;
                cant=18;
                imp=19;
            }
            if(i==3){
                codigo=21;
                a=24;
                cant=25;
                imp=26;
            }
            if(i==4){
                codigo=28;
                a=31;
                cant=32;
                imp=33;
            }
            if(i==5){
                codigo=35;
                a=38;
                cant=39;
                imp=40;
            }
            if(i==6){
                codigo=42;
                a=45;
                cant=46;
                imp=47;
            }
            if(i==7){
                codigo=49;
                a=52;
                cant=53;
                imp=54;
            }
            if(i==8){
                codigo=56;
                a=59;
                cant=60;
                imp=61;
            }
            if(i==9){
                codigo=63;
                a=66;
                cant=67;
                imp=68;
            }
            if(i==10){
                codigo=70;
                a=73;
                cant=74;
                imp=75;
            }
            if(i==11){
                codigo=77;
                a=80;
                cant=81;
                imp=82;
            }
            if(i==12){
                codigo=84;
                a=87;
                cant=88;
                imp=89;
            }        
      /*  
         var articulosACT = localStorage.getItem("articulos");
         var productosACT = articulosACT.split(";");
           for( var i = 0; i < productos.length - 1; i++ ){
        var item = productosACT[i].split(",");

            pedidoACTUALIZARVALOR += item[0] +','+ item[1] +','+ item[2] +','+ item[3] +','+ item[4] +';';

    }
    */
            var cantidad = $(this).val();
            var precio = parseFloat(($('#detallePedido td:eq('+a+')').html()).substring(3));
            var importe = parseFloat(precio) * cantidad;                 
            
            $("#detallePedido td:eq("+imp+")").html("<b>S/."+(importe).toFixed(2)+"</b>"); 
           
           if(cantidad.length==0){        
                $("#detallePedido td:eq("+cant+")").html('<input onkeyup="ActualizarValor(this);" onchange="ActualizarValor(this);" style="font-weight: bold;" type="number" name="'+recibirValor+'" id="'+recibirValor+'" min="1" max="15" value="'+ 1 +'" class="form-control">');
                $("#"+recibirValor+"").focus();     
               // resumen();
           }else{            
                $("#detallePedido td:eq("+cant+")").html('<input onkeyup="ActualizarValor(this);" onchange="ActualizarValor(this);" style="font-weight: bold;" type="number" name="'+recibirValor+'" id="'+recibirValor+'" min="1" max="15" value="'+ cantidad +'" class="form-control">');
                var articulos = localStorage.getItem("articulos");
                console.log("ARTICULOS PRE FOR: "+articulos);
                var productos = articulos.split(";");
                //modificar IF incluir código en cada condición, sólo se ha incluido para 3 productos, falta completar
                console.log("Codigo celda "+ $("#detallePedido td:eq("+codigo+")").html());
                var codigoCelda=$("#detallePedido td:eq("+codigo+")").html();                
                var pedidoACTUALIZARVALOR="";
                var pedidoACTUALIZARVALOR_SC="";
                var pedidoACTUALIZARVALOR_CC="";
                for( var i = 0; i < productos.length - 1; i++ ){
                    var item = productos[i].split(",");
                    
                    if(item[4]==codigoCelda){
                        pedidoACTUALIZARVALOR_CC = item[0] +','+ item[1] +','+ item[2] +','+ cantidad +','+ item[4] +';';
                        console.log("condicion codigo celda: "+pedidoACTUALIZARVALOR_CC);
                    }else{
                        pedidoACTUALIZARVALOR_SC += item[0] +','+ item[1] +','+ item[2] +','+ item[3] +','+ item[4] +';';
                        console.log("condicion sin cod celda: "+pedidoACTUALIZARVALOR_SC);
                    }                    
                    
                }
                pedidoACTUALIZARVALOR=pedidoACTUALIZARVALOR_CC+pedidoACTUALIZARVALOR_SC;
                
                localStorage.removeItem("articulos");
                console.log(pedidoACTUALIZARVALOR);
                localStorage.setItem("articulos", pedidoACTUALIZARVALOR);
                
              //   resumen();
           }           
            resumen();
	}) ;

 $(document).on('keyup','#'+va.id, function(){
	//console.log("entro");
        
        var i = recibirValor.substring(7);
            var codigo=0, a=3,cant=4,imp=5;
            //control de datos precio  || actualización de cantidad e importe
            if(i==0){
                codigo;
                a;
                cant;
                imp;
            }
            if(i==1){
                codigo=7;
                a=10;
                cant=11;
                imp=12;
            }
            if(i==2){
                codigo=14;
                a=17;
                cant=18;
                imp=19;
            }
            if(i==3){
                codigo=21;
                a=24;
                cant=25;
                imp=26;
            }
            if(i==4){
                codigo=28;
                a=31;
                cant=32;
                imp=33;
            }
            if(i==5){
                codigo=35;
                a=38;
                cant=39;
                imp=40;
            }
            if(i==6){
                codigo=42;
                a=45;
                cant=46;
                imp=47;
            }
            if(i==7){
                codigo=49;
                a=52;
                cant=53;
                imp=54;
            }
            if(i==8){
                codigo=56;
                a=59;
                cant=60;
                imp=61;
            }
            if(i==9){
                codigo=63;
                a=66;
                cant=67;
                imp=68;
            }
            if(i==10){
                codigo=70;
                a=73;
                cant=74;
                imp=75;
            }
            if(i==11){
                codigo=77;
                a=80;
                cant=81;
                imp=82;
            }
            if(i==12){
                codigo=84;
                a=87;
                cant=88;
                imp=89;
            }        
        
            var cantidad = $(this).val();
            var precio = parseFloat(($('#detallePedido td:eq('+a+')').html()).substring(3));
            var importe = parseFloat(precio) * cantidad;                             
            $("#detallePedido td:eq("+imp+")").html("<b>S/."+(importe).toFixed(2)+"</b>");            
           if(cantidad.length==0){        
                $("#detallePedido td:eq("+cant+")").html('<input onkeyup="ActualizarValor(this);" onchange="ActualizarValor(this);" style="font-weight: bold;" type="number" name="'+recibirValor+'" id="'+recibirValor+'" min="1" max="15" value="'+ 1 +'" class="form-control">');
                $("#"+recibirValor+"").focus();     
          //      resumen();
           }else{                
                $("#detallePedido td:eq("+cant+")").html('<input onkeyup="ActualizarValor(this);" onchange="ActualizarValor(this);" style="font-weight: bold;" type="number" name="'+recibirValor+'" id="'+recibirValor+'" min="1" max="15" value="'+ cantidad +'" class="form-control">');
                var articulos = localStorage.getItem("articulos");
                console.log("ARTICULOS PRE FOR: "+articulos);
                var productos = articulos.split(";");
                //modificar IF incluir código en cada condición, sólo se ha incluido para 3 productos, falta completar
                console.log("Codigo celda "+ $("#detallePedido td:eq("+codigo+")").html());
                var codigoCelda=$("#detallePedido td:eq("+codigo+")").html();                
                var pedidoACTUALIZARVALOR="";
                var pedidoACTUALIZARVALOR_SC="";
                var pedidoACTUALIZARVALOR_CC="";
                for( var i = 0; i < productos.length - 1; i++ ){
                    var item = productos[i].split(",");
                    
                    if(item[4]==codigoCelda){
                        pedidoACTUALIZARVALOR_CC = item[0] +','+ item[1] +','+ item[2] +','+ cantidad +','+ item[4] +';';
                        console.log("condicion codigo celda: "+pedidoACTUALIZARVALOR_CC);
                    }else{
                        pedidoACTUALIZARVALOR_SC += item[0] +','+ item[1] +','+ item[2] +','+ item[3] +','+ item[4] +';';
                        console.log("condicion sin cod celda: "+pedidoACTUALIZARVALOR_SC);
                    }                    
                    
                }
                pedidoACTUALIZARVALOR=pedidoACTUALIZARVALOR_CC+pedidoACTUALIZARVALOR_SC;
                localStorage.removeItem("articulos");
                console.log(pedidoACTUALIZARVALOR);
                localStorage.setItem("articulos", pedidoACTUALIZARVALOR);
            //     resumen();
           }           
            resumen();
	}) ;
//$("#"+recibirValor+"").focus();     
    resumen();
}

function validar(){ 
    var value = $("#cboevento").val();
    if(value==='-1')
    {
        alert('SELECCIONE EL TIPO DE EVENTO');
        $("#cboevento").attr('onfocus');
        exit();
    }
};


var productos;
var pedidoLS;
$(document).on("click", "#celiminar", function(){
    if ( ! confirm("Esta seguro de eliminar el registro")){
       return 1;
    }
   
 //   var registro = $(this).parents().get(0); //Capturar el registro
    var registro = $(this).parents('tr'); //Capturar el registro    
    //console.log(registro.attr('id'));      
    registro.remove(); 
    var articulos = localStorage.getItem("articulos");   
    productos = articulos.split(";");    
    var indice=registro.attr('id');
    productos.splice(indice,1)
    console.log(productos);
 
    localStorage.removeItem('articulos');
    console.log('desp-'+productos);
   
    for( var i = 0; i < productos.length - 1; i++ ){
        var item = productos[i].split(",");
         var nueva_cantidad= $("#txtcant"+i+"").val();     
         pedidoLS += item[0] +','+ item[1] +','+ item[2] +','+ nueva_cantidad +','+ item[4] +';';
         
    }
    
    console.log('pedi-'+pedidoLS);
    localStorage.setItem('articulos',pedidoLS);
    //listarPedido();
    resumen();
 //   window.location.reload(true);
   
});

function resumen(){
    /*resumen del pedido*/
    var nro = 0;
    var costo = 0.0;
    var dsct = 0.0;
    var total = 0.0;
    
    $("#detallePedido tr").each(function(){
        var importe = $(this).find("td").eq(5).text();
        var unitario = importe.substring(3);
        costo += parseFloat(unitario);
        //nro = $(this).find("td").eq(3).html();     
        nro++;
    //    console.log("IMPORTE -- "+ importe);
    });
    total = costo - dsct;
  //  console.log('total--'+total);
    $("#lblnro").html(nro);
    $("#lblnum").html(nro);
    $("#lblct").html(costo.toFixed(2));
    $("#lbldsct").html(dsct.toFixed(2));
    $("#lbltl").html(total.toFixed(2));
}
//Para almacenar todos los articulos de la venta
var arrayDetalle = new Array();
var total=0;
$("#btnnext").click(function(){
    validar();
    if( parseInt($("#txtlogincliente").val()) === 0 ){//si todavia no inicia sesion abre el login
        $("#myModalIS").modal();
    }
    else{
       // document.location.href = "../publico/cliente.entrega.vista.php";
         swal({
        title: "Confirme",
        text: "¿Esta seguro de solicitar el pedido?",
        
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
                var item=0;
                //procedo a grabar
                //Capturar todos los datos necesarios para registrar
                    if( $("#cboevento").val() === "" ){
                        swal("Mensaje", "Debe seleccionar un tipo de evento", "warning");
                        return 0;
                    }
                    
                    if( $("#txteventodirigidoa").val() === "" ){
                        swal("Mensaje", "Debe indicar para quién será el evento", "warning");
                        return 0;
                    }
                    
                    if( $("#txtfechevent").val() === "" ){
                        swal("Mensaje", "Debe indicar la fecha del evento", "warning");
                        return 0;
                    }
                    
                    if( $("#txtdireccionevento").val() === "" ){
                        swal("Mensaje", "Debe indicar la dirección donde se realizará el evento", "warning");
                        return 0;
                    }
                    
                    
                    
                  var articulos = localStorage.getItem("articulos");   
                  var articulos_separados = articulos.split(";"); 
                    
                    
                arrayDetalle.splice(0, arrayDetalle.length);//limpiar array
                //Recorrer cuerpo de la tabla
                //console.log(arrayDetalle);
                 for( var i = 0; i < articulos_separados.length - 1; i++ ){
                      var elementos = articulos_separados[i].split(",");
                  //   console.log("DATOS REGISTRO - "+ articulos_separados[i]);
                     console.log(elementos[0]+"-"+elementos[1]+"-"+elementos[2]+"-"+elementos[3]+"-"+elementos[4]);
                     
                    var codigoArticulo = elementos[4];
                    var precioArticulo = elementos[2];
                    var cantidad = elementos[3];
                    var descuento = 0;
                    var importe = cantidad*precioArticulo;
                    item=item+1;
                    total=total+importe;
                    var objDetalle = new Object();
                    objDetalle.codigoArticulo = codigoArticulo;
                    objDetalle.precioArticulo = precioArticulo;
                    objDetalle.cantidad = cantidad;
                    objDetalle.descuento = descuento;
                    objDetalle.importe = importe;
                    objDetalle.item = item;
                    arrayDetalle.push(objDetalle);
                    
                 }
                
                //convierte arrayDetalle a JSON
                var jsonDetalle = JSON.stringify(arrayDetalle);
                
                console.log("json ------ "+jsonDetalle);
                console.log("formularios ------ "+$("#frmgrabar").serialize());
                console.log("TOTAL---"+total);
         
                $.post(
                    "../controlador/pedido.publico.agregar.controlador.php",
                    {
                        p_datosFormulario: $("#frmgrabar").serialize(),
                        p_datosJsonDetalle: jsonDetalle,
                        p_total:total
                    }
                  ).done(function(resultado){                    
              var datosJSON = resultado;

                      if (datosJSON.estado === 200){
              swal({
                                title: "Exito",
                                text: datosJSON.mensaje,
                                type: "success",
                                showCancelButton: false,
                                //confirmButtonColor: '#3d9205',
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                            },
                            function(){
                                localStorage.removeItem('articulos');
                                document.location.href="publico.principal.vista.php";
                                window.open("../publico/cart.php");
                            });
                      }else{
                          swal("Mensaje del sistema", resultado , "warning");
                      }

                  }).fail(function(error){
            var datosJSON = $.parseJSON( error.responseText );
            swal("Error", datosJSON.mensaje , "error");
                  }) ;
         
         
         /*************/
            }
    });    
    }
});

/*
function total(){
    //var arrayDetallePedido = new Array();
    //arrayDetallePedido.splice(0, arrayDetallePedido.length);//limpiar array
    
    $("#detallePedido tr").each(function(){
                    var codigoArticulo = $(this).find("td").eq(3).text();
                    /*var precioArticulo = $(this).find("td").eq(2).html();
                    var cantidad = $(this).find("td").eq(3).html();
                    var importe = $(this).find("td").eq(4).html();
                    
                    var objDetalle = new Object();
                    objDetalle.codigoArticulo = codigoArticulo;
                    objDetalle.precioArticulo = precioArticulo;
                    objDetalle.cantidad = cantidad;
                    objDetalle.importe = importe;
                    
                    arrayDetallePedido.push(objDetalle);
        //alert(codigoArticulo);
                });
    
    
}*/