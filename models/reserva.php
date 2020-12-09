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

        public function getAllDateJoinInstalacion($dia,$mes,$id_instalacion,$id_reserva) {
            $result = $this->db->consulta("SELECT hora_inicio, hora_fin
                                            FROM reservas
                                            INNER JOIN instalaciones
                                                ON reservas.id_instalacion = instalaciones.id_instalacion
                                                WHERE DAY(reservas.fecha) = '$dia' AND MONTH(reservas.fecha) = '$mes' AND reservas.id_instalacion = $id_instalacion AND reservas.id_reserva != '$id_reserva'");
            return $result;
        }

        public function update() {
            $id_reserva = $_REQUEST['id_reserva'];
            $fecha = $_REQUEST['fecha'];
            $horas = $_REQUEST['horas'];
            $precio = count($horas) * $_REQUEST['precio_instalacion'];

            sort($horas);
            $hora_inicio = $horas[0];
            $hora_fin = $horas[count($horas)-1];


            $result = $this->db->modificacion("UPDATE reservas SET
                                                                    fecha='$fecha',
                                                                    hora_inicio='$hora_inicio',
                                                                    hora_fin='$hora_fin',
                                                                    precio='$precio'
                                                WHERE id_reserva = '$id_reserva'");
            return $result;
        }

        public function getAllDateJoinInstalacionSinReserva($dia,$mes,$id_instalacion) {
            $result = $this->db->consulta("SELECT hora_inicio, hora_fin
                                            FROM reservas
                                            INNER JOIN instalaciones
                                                ON reservas.id_instalacion = instalaciones.id_instalacion
                                                WHERE DAY(reservas.fecha) = '$dia' AND MONTH(reservas.fecha) = '$mes' AND reservas.id_instalacion = $id_instalacion");
            return $result;
        }

        public function insert() {
            $fecha = $_REQUEST['fecha'];
            $horas = $_REQUEST['horas'];
            $precio = count($horas) * $_REQUEST['precio_instalacion'];
            $id_user = $_REQUEST['id_user'];
            $id_instalacion = $_REQUEST['id_user'];

            sort($horas);
            $hora_inicio = $horas[0];
            $hora_fin = $horas[count($horas)-1];

            $result = $this->db->modificacion("INSERT INTO reservas (fecha, hora_inicio, hora_fin, precio, id_user, id_instalacion)
                                                VALUES ('$fecha','$hora_inicio','$hora_fin','$precio','$id_user','$id_instalacion')");

            return $result;
        }
    }