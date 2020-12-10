<?php
    if (isset($data['msjInfo'])) {
        echo '<p>'.$data["msjInfo"].'</p>';
    }
    if (isset($data['msjError'])) {
        echo '<p>'.$data["msjError"].'</p>';
    }
    echo '<div id="contenedor">';
    echo '<h2 align="center" style="color:white;">Gestión de usuarios</h2>';
    echo '<a href="index.php?action=formInsertarUsuario"><img src="imgs/button-new.png" class="botonNuevo" alt="Boton nuevo usuario" title="Nuevo usuario"></a>';
    echo '<table id="tablaUsuarios" class="tablaUsuarios" cellspacing="0">';
        echo '<thead class="theadUsuarios">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellidos</th>';
        echo '<th>Correo</th>';
        echo '<th>DNI</th>';
        echo '<th>Imagen (click aquí)</th>';
        echo '<th>&nbsp;</th>';
        echo '<th>&nbsp;</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody class="cuerpoUsuarios">';
        foreach($data['lista_users'] as $user) {
            echo '<tr class="usuario">';
            echo '<td>'.$user->id_user.'</td>';
            echo '<td>'.$user->nombre.'</td>';
            echo '<td>'.$user->apellido1.'&nbsp;'.$user->apellido2.'</td>';
            echo '<td>'.$user->mail.'</td>';
            echo '<td>'.$user->dni.'</td>';
            echo '<td><a href="#">Mostrar imagen</a></td>';
            echo '<td class="celdaModificar"><a href="index.php?action=formModificarUsuario&id_user='.$user->id_user.'">
                    <img class="botonModificar" src="imgs/button-edit.png" id="buttonEdit" alt="Modificar usuario" title="Modificar usuario"></a></td>';
            echo '<td class="celdaEliminar"><a href="index.php?action=confirmacionBorrarUsuario&id_user='.$user->id_user.'">
                    <img class="botonCancelar"src="imgs/button-cancelar.png" id="botonBorrar" alt="Eliminar usuario" title="Eliminar usuario"></a></td>';
            echo '</tr><tr class="filaEspacio"><td>&nbsp;</td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';