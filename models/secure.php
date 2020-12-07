<?php

    class Secure {
        public function logIn($user) {
            $_SESSION['id_user'] = $user->id_user;
            $_SESSION['mail'] = $user->mail;
            $_SESSION['nombre_user'] = $user->nombre;
            $_SESSION['pic_user'] = $user->imagen;
            $_SESSION['rol_user'] = $user->rol;
        }

        public function logOut() {
            session_destroy();
        }

        public function get($variable) {
            return $_SESSION[$variable];
        }

        public function haySesionIniciada() {
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

        public function errorPermisos() {
            $data['msjError'] = 'No tienes permisos para esta acción';
            $this->vista->mostrar('user/errorPermisos',$data);
        }

        public function isAdmin() {
            //A = Admin
            //R = Registrado
            //D = Deshabilitado
            return $_SESSION['rol_user'] == 'A';
        }

        public function rolUser() {

            return $_SESSION['rol_user'];
        }

        public function idUser() {
            return $_SESSION['id_user'];
        }
    }