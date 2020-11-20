<?php

    class Secure {
        public function logIn($user) {
            $_SESSION['id_user'] = $user->id_user;
            $_SESSION['nombre_user'] = $user->nombre;
            $_SESSION['pic_user'] = $user->imagen;
        }

        public function logOut() {
            session_destroy();
        }

        public function get($variable) {
            return $_SESSION[$variable];
        }

        public function isLogInit() {
            $haySesion = false;
            if (isset($_SESSION['id_user'])) {
                $haySesion = true;
            }
            return $haySesion;
        }

        public function errorNotLogin() {
            $data['msjError'] = 'Debes iniciar sesión para continuar';
            $this->vista->mostrar('user/formLogin',$data);
        }

        public function errorPermits() {
            $data['msjError'] = 'No tienes permisos para esta acción';
            $this->vista->mostrar('user/errorPermisos',$data);
        }
    }