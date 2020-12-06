<?php

    echo '<div id="contenedor">';
            if (!is_array($data['lista_reservas'])) {
                echo '<p style="color:red">No se han encontrado reservas. <a href="index.php?action=formCrearReserva">Crear reserva.</a></p>';
            } else {
                echo '<table id="reservas" cellspacing="0">
                        <thead class="theadReservas">
                            <th>Fecha</th>
                            <th>Hora de inicio</th>
                            <th>Hora de fin</th>
                            <th>Precio</th>
                            <th>Instalación</th>';
                if ($_SESSION['rol_user'] == 'A') {
                    echo '<th>Usuario</th>';
                }
                        echo '</thead>';
            }
    echo '</div>';