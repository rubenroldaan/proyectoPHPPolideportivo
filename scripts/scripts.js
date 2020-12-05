/*var validarCampoNIF = function(){
	var es_nif = true;
	var campo_nifP = document.getElementById("dni").value;
	if(campo_nifP.length != 9){
			es_nif = false;
	}
	if(es_nif){
		for(var i = 0; i < 8; i++){
			if(!$.isNumeric(campo_nifP[i])){
				es_nif = false;
			}
		}
	}
	if(es_nif){
		if($.isNumeric(campo_nifP[8])){
			es_nif = false;
		}
	}
	return es_nif;
}

function validar() {
    if (validarCampoNIF) {
		document.getElementById("errorDNI").innerHTML = 'DNI no válido.';
		console.log("no")
    }
	else {
		document.getElementById("errorDNI").innerHTML = ' ';
		console.log("si")
	}
}*/

function validar_correo() {
	peticion_http = new XMLHttpRequest();
	peticion_http.onreadystatechange = procesa_respuesta();
	correo = document.getElementById("correo").value;
	peticion_http.open('GET','http://localhost/egho/index.php?action=comprobarCorreo&mail=' + correo,true);
	peticion_http.send(null)
	console.log("hola")
}

function procesa_respuesta() {
	if (peticion_http.readyState == 4) {
		if (peticion_http.status == 200) {
			if (peticion_http.responseText == "1") {
				document.getElementById("errorCorreo").innerHTML = 'Ya existe una cuenta con este correo.';
			} else if (peticion_http.responseText == "0") {
				console.log("ok")
			}
		}
	}
}