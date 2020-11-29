<?php
    include_once("models/secure.php");
    
    class Vista {
        private $secure;
        
        public function mostrar($nombre_vista, $data=null) {
            $this->secure = new Secure();
            include_once("vistas/header.php");
            if ($this->secure->haySesionIniciada()){include_once("vistas/wrapper.php");}
            include_once("vistas/$nombre_vista.php");
            if ($this->secure->haySesionIniciada()) {include_once("vistas/footer.php");}
        }
    }