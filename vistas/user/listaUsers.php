<?php
    echo '<h1>Hola '.$_SESSION["nombre_user"].'</h1>';
    echo '<img src="imgs/prof_pics/'.$_SESSION["pic_user"].'" width="100px" height="100px">';
    echo '<p><a href="index.php?action=cerrarSesion">Cerrar sesión</a></p>';
    echo '<br><br><br>';
    echo '<p><a href="index.php?action=nuevoUsuario">Crear usuario</a></p>';
    echo '<table class="tablaUsuarios" cellspacing="0" border="1px solid black">';
        echo '<thead class="theadUsuarios">';
        echo '<tr>';
        echo '<td>ID</td>';
        echo '<td>Nombre</td>';
        echo '<td>Correo</td>';
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
            echo '<td><a href="index.php?action=borrarUsuario&id_user='.$user->id_user.'">
                    <img src="imgs/borrar.png" id="botonBorrar" alt="Eliminar usuario" title="Eliminar usuario"></a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';