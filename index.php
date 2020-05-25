<?php
    session_start();

    if ((!isset($_SESSION['Auth'])) && $_GET['modulo'] != 'User') {
        $message = "Você precisa estar autenticado para realizar está ação";
        $_SESSION['message'] = $message;
        header("Location: index.php?modulo=User&acao=login");
    }

    require 'controller.php';
    require './templates/layouts/header.php';
    require 'view.php';
    require 'model/User.php';
    require 'model/Raffle.php';

    $controller = new Controller;