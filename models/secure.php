<?php

    class Secure {
        public function logIn($user) {
            $_SESSION['id_user'] = $user->id_user;
            $_SESSION['mail'] = $user->mail;
            $_SESSION['nombre_user'] = $user->nombre;
            $_SESSION['pic_user'] = $user->imagen;
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

        /*public function isAdmin($user) {
            $result = false;
            $usuario = $this->db->consulta("SELECT rol FROM users WHERE mail='$user'");
            if ($usuario == 'A') {
                $result = true;
            }
            return $result;
        }*/
    }