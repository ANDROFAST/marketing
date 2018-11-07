window.onload  = function() {
    $('#formulario').css('opacity',0.4).hover(function(){
      $(this).fadeTo(200,1);
   }, function(){
      $(this).fadeTo(200,0.4);
   });
};

function ocultarMensaje(valor){
    if(valor === 1){
        $('#requerido').hide();
    }
}

function redireccionar(valor){
    if(valor === 1){
        window.location= 'resultado.php';
    }else if(valor === 2){
        window.location= 'registrar.php';
    }else if(valor === 3){
        var eliminar = confirm("Esta realmente seguro de reiniciar la encuesta?");
        if(eliminar){
            window.location= 'panelControl.php?reiniciar';
        }
    }else if(valor === 4){
        window.location= 'panelControl.php';
    }else if(valor === 5){
        window.location= 'login.php';
    }else if(valor === 6){
        window.location= 'index.php';
    }else if(valor === 7){
        window.location= 'encuesta.php';
    }  
}

function soloNumeros(e) {
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if (tecla === 8) {
		return true;
	}
	if (tecla === 46) {
		return true;
	}
	if (tecla === 44) {
		return true;
	}
	if (tecla === 40) {
		return true;
	}
	if (tecla === 41) {
		return true;
	}
	if (tecla === 180) {
		return true;
	}
	if (tecla === 193) {
		return true;
	}
	if (tecla === 201) {
		return true;
	}
	if (tecla === 205) {
		return true;
	}
	if (tecla === 211) {
		return true;
	}
	if (tecla === 218) {
		return true;
	}
	if (tecla === 225) {
		return true;
	}
	if (tecla === 233) {
		return true;
	}
	if (tecla === 237) {
		return true;
	}
	if (tecla === 243) {
		return true;
	}
	if (tecla === 250) {
		return true;
	}
	patron = /[0-9\s]/; // 4
	te = String.fromCharCode(tecla); // 5

	return patron.test(te); // 6
}

function soloLetras(e) {
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if (tecla === 8) {
		return true;
	}
	if (tecla === 46) {
		return true;
	}
	if (tecla === 44) {
		return true;
	}
	if (tecla === 40) {
		return true;
	}
	if (tecla === 41) {
		return true;
	}
	if (tecla === 180) {
		return true;
	}
	if (tecla === 193) {
		return true;
	}
	if (tecla === 201) {
		return true;
	}
	if (tecla === 205) {
		return true;
	}
	if (tecla === 211) {
		return true;
	}
	if (tecla === 218) {
		return true;
	}
	if (tecla === 225) {
		return true;
	}
	if (tecla === 233) {
		return true;
	}
	if (tecla === 237) {
		return true;
	}
	if (tecla === 243) {
		return true;
	}
	if (tecla === 250) {
		return true;
	}
	patron = /[A-Za-zñÑ\s]/; // 4
	te = String.fromCharCode(tecla); // 5

	return patron.test(te); // 6
}