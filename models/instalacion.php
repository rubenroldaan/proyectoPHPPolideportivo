<?php

    include_once("DB.php");

    class Instalacion {
        private $db;

        public function __construct() {
            $this->db = new DB();
        }

        public function get($id_instalacion) {
            $result = null;
            $instalacion = $this->db->consulta("SELECT * FROM instalaciones WHERE id_instalacion = '$id_instalacion'");
            if ($instalacion) {
                $result = $instalacion[0];
            }
            return $result;
        }

        public function getAll() {
            $result = $this->db->consulta("SELECT * FROM instalaciones");
            return $result;
        }

        public function delete($id_instalacion) {
            $this->db->modificacion("DELETE FROM instalaciones WHERE id_instalacion='$id_instalacion'");

            return $this->db->filasAfectadas();
        }

        public function procesarImagen() {
            $imagenBuena = true;
            $imagen = $_FILES['imagen']['name'];
            $id_instalacion = $_REQUEST['id_instalacion'];
            if (isset($imagen) && $imagen != "") {
                $tipo = $_FILES['imagen']['type'];
                $tamanyo = $_FILES['imagen']['size'];
                $temp = $_FILES['imagen']['tmp_name'];
                if (!((strpos($tipo, "gif") || strpos($tipo,"jpeg") || (strpos($tipo,"jpg") || strpos($tipo,"png")) && ($tamanyo < 2000000)))) {
                    $imagenBuena = false;
                } else {
                    if (move_uploaded_file($temp, 'imgs/instalaciones/'.$id_instalacion.'.png')) {
                        $this->db->modificacion("UPDATE instalaciones SET
                                                                imagen='$imagen'
                                                    WHERE id_instalacion = '$id_instalacion'");
                    }
                }
            }
            return $imagenBuena;
        }

        public function update() {
            $id_instalacion = $_REQUEST['id_instalacion'];
            $nombre = $_REQUEST['nombre'];
            $descripcion = $_REQUEST['descripcion'];
            $precio = $_REQUEST['precio'];

            $this->db->modificacion("UPDATE instalaciones SET
                                                            nombre='$nombre',
                                                            descripcion='$descripcion',
                                                            precio='$precio',
                                                            imagen='$id_instalacion'
                                    WHERE id_instalacion='$id_instalacion'");
            return $this->db->filasAfectadas();
        }

        public function insert() {
            $nombre = $_REQUEST['nombre'];
            $descripcion = $_REQUEST['descripcion'];
            $precio = $_REQUEST['precio'];

            $result = $this->db->modificacion("INSERT INTO instalaciones(nombre, descripcion, precio)
                                        VALUES('$nombre','$descripcion','$precio')");
            return $result;
        }

        public function getHorario($id_instalacion) {
            $result = $this->db->consulta("SELECT * FROM horario_instalaciones WHERE id_instalacion = '$id_instalacion'");

            return $result[0];
        }

        public function getImagen($id_instalacion) {
            $result = $this->db->consulta("SELECT imagen FROM instalaciones WHERE id_instalacion = '$id_instalacion'");

            return $result[0];
        }

        public function getLastID() {
            $result = $this->db->consulta("SELECT MAX(id_instalacion) AS ultimoID FROM instalaciones");
            $id = $result[0]->ultimoID;

            return $id;
        }

        public function setHorario($hora_inicio, $hora_fin, $id_instalacion) {
            $result = $this->db->modificacion("INSERT INTO horario_instalaciones (hora_inicio, hora_fin, id_instalacion)
                                                VALUES('$hora_inicio','$hora_fin','$id_instalacion')");
            return $result;
        }
    }