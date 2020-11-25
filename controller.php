<?php

    include_once("vista.php");
    include_once("models/secure.php");
    include_once("models/user.php");

    class Controller {
        private $vista, $secure, $user;

        public function __construct() {
            $this->vista = new Vista();
            $this->secure = new Secure();
            $this->user = new User();
        }

        public function formLogin() {
            if ($this->secure->haySesionIniciada()) {
                $this->mostrarCalendario();
            } else {
                $this->vista->mostrar("user/formLogin");
            }
        }

        public function procesarLogin() {
            $mail = $_REQUEST['mail'];
            $password = $_REQUEST['password'];

            $usuario = $this->user->buscarUser($mail,$password);

            if ($usuario) {
                $this->secure->logIn($usuario);
                /*PARA CAMBIAR MIENTRAS HAGO PRUEBAS*/
                $this->mostrarListaUsuarios();
            } else {
                $data['msjError'] = 'Correo o contraseña incorrectos';
                $this->vista->mostrar("user/formLogin",$data);
            }
        }

        public function cerrarSesion() {
            $this->secure->logOut();
            $data['msjInfo'] = 'Sesión cerrada correctamente';
            $this->vista->mostrar("user/formLogin",$data);
        }

        public function mostrarCalendario() {
            if (!$this->secure->haySesionIniciada()) {
                $this->formLogin();
            } else {
                $this->vista->mostrar("calendar/calendario");
            }
        }

        public function buscarUser() {
            $user = $_REQUEST['mail'];
            $result = null; 
            $usuario = $this->user->existeUser($user);
            if ($usuario) {
                $result = $usuario;
            }
            return $result;
        }

        public function mostrarListaUsuarios() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $data['lista_users'] = $this->user->getAll();
                $this->vista->mostrar("user/listaUsers",$data);
            }
        }

        public function formModificarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $user = $_REQUEST['id_user'];
                if ($data['user'] = $this->user->get($user)) {
                    $this->vista->mostrar("user/formularioModificarUsuario",$data);
                }
            }    
        }

        public function modificarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $imgResult = $this->user->procesarImagen();
                $result = $this->user->update();
                if ($result == 1) {
                    $data['msjInfo'] = 'Usuario modificado con éxito';
                } else {
                    $data['msjError'] = 'No se ha podido modificar el usuario. Por favor, inténtelo de nuevo.';
                }

                $this->mostrarListaUsuarios();
            }
        }

        /*A ESTA FUNCIÓN HAY QUE AÑADIRLE MÁS ADELANTE LO DE LAS RESERVAS*/
        public function borrarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                //HAY QUE PONER SI ES ADMINISTRADOR
            }
        }
    }