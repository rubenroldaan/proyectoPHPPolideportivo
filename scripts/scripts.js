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
	peticion_http.onreadystatechange = procesar_correo;
	correo = document.getElementById("correo").value;
	peticion_http.open('GET','http://localhost/egho/index.php?action=comprobarCorreo&mail=' + correo,true);
	peticion_http.send(null)
	console.log("hola")
}

function procesar_correo() {
	if (peticion_http.readyState == 4) {
		if (peticion_http.status == 200) {
			if (peticion_http.responseText == "1") {
				document.getElementById("errorCorreo").innerHTML = 'Ya existe una cuenta con este correo.';
			} else if (peticion_http.responseText == "0") {
				document.getElementById("errorCorreo").innerHTML = '';
				console.log("ok")
			}
		}
	}
}

function mostrar_reservas_en_calendario_mes1(dia, mes) {
	peticion_http = new XMLHttpRequest();
	peticion_http.onreadystatechange = procesar_reservas;
	user = document.getElementById("id_user");
	peticion_http.open("GET",'http://localhost/egho/index.php?action=mostrarReservasSobreDiaCalendario&id_user=' + user + '&mes=' + mes + '&dia=' + dia, true);
	peticion_http.send(null)
	console.log(dia)
}


function procesar_reservas() {
	if (peticion_http.readyState == 4) {
		if (peticion_http.status == 200) {
			if (peticion_http.responseText != null) {
				divsDias = document.getElementsByClassName("diaConReserva");
				for (var i = 0; i < divsDias.length; i++) {
					divsDias[i].title = 'Existe ' + peticion_http.responseText + ' reserva/s.';
				}
			}
		}
	}
}

function crearDiv() {
	console.log(this.title)
}

function prohibirSeleccionarHora() {
	alert("¡Ya existen reservas a esta hora!");
}

function validarSeleccionarHora() {
	
}