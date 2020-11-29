<?php

    session_start();

    include_once("controller.php");
    $controller = new Controller();

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
    } else {
        // VOY CAMBIANDO MIENTRAS HAGO PRUEBAS. POR DEFECTO SERÍA MOSTRAR CALENDARIO (O DEPENDIENDO DEL ROL, MOSTRAR DE PRIMERA PANTALLA CALENDARIO O SELECTOR DE ROL)
        $action = "formLogin";
    }

    $controller->$action();