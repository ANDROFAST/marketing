$(document).ready(function () {
    cargarTipoClientereporte();
});

$(document).on('change','#rbtipo', function(){ 
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 
    var today = yyyy+'-'+mm+'-'+dd;
//    document.getElementById("txtfecha1").value = today;
    var value = $(this).val();
    console.log(value);
    if(value==='1')
    {
        document.getElementById("txtfecha1").value = today;
    }else if(value==='3')
    {
        document.getElementById("txtfecha1").value = today;
    }
});

function cargarTipoClientereporte()
{
    $("#opcion_cliente").load("../controlador/Cliente.controlador.php?action=2");
}
