<?php

    $reserva = $data['reserva'];
    echo '<div id="contenedor">
            <h2 align="center" style="color:white">Modificación de reserva</h2>
            <form action="index.php" method="post" class="formModificarReserva">
                Fecha: <br><input type="date" name="fecha" value="'.$reserva->fecha.'">';