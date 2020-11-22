<?php

    include_once("config.php");

    class DB {
        private $db;

        public function __construct() {
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        }

        public function consulta($sql) {
            $arrayResult = array();
            if ($result = $this->db->query($sql)) {
                while ($fila = $result->fetch_object()) {
                    $arrayResult[] = $fila;
                }
            } else {
                $arrayResult = null;
            }
            if (count($arrayResult) == 1) {
                $arrayResult = $arrayResult[0];
            }
            return $arrayResult;
        }
    }