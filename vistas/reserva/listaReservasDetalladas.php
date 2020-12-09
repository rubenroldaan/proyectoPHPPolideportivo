<?php

    echo '<div id="contenedor">';
            
            echo '<table id="reservas" cellspacing="0">
                    <h2 align="center" style="color:white;">Gestión de reservas</h2>
                    <a href="index.php?action=formCrearReservaSeleccionarInstalacion&dia='.$_REQUEST['dia'].'&mes='.$_REQUEST['mes'].'"><img src="imgs/button-new.png" class="botonNuevo" alt="Boton nueva reserva" title="Nueva reserva"></a>
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
            echo '<tbody class="tbodyReservas">';

            if (!is_array($data['lista_reservas'])) {
                echo '<p style="color:red">No se han encontrado reservas. <a href="index.php?action=formCrearReservaSeleccionarInstalacion&dia='.$_REQUEST['dia'].'&mes='.$_REQUEST['mes'].'">Crear reserva.</a></p>';
            } else {
                foreach($data['lista_reservas'] as $reserva) {
                    echo '<tr class="filaReserva">
                            <td>'.$reserva->fecha.'</td>
                            <td>'.$reserva->hora_inicio.':00</td>
                            <td>'.$reserva->hora_fin.':00</td>
                            <td>'.$reserva->precio.'€</td>
                            <td>'.$reserva->nombre_instalacion.'</td>
                            <td>'.$reserva->DNI.'</td>
                            <td class="celdaModificar">
                                <a href="index.php?action=formModificarReserva&id_reserva='.$reserva->id_reserva.'">
                                <img src="imgs/button-edit.png" class="botonModificar" alt="Boton modificar reserva" title="Modificar reserva">  
                                </a>
                            </td>
                            <td class="celdaEliminar">
                                <a href="index.php?action=confirmacionBorrarReserva&id_reserva='.$reserva->id_reserva.'">
                                <img src="imgs/button-cancelar.png" class="botonCancelar" alt="Boton eliminar reserva" title="Cancelar reserva">  
                                </a>
                            </td>
                          </tr>';
                    echo '<tr class="filaEspacio"><td>&nbsp;</td></tr>';
                }
            }
    echo '</div>';