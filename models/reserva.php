<?php

    include_once("DB.php");

    class Reserva {

        private $db;

        public function __construct(){
            $this->db = new DB();
        }

        public function get($id_reserva) {
            $result = $this->db->consulta("SELECT * FROM reservas WHERE id_reserva = '$id_reserva'");

            return $result[0];
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

        public function getAllDateJoin($dia, $mes) {
            $result = $this->db->consulta("SELECT users.dni AS 'DNI', reservas.*, instalaciones.nombre AS 'nombre_instalacion'
                                           FROM users
                                           INNER JOIN reservas
                                            ON users.id_user = reservas.id_user
                                           INNER JOIN instalaciones
                                            ON reservas.id_instalacion = instalaciones.id_instalacion
                                            WHERE DAY(reservas.fecha) = $dia AND MONTH(reservas.fecha) = $mes");
            return $result;
        }
    }