<?php
    
    $instalacion = $data['instalacion'];
    echo '
    <div id="contenedor">
        <form action="index.php" method="post" id="formModificarInstalacion" class="formModificarInstalacion" enctype="multipart/form-data">
            <label for="imagen">
                <img src="imgs/instalaciones/'.$instalacion->imagen.'.png">
            </label>
            <input type="file" name="imagen" id="imagen" value="'.$instalacion->imagen.'"><br>
            Nombre: <br><input type="text" name="nombre" value="'.$instalacion->nombre.'" required><br>
            Descripción: <br><textarea name="descripcion" rows="5" cols="25">'.$instalacion->descripcion.'</textarea><br>
            Precio: <br><input type="number" name="precio" min="1" max="999" value="'.$instalacion->precio.'" step=".01" required><br><br>
            <input type="hidden" name="action" value="modificarInstalacion">
            <input type="hidden" name="id_instalacion" value="'.$instalacion->id_instalacion.'">
            <input type="submit" class="btn btn-primary mb-2">
        </form>
    </div>';