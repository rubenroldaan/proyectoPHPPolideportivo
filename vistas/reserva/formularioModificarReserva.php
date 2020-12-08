<?php

    $reserva = $data['reserva'];
    $instalacion = $data['instalacion'];
    $horas_reserva = array();
    for ($i=$reserva->hora_inicio; $i <= $reserva->hora_fin; $i++) { 
        $horas_reserva[] = $i;
    }
    $horario = $data['horas_instalacion'];
    
    echo '<div id="contenedor">
            <h2 align="center" style="color:white">Modificación de reserva</h2>
            <form action="index.php" method="post" class="formModificarReserva">
                <input type="hidden" name="id_reserva" value="'.$reserva->id_reserva.'">
                <input type="hidden" name="precio_instalacion" value="'.$instalacion->precio.'">
                <div align="center">Instalación: '.$instalacion->nombre.'<br><img src="imgs/instalaciones/'.$instalacion->imagen.'.png" style="width:40%"><br></div>
                Fecha: <br><input type="date" name="fecha" value="'.$reserva->fecha.'"><br>
                Hora: <br>
                    <table class="tablaHorarioReserva"><tr>'; 
                    echo '<select name="horas[]" class="selectReservas" size="13" multiple>';
                for ($i=$horario->hora_inicio; $i <= $horario->hora_fin; $i++) {
                   
                    if (in_array($i,$data['horas_tomadas'])) {
                        echo '<option value="'.$i.'" class="celdaHoraBloqueada" id="'.$i.'" onclick="prohibirSeleccionarHora()" disabled>'.$i.':00</td>';
                    } else if (!in_array($i,$data['horas_tomadas']) && in_array($i,$horas_reserva)){
                        echo '<option value="'.$i.'" class="seleccionada" id="'.$i.'" onclick="validarSeleccionarHora('.$i.')" selected>'.$i.':00</td>';
                    } else {
                        echo '<option value="'.$i.'" id="'.$i.'" class="noSeleccionada" onclick="validarSeleccionarHora('.$i.')">'.$i.':00</td>';
                    }
                }
   
    echo '</select>';
    echo '</tr></table><br>
    <h3>Precio:</h3>
    <input id="precio" type="text" name="precio" value="'.$reserva->precio.'" step="any" readonly>€<br><br>
    <input type="hidden" name="action" value="modificarReserva">
    <input type="submit" value="Modificar reserva" class="btn btn-primary mb-2">';