<?php

    include_once("vista.php");

    class Controller {
        private $vista;

        public function __construct() {
            $this->vista = new Vista();
        }

        public function formLogin() {
        }
    }