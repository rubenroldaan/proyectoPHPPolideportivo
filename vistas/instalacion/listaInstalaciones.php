<?php

    $cont = 0;
    echo '<div id="contenedor">';

    echo '<a href="index.php?action=formInsertarInstalacion"><img src="imgs/button-new.png" class="botonNuevo" alt="Boton nueva instalacion" title="Nueva instalacion"></a>';

    if (isset($data['msjInfo'])) {
        echo '<p style="color:green">'.$data['msjInfo'].'</p>';
    }
    if (isset($data['msjError'])) {
        echo '<p style="color:red">'.$data['msjError'].'</p>';
    }
        echo '<table id="tablaInstalaciones">';

    foreach($data['lista_instalaciones'] as $instalacion) {
        if ($cont % 2 == 0) {
            echo '<tr>';
        }
        echo '<td>
                <p>'.$instalacion->nombre.' (<strong>'.$instalacion->precio.'€</strong>)</p>
                <table>
                <tr><td>
                <img src="imgs/instalaciones/'.$instalacion->imagen.'.png" class="imagenInstalacion" onclick="$(\'.celdaModificarInstalacion'.$instalacion->id_instalacion.'\').toggle();$(\'.nombreInstalacion'.$instalacion->id_instalacion.'\').toggle();"><br></td>
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