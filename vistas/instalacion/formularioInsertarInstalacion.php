<?php
    echo '
    <div id="contenedor">
        <h1 style="position:relative;left:50%;transform:translateX(-35%);width:50%;color:white">Crear instalación</h1>
        <form action="index.php" method="post" id="formCrearInstalacion" class="formCrearInstalacion" enctype="multipart/form-data">
            Nombre: <br><input type="text" name="nombre"  required><br>
            Descripción: <br><textarea name="descripcion" rows="5" cols="25"></textarea><br>
            Precio: <br><input type="number" name="precio" min="1" max="999" step=".01" required><br><br>
            <input type="hidden" name="action" value="insertarInstalacion">
            <input type="submit" class="btn btn-primary mb-2">
        </form>
    </div>';