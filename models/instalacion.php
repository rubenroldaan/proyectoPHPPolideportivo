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
            $this->db->modificacion("DELETE FROM instalacion WHERE id_instalacion='$id_instalacion'");

            return $this->db->filasAfectadas();
        }
    }