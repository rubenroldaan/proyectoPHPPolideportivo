<?php

    $reserva = $data['reserva'];
    $horario = $data['horas_instalacion'];
    var_dump($data['reservas_instalacion_mismo_dia']);
    echo '<br>';
    var_dump($data['horas_tomadas']);
    echo '<div id="contenedor">
            <h2 align="center" style="color:white">Modificación de reserva</h2>
            <form action="index.php" method="post" class="formModificarReserva">
                Fecha: <br><input type="date" name="fecha" value="'.$reserva->fecha.'"><br>
                Hora: <br>
                    <table class="tablaHorarioReserva"><tr>';
                for ($i=$horario->hora_inicio; $i <= $horario->hora_fin; $i++) {
                    if (in_array($i,$data['horas_tomadas'])) {
                        echo '<td class="celdaHoraTomada" onclick="prohibirSeleccionarHora()">'.$i.'</td>';
                    } else {
                        echo '<td class="celdaHoraNoTomada" onclick="validarSeleccionarHora()">'.$i.'</td>';
                    }
                    
                }