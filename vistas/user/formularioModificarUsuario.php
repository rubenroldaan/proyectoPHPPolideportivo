<?php

        $user = $data['user'];
        echo '<h2 class="text-center">Modificar Usuario</h2>';

        echo '<div id="contenedor">';
        echo '<form action="index.php" method="post" class="formUpdate" enctype="multipart/form-data">
                <img src="imgs/prof_pics/'.$user->imagen.'">
                <input type="file" name="imagen" value="'.$user->imagen.'"><br>
                <input type="hidden" name="id_user" value="'.$user->id_user.'">
                <input type="hidden" name="action" value="modificarUsuario">
                Nombre: <br><input type="text" name="nombre" value="'.$user->nombre.'" size="50"><br>
                1º apellido: <br><input type="text" name="apellido1" value="'.$user->apellido1.'" size="50"><br>
                2º apellido: <br><input type="text" name="apellido2" value="'.$user->apellido2.'" size="50"><br>
                Contraseña: <br><input type="password" name="passwd" value="'.$user->passwd.'" size="50"><br>
                Correo electrónico: <br><input type="text" name="mail" value="'.$user->mail.'" size="50"><br>
                DNI: <br><input type="text" name="dni" value="'.$user->dni.'" size="50" max-length="9"><br>
                Rol: <br>
                <select name="rol">';

                if ($user->rol == 'A') {echo '<option value="A" selected>Admin</option>';}
                else {echo '<option value="A">Admin</option>';}
                if ($user->rol == 'R') {echo '<option value="R" selected>Normal</option>';}
                else {echo '<option value="R">Normal</option>';}
                if ($user->rol == 'D') {echo '<option value="D" selected>Deshabilitado</option>';}
                else {echo '<option value="D">Deshabilitado</option>';}

                echo '</select>';
                echo '<br>';

                echo '<br><br>';
                echo '<input type="submit" value="Modificar usuario">
                </form>';
        echo '</div>';