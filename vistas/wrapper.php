<header>
    <div class="logo">
        <img src="imgs/logo-sin-imagen.png" alt="Logo de EGHO Sport Center">
    </div>
<?php
    if ($_SESSION['rol_user'] == 'A') {
        echo '<section class="wrapper">
        <nav>
            <ul>
                <li><a href="index.php?action=mostrarListaUsuarios">USUARIOS</a></li>
                <li><a href="index.php?action=mostrarListaInstalaciones">INSTALACIONES</a></li>
                <li><a href="index.php?action=mostrarCalendario">RESERVAS</a></li>
            </ul>
        </nav>
    </section>';
    }
    
?>
</header>