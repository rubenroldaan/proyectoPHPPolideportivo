<?php

    echo '<h1>Hola '.$_SESSION["nombre_user"].'</h1>';
    echo '<img src="imgs/prof_pics/'.$_SESSION["pic_user"].'" width="100px" height="100px">';
    echo '<p><a href="index.php?action=cerrarSesion">Cerrar sesión</a></p>';