<?php 

    //------------------------------------------OPERACIONES PARA SACAR CALENDARIO--------------------------
    $month = date("n");
    $mesSiguiente = $month+1;
    if ($mesSiguiente == 13) {$mesSiguiente=1;}
    $year = date("Y");
    $yearSiguiente = $year;
    if ($mesSiguiente == 1) {$yearSiguiente+=1;}
    $diaActual = date("j");
    $diaSemana = date("w", mktime(0, 0, 0, $month, 1, $year)) + 7;
    $diaSemanaMesSiguiente = date("w", mktime(0, 0, 0, $mesSiguiente, 1, $yearSiguiente)) + 7;
    $ultimoDiaMes = date("d", (mktime(0, 0, 0, $month + 1, 1, $year) - 1));
    $ultimoDiaMesSiguiente = date("d", (mktime(0, 0, 0, $mesSiguiente + 1, 1, $yearSiguiente) - 1));
    $ultimoDiaMesSiguiente = date("d", (mktime(0, 0, 0, $mesSiguiente + 1, 1, $yearSiguiente) - 1));

    $meses = array('', "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $monthString = $meses[$month];
    $mesSiguienteString = $meses[$mesSiguiente];
    //----------------------------------------------------------------------------------------------------
    


    echo '<div id="contenedor">';
    echo '<div id="mes1" style="display:none">'.$month.'</div>';
    echo '<div id="mes2" style="display:none">'.$mesSiguiente.'</div>';
    echo '<table id="calendarios">
    <tr><td>';
    echo '<table id="calendar1">
        <div class="fechaCalendar1">'.$monthString.' '.$year.'</div>
        <tr>
            <th>L</th><th>M</th><th>X</th><th>J</th>
            <th>V</th><th>S</th><th>D</th>
        </tr>
        <tr>';
            $last_cell = $diaSemana + $ultimoDiaMes;
            for ($i = 1; $i <= 42; $i++) {
                if ($i == $diaSemana) {
                    // determinamos en que dia empieza
                    $day = 1;
                }
                if ($i < $diaSemana || $i >= $last_cell) {
                    // celca vacia
                    echo "<td>&nbsp;</td>";
                } else {
                    // mostramos el dia
                    if ($day == $diaActual) {
                        echo "<td id='$day' class='hoy'>";
                    } else {
                        echo "<td id='$day'>";
                    }
                    if (is_array($data['lista_reservas'])) {
                        // EN ESTE ARRAY SE GUARDAN LOS DIAS QUE SE HAN ESCRITO RESERVAS PARA QUE ASI,
                        // SI EN UN MISMO DIA HAY MAS DE UNA RESERVA, NO SE REESCRIBA SOBRE EL.
                        $reservasEscritas = array();
                        foreach($data['lista_reservas'] as $reserva) {
                            $diaFecha = substr($reserva->fecha, -2);
                            $mesFecha = substr($reserva->fecha, 6,7);
                            if (strlen($month) == 1) {
                                $month = '0'.$month;
                            }
                            if (strlen($day) == 1) {
                                $day = '0'.$day;
                            }
                            if ($day == substr($reserva->fecha, -2) && $month == substr($reserva->fecha, 5,2) && !in_array(substr($reserva->fecha, -2), $reservasEscritas)) {
                                $reservasEscritas[] = substr($reserva->fecha, -2);
                                echo '<div class="diaConReserva" onmouseover="mostrar_reservas_en_calendario_mes1('.$day.','.$month.')">';
                            }
                        }
                    }
                    echo $day.'</div></td>';

                    
                    $day++;
                }
                // cuando llega al final de la semana, iniciamos una columna nueva
                if ($i % 7 == 0) {

                    echo "</tr><tr>\n";
                }
            }

        echo '</tr>

    </table>
    </td><td></td>';

    echo '
    <td>
    <table id="calendar2">
        <div class="fechaCalendar2">'.$mesSiguienteString.' '.$yearSiguiente.'</div>
        <tr>
            <th>L</th><th>M</th><th>X</th><th>J</th>
            <th>V</th><th>S</th><th>D</th>
        </tr>
        <tr>';
        $last_cell = $diaSemanaMesSiguiente + $ultimoDiaMesSiguiente;
        for ($i = 1; $i <= 42; $i++) {
            if ($i == $diaSemanaMesSiguiente) {
                // determinamos en que dia empieza
                $day = 1;
            }
            if ($i < $diaSemanaMesSiguiente || $i >= $last_cell) {
                // celca vacia
                echo "<td>&nbsp;";
            } else {
                // mostramos el dia
                    echo "<td>$day";
                    if (is_array($data['lista_reservas'])) {
                        $reservasEscritas = array();
                        foreach($data['lista_reservas'] as $reserva) {
                            $diaFecha = substr($reserva->fecha, -2);
                            $mesFecha = substr($reserva->fecha, 6,7);
                            if (strlen($mesSiguiente) == 1) {
                                $mesSiguiente = '0'.$mesSiguiente;
                            }
                            if (strlen($day) == 1) {
                                $day = '0'.$day;
                            }
                            if ($day == substr($reserva->fecha, -2) && $mesSiguiente == substr($reserva->fecha, 5,2)) {
                                echo 'p';
                            }
                        }
                    }
                
            }
            $day++;
            echo '</td>';
            // cuando llega al final de la semana, iniciamos una columna nueva
            if ($i % 7 == 0) {

                echo "</tr><tr>\n";
            }
        }
        echo '</tr>';
    
    echo '</table>
    </td></tr></table>';

    /*id = this.parentNode.id;
                                    var div = document.createElement(\'div\');
                                    div.setAttribute(\'id\', \''.$day.'\');
                                    this.parentNode.appendChild(div);
                                " onmouseout="
                                    this.parentNode.removeChild(this.parentNode.lastChild)*/