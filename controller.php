<?php

    include_once("vista.php");
    include_once("models/secure.php");
    include_once("models/user.php");
    include_once("models/instalacion.php");
    include_once("models/reserva.php");

    class Controller {
        private $vista, $secure, $user, $instalacion, $reserva;

        public function __construct() {
            $this->vista = new Vista();
            $this->secure = new Secure();
            $this->user = new User();
            $this->instalacion = new Instalacion();
            $this->reserva = new Reserva();
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

        public function errorPermisos() {
            $data['msjError'] = 'No tienes permisos para realizar esta acción.';
            $this->vista->mostrar("user/formLogin",$data);
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
                    if ($result == 1 && $imgResult) {
                        $data['msjInfo'] = 'Usuario modificado con éxito';
                    } else {
                        $data['msjError'] = 'No se ha podido modificar el usuario. Por favor, inténtelo de nuevo.';
                    }
                $this->mostrarListaUsuarios();

                
            } else {
                $this->errorSesion();
            }
        }

        public function insertarUsuario() {
            if ($this->secure->haySesionIniciada()) {
                $result = $this->user->insert();

                if ($result == 1) {
                    $data['msjInfo'] = 'Usuario creado con exito';
                } else {
                    $data['msjError'] = 'No se ha podido crear el usuario. Inténtelo de nuevo más tarde';
                }

                $this->mostrarListaUsuarios();
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

        public function formModificarInstalacion() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $id_instalacion = $_REQUEST['id_instalacion'];
                if ($data['instalacion'] = $this->instalacion->get($id_instalacion)) {
                    $this->vista->mostrar("instalacion/formularioModificarInstalacion",$data);
                }
            } else {
                $this->errorSesion();
            }
        }

        public function modificarInstalacion() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                    $imgResult = $this->instalacion->procesarImagen();
                    if ($imgResult) {
                        $result = $this->instalacion->update();
                        if ($result == 1) {
                            $data['msjInfo'] = 'Instalación modificada con éxito';
                        } else {
                            $data['msjError'] = 'No se ha podido modificar la instalación. Inténtelo de nuevo';
                        }
                    } else {
                        // HACERLO EN AJAX SI HAY TIEMPO
                    }
                    
                    
                $this->mostrarListaInstalaciones();
            } else {
                $this->errorSesion();
            }
        }

        public function formInsertarInstalacion() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $this->vista->mostrar("instalacion/formularioInsertarInstalacion");
            } else {
                $this->errorSesion();
            }
        }

        public function insertarInstalacion() {
            if ($this->secure->haySesionIniciada()) {
                // HAY QUE PONER SI ES ADMINISTRADOR
                $result = $this->instalacion->insert();

                if ($result == 1) {
                    $data['msjInfo'] = 'Instalación creada con éxito';
                } else {
                    $data['msjError'] = 'No se ha podido crear la instalación';
                }

                $data['lista_instalaciones'] = $this->instalacion->getAll();
                $this->vista->mostrar("instalacion/listaInstalaciones",$data);
            } else {
                $this->errorSesion();
            }
        }

        public function mostrarCalendarioPrueba() {
            if ($this->secure->haySesionIniciada()) {
                $this->vista->mostrar("../calendarioPrueba");
            } else {
                $this->errorSesion();
            }
        }

        public function mostrarCalendario() {
            if ($this->secure->haySesionIniciada()) {
                if ($this->secure->isAdmin()) {
                    $data['lista_reservas'] = $this->reserva->getAll();
                } else {
                    $data['lista_reservas'] = $this->reserva->getSelected($this->secure->idUser());
                }
                $this->vista->mostrar("calendar/calendario", $data);
            } else {
                $this->errorSesion();
            }
        }

        public function comprobarCorreo() {
            $user = $_REQUEST['mail'];

            $result = $this->user->existe($user);

            echo $result;
        }

        public function mostrarReservasSobreDiaCalendario() {
            if ($this->secure->haySesionIniciada()) {
                $user = $_REQUEST['id_user'];
                $result = null;
                $texto = '';
                $dia = $_REQUEST['dia'];
                $mes = $_REQUEST['mes'];
                $result = array();
                if ($this->secure->isAdmin()) {
                    $result = $this->reserva->getAllDate($dia, $mes);
                    
                } else {
                    $result = $this->reserva->getSelectedDate($user, $dia, $mes);
                }

                echo count($result);

            }
        }

        public function mostrarReservasDetalladas() {
            if ($this->secure->haySesionIniciada()) {
                $dia = $_REQUEST['dia'];
                $mes = $_REQUEST['mes'];
                $id_user = $_REQUEST['id_user'];
                if ($this->secure->isAdmin()) {
                    $result = $this->reserva->getAllDateJoin($dia,$mes);

                    if ($result) {
                        $data['lista_reservas'] = $result;
                    } else {$data['lista_reservas'] = null;}
                } else {
                    $data['lista_reservas'] = $this->reserva->getSelectedDate($id_user,$dia,$mes);
                }

                $this->vista->mostrar("reserva/listaReservasDetalladas",$data);
            } else {
                $this->errorSesion();
            }
        }

        public function formModificarReserva() {
            if ($this->secure->haySesionIniciada()) {
                $id_reserva = $_REQUEST['id_reserva'];
                
                if ($data['reserva'] = $this->reserva->get($id_reserva)) {
                    $data['horas_instalacion'] = $this->instalacion->getHorario($data['reserva']->id_instalacion);

                    $data['reservas_instalacion_mismo_dia'] = $this->reserva->getAllDateJoinInstalacion(substr($data['reserva']->fecha,-1,2),substr($data['reserva']->fecha,5,2),$data['reserva']->id_instalacion);
                    $data['horas_tomadas'] = array();

                    for ($i=0; $i < count($data['reservas_instalacion_mismo_dia']); $i++) {
                        for ($j = $data['reservas_instalacion_mismo_dia'][$i]->hora_inicio; $j <= $data['reservas_instalacion_mismo_dia'][$i]->hora_fin; $j++) { 
                            array_push($data['horas_tomadas'], $j);
                        }
                    }

                    if ($this->secure->isAdmin()) {
                        $this->vista->mostrar("reserva/formularioModificarReserva",$data);
                    } else {
                        if ($this->secure->rolUser() != $data['reserva']->id_user) {
                            $data['msjError'] = 'No tienes permisos para modificar las incidencias de otros usuarios!';
                            $this->errorPermisos();
                        } else {
                            $this->vista->mostrar("reserva/formularioModificarReserva",$data);
                        }
                    }
                }
            } else {
                $this->errorSesion();
            }
        }
    }