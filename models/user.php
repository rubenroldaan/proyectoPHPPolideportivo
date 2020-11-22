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
                $result = $usuario;
            }
            return $result;
        }

        // SE DEVUELVEN COMO OBJETOS? PREGUNTAR URGENTE
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
    }