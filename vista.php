<?php

    class Vista {
        public function show($nombre_vista, $data=null) {
            include_once("vistas/header.php");
            include_once("vistas/$nombre_vista.php");
            include_once("vistas/footer.php");
        }
    }