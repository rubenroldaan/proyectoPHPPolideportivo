<?php
    echo '<br><br><br>';
    if (isset($data['msjInfo'])) {
        echo '<p>$data'.$data["msjInfo"].'"</p>';
    }
    if (isset($data['msjError'])) {
        echo '<p>$data'.$data["msjError"].'"</p>';
    }
    echo '<button class="botonNuevoUsuario" onclick="$(\'#tablaUsuarios\').append(
        <form action=\'index.php\' method=\'post\'>
        <tr>
            <td></td>
            <td>
                <input type=\'text\' name=\'nombre\' required>*
            </td>
            <td>
                <input type=\'text\' name=\'apellido1\'>
            </td>
            <td>
                <input type=\'text\' name=\'apellido2\'>
            </td>
            <td>
                <input type=\'text\' name=\'mail\' required>*
            </td>
            <td>
                <input type=\'password\' name=\'passwd\' required>*
            </td>
            <td>
                <input type=\'text\' name=\'dni\' required>*
            </td>
            <td>
                <input type=\'file\' name=\'imagen\'>
            </td>
        </tr>
        </form>
        
        )">Añadir usuario</button>';
    echo '<table id="tablaUsuarios" class="tablaUsuarios" cellspacing="0" border="1px solid black">';
        echo '<thead class="theadUsuarios">';
        echo '<tr>';
        echo '<td>ID</td>';
        echo '<td>Nombre</td>';
        echo '<td colspan="2">Apellidos</td>';
        echo '<td>Correo</td>';
        echo '<td>DNI</td>';
        echo '<td>Imagen (click aquí)</td>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody class="cuerpoUsuarios">';
        foreach($data['lista_users'] as $user) {
            echo '<tr>';
            echo '<td>'.$user->id_user.'</td>';
            echo '<td>'.$user->nombre.'</td>';
            echo '<td>'.$user->mail.'</td>';
            echo '<td><a href="index.php?action=formModificarUsuario&id_user='.$user->id_user.'">
                    <img src="imgs/button-edit.png" id="buttonEdit" alt="Modificar usuario" title="Modificar usuario"></a></td>';
            echo '<td><a href="index.php?action=confirmacionBorrarUsuario&id_user='.$user->id_user.'">
                    <img src="imgs/borrar.png" id="botonBorrar" alt="Eliminar usuario" title="Eliminar usuario"></a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';