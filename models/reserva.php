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

        public function getAllDate($dia, $mes) {
            $result = $this->db->consulta("SELECT * FROM reservas WHERE DAY(fecha) = $dia AND MONTH(fecha) = $mes");

            return $result;
        }

        public function getSelectedDate($id_user, $dia, $mes) {
            $result = $this->db->consulta("SELECT * FROM reservas WHERE id_user = '$id_user' AND DAY(fecha) = '$dia' AND MONTH(fecha) == '$mes'");

            return $result;
        }
    }