<?php

    $instalacion = $data['instalacion'];
    $horario = $data['horas_instalacion'];
    
    echo '<div id="contenedor">
            <h2 align="center" style="color:white">Modificación de reserva</h2>
            <form action="index.php" method="post" class="formModificarReserva">
                <input type="hidden" name="precio_instalacion" value="'.$instalacion->precio.'">
                <input type="hidden" name="id_user" value="'.$_SESSION['id_user'].'">
                <input type="hidden" name="id_instalacion" value="'.$instalacion->id_instalacion.'">
                <div align="center">Instalación: '.$instalacion->nombre.'<br><img src="imgs/instalaciones/'.$instalacion->imagen.'.png" style="width:40%"><br></div>
                Fecha: <br><input type="date" name="fecha" value="2020-'.$data['mes'].'-'.$data['dia'].'" readonly><br>
                Hora: <br>
                    <table class="tablaHorarioReserva"><tr>'; 
                    echo '<select name="horas[]" class="selectReservas" size="13" multiple>';
                for ($i=$horario->hora_inicio; $i <= $horario->hora_fin; $i++) {
                        if (in_array($i,$data['horas_tomadas'])) {
                        echo '<option value="'.$i.'" class="celdaHoraBloqueada" id="'.$i.'" onclick="validarSeleccionarHora('.$i.')" disabled>'.$i.':00</td>';
                    } else {
                        echo '<option value="'.$i.'" id="'.$i.'" class="noSeleccionada" onclick="validarSeleccionarHora('.$i.')">'.$i.':00</td>';
                    }
                    
                }
   
    echo '</select>';
    echo '</tr></table><br>
    <h3>Precio:</h3>
    <input id="precio" type="text" name="precio" step="any" readonly>€<br><br>
    <input type="hidden" name="action" value="crearReserva">
    <input type="submit" value="Crear reserva" class="btn btn-primary mb-2">';