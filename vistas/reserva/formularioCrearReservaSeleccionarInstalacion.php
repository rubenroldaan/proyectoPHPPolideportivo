<?php

    echo '<div id="contenedor">
            <h2 align="center" style="color:white">Añadir una reserva</h2>
            <form action="index.php" method="post" class="formCrearReserva">
                <label for="instalacion">Selecciona una instalación</label><br>
                <select name="instalacion" id="instalacion" required>
                    <option hidden selected>Selecciona uno...</option>';
                foreach($data['lista_instalaciones'] as $instalacion) {
                    echo '<option value="'.$instalacion->id_instalacion.'" onclick="mostrarImagenInstalacion('.$instalacion->id_instalacion.')">'.$instalacion->nombre;
                }
                echo '</select><br><br>';
                echo '<img src="imgs/fondo-blanco.png" id="imagen" title="Imagen de la instalacion"><br><br><br>
                <input type="hidden" name="action" value="formCrearReserva">
                <input type="submit" value="Continuar reserva" class="btn btn-primaryy mb-2">';

            echo '</form>';