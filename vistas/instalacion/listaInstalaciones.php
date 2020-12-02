<?php

    $cont = 0;
    echo '<div id="contenedor">
        <table id="tablaInstalaciones">';

    foreach($data['lista_instalaciones'] as $instalacion) {
        if ($cont % 2 == 0) {
            echo '<tr>';
        }
        echo '<td>
                <p>'.$instalacion->nombre.'</p>
                <table>
                <tr><td>
                <img src="imgs/instalaciones/'.$instalacion->imagen.'" class="imagenInstalacion" onclick="$(\'.celdaModificarInstalacion'.$instalacion->id_instalacion.'\').toggle();$(\'.nombreInstalacion'.$instalacion->id_instalacion.'\').toggle();"><br></td>
                <td class="celdaModificarInstalacion'.$instalacion->id_instalacion.'">
                <table>
                <tr style="height:50%">
                <a href="index.php?action=formModificarInstalacion&id_instalacion='.$instalacion->id_instalacion.'">
                <button class="botonModificarInstalacion">Modificar</button>
                </a>
                </tr>
                <tr style="height:50%">
                <a href="index.php?action=confirmacionBorrarInstalacion&id_instalacion='.$instalacion->id_instalacion.'">
                <button class="botonEliminarInstalacion">Eliminar</button>
                </a>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                
              </td>';
        $cont++;

        if ($cont % 2 == 0) {
            echo '</tr>';
        }
    }
    echo '</div>';