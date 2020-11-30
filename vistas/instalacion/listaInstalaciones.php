<?php

    $cont = 0;
    echo '<div id="contenedor">
        <table id="tablaInstalaciones">';

    foreach($data['lista_instalaciones'] as $instalacion) {
        if ($cont % 2 == 0) {
            echo '<tr>';
        }
        echo '<td>
                <img src="imgs/instalaciones/'.$instalacion->imagen.'" class="imagenInstalacion"><br>
                '.$instalacion->nombre.'
              </td>';
        $cont++;

        if ($cont % 2 == 0) {
            echo '</tr>';
        }
    }
    echo '</div>';