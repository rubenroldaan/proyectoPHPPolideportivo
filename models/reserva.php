<?php

    include_once("DB.php");

    class Reserva {

        private $db;

        public function __construct(){
            $this->db = new DB();
        }

        public function getAll() {
            $result = $this->db->consulta("SELECT * FROM reservas");

            return $result;
        }

        public function getSelected($id_user) {
            $result = $this->db->consulta("SELECT * FROM reservas WHERE id_user = '$id_user'");

            return $result;
        }
    }