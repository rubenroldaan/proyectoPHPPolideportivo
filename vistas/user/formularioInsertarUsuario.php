<?php

    echo '<div id="contenedor">';
    echo '<form action="index.php" method="post" class="formInsertarUsuario" enctype="multipart/form-data">
            <input type="hidden" name="action" value="insertarUsuario">
            Nombre: <br><input type="text" name="nombre" size="50"><br>
            1º apellido: <br><input type="text" name="apellido1" size="50"><br>
            2º apellido: <br><input type="text" name="apellido2" size="50"><br>
            Contraseña: <br><input type="password" name="passwd" size="50"><br>
            Correo electrónico: <br><input type="text" id="correo" name="mail" size="50" onblur="validar_correo()"><br>
            <p id="errorCorreo" style="color:red"></p>
            DNI: <br><input type="text" id="dni" name="dni" size="50" max-length="9"><br>
            <p id="errorDNI" style="color:red"></p>
            Rol: <br>
            <select name="rol">
                <option value="A">Administrador</option>
                <option value="R">Estándar</option>
                <option value="D">Deshabilitado</option>
            </select><br><br>
            <input type="submit">
            </form>';
    echo '</div>';