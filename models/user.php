<?php

    include_once("DB.php");

    class User {

        private $db;

        public function __construct() {
            $this->db = new DB();
        }
        
        public function buscarUser($user,$password) {
            $result = null;
            $usuario = $this->db->consulta("SELECT * FROM users WHERE mail='$user' AND passwd='$password'");
            if ($usuario) {
                $result = $usuario[0];
            }
            return $result;
        }

        public function get($user) {
            $result = null;
            if ($usuario = $this->db->consulta("SELECT * FROM users WHERE id_user = '$user'")) {
                $result = $usuario[0];
            }
            return $result;
        }

        public function getAll() {
            $result = $this->db->consulta("SELECT * FROM users");
            return $result;
        }

        public function existeUser($user) {
            $result = null;
            $usuario = $this->db->consulta("SELECT * FROM users WHERE mail='$user'");
            if ($usuario) {
                $result = $usuario;
            }
            return $result;
        }

        public function update() {
            $id_user = $_REQUEST['id_user'];
            $nombre = $_REQUEST['nombre'];
            $apellido1 = $_REQUEST['apellido1'];
            $apellido2 = $_REQUEST['apellido2'];
            $dni = $_REQUEST['dni'];
            $passwd = $_REQUEST['passwd'];
            $mail = $_REQUEST['mail'];
            $rol = $_REQUEST['rol'];
            $imagen = $_FILES['imagen']['name'];

            $result = $this->db->modificacion("UPDATE users SET
                                                                nombre='$nombre',
                                                                apellido1='$apellido1',
                                                                apellido2='$apellido2',
                                                                passwd='$passwd',
                                                                mail='$mail',
                                                                dni='$dni',
                                                                rol='$rol',
                                                                imagen='$dni.png'
                                                WHERE id_user='$id_user'");
            return $this->db->filasAfectadas();
        }

        public function procesarImagen() {
            $imagenBuena = true;
            $imagen = $_FILES['imagen']['name'];
            $id_user = $_REQUEST['id_user'];
            $dni = $_REQUEST['dni'];
            if (isset($imagen) && $imagen != "") {
                $tipo = $_FILES['imagen']['type'];
                $tamanyo = $_FILES['imagen']['size'];
                $temp = $_FILES['imagen']['tmp_name'];
                if (!((strpos($tipo, "gif") || strpos($tipo,"jpeg") || (strpos($tipo,"jpg") || strpos($tipo,"png")) && ($tamanyo < 2000000)))) {
                    $imagenBuena = false;
                } else {
                    if (move_uploaded_file($temp, 'imgs/prof_pics/'.$dni.'.png')) {
                        $this->db->modificacion("UPDATE users SET
                                                                imagen='$imagen'
                                                    WHERE id_user = '$id_user'");
                        chmod('imgs/prof_pics/'.$dni.'.png', 0777);
                    }
                }
            }
            return $imagenBuena;
        }

        public function delete($id_user) {
            $result = $this->db->modificacion("DELETE FROM users WHERE id_user='$id_user'");
            $this->db->modificacion("DELETE FROM reservas WHERE id_user = '$id_user'");

            return $result;
        }

        public function existe($correo) {
            $result = $this->db->consulta("SELECT* FROM users WHERE mail = '$correo'");
            if ($result != null) {
                return 1;
            } else {
                return 0;
            }
        }

        public function insert() {
            $nombre = $_REQUEST['nombre'];
            $apellido1 = $_REQUEST['apellido1'];
            $apellido2 = $_REQUEST['apellido2'];
            $passwd = $_REQUEST['passwd'];
            $mail = $_REQUEST['mail'];
            $dni = $_REQUEST['dni'];
            $rol = $_REQUEST['rol'];

            $this->db->modificacion("INSERT INTO users(nombre, apellido1, apellido2, mail, passwd, dni, rol) VALUES('$nombre','$apellido1','$apellido2','$mail','$passwd','$dni','$rol')");

            return $this->db->filasAfectadas();
        }
    }