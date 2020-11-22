<?php

    session_start();

    include_once("controller.php");
    $controller = new Controller();

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
    } else {
        $action = "mostrarCalendario";
    }

    $controller->$action();