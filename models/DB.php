<?php

    include_once("config.php");

    class DB {
        private $db;

        public function __construct() {
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        }
    }