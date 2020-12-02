<?php

    include_once("vista.php");
    include_once("models/secure.php");
    include_once("models/user.php");
    include_once("models/instalacion.php");

    class Controller {
        private $vista, $secure, $user, $instalacion;

        public function __construct() {
            $this->vista = new Vista();
            $this->secure = new Secure();
            $this->user = new User();
            $this->instalacion = new Instalacion();
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

        public function errorSesion() {
            $data['msjError'] = 'Debes iniciar sesión para continuar';
            $this->vista->mostrar("user/formLogin",$data);
        }

        public function mostrarCalendario() {
            if ($this->secure->haySesionIniciada()) {
                $this->vista->mostrar("calendar/calendario");
            } else {
                $this->errorSesion();
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
            } else {
                $this->errorSesion();
            }
        }

        public function formModificarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $user = $_REQUEST['id_user'];
                if ($data['user'] = $this->user->get($user)) {
                    $this->vista->mostrar("user/formularioModificarUsuario",$data);
                }
            } else {
                $this->errorSesion();
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
            } else {
                $this->errorSesion();
            }
        }

        /*A ESTA FUNCIÓN HAY QUE AÑADIRLE MÁS ADELANTE LO DE LAS RESERVAS*/
        public function confirmacionBorrarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $id_user = $_REQUEST['id_user'];
                echo '<script>
                    var opcion = confirm("¿Estás seguro de eliminar el usuario?");
                    if (opcion) {
                        location.href = "index.php?action=borrarUsuario&id_user='.$id_user.'";
                    } else {
                        location.href = "index.php?action=mostrarListaUsuarios";
                    }
                </script>';
            } else {
                $this->errorSesion();
            }
        }

        /*A ESTA FUNCIÓN HAY QUE AÑADIRLE MÁS ADELANTE LO DE LAS RESERVAS*/
        public function borrarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                //HAY QUE PONER SI ES ADMINISTRADOR
                $id_user = $_REQUEST['id_user'];
                $result = $this->user->delete($id_user);

                if ($result == 1) {
                    $data['msjInfo'] = 'Usuario borrado con éxito';
                } else {
                    $data['msjError'] = 'No se ha podido eliminar el usuario. Por favor inténtelo de nuevo más tarde';
                }

                $this->mostrarListaUsuarios();
            } else {
                $this->errorSesion();
            }
        }

        public function formInsertarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $this->vista->mostrar("user/formularioInsertarUsuario");
            } else {
                $this->errorSesion();
            }
        }

        public function mostrarListaInstalaciones() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $data['lista_instalaciones'] = $this->instalacion->getAll();
                $this->vista->mostrar("instalacion/listaInstalaciones",$data);
            } else {
                $this->errorSesion();
            }
        }

        public function confirmacionBorrarInstalacion() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $id_instalacion = $_REQUEST['id_instalacion'];
                echo '<script>
                    var opcion = confirm("¿Estás seguro de eliminar la instalación? Pueden haber reservas.");
                    if (opcion) {location.href="index.php?action=borrarInstalacion&id_instalacion='.$id_instalacion.'"}
                    else{location.href="index.php?action=mostrarListaInstalaciones"}
                </script>';
            } else {
                $this->errorSesion();
            } 
        }

        public function borrarInstalacion() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $id_instalacion = $_REQUEST['id_instalacion'];
                $result = $this->instalacion->delete($id_instalacion);

                if ($result == 1) {
                    $data['msjInfo'] = 'Instalación borrada con éxito';
                } else {
                    $data['msjError'] = 'No se ha podido eliminar la instalación. Por favor inténtelo de nuevo más tarde';
                }

                $data['lista_instalaciones'] = $this->instalacion->getAll();
                $this->vista->mostrar("instalacion/instalaciones",$data);
            } else {
                $this->errorSesion();
            }
        }
    }