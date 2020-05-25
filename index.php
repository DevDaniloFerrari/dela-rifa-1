<?php
    session_start();
    
    if (!isset($_GET['modulo'])) {
        header("Location: index.php?modulo=User&acao=login");
    }

    if (isset($_GET['modulo']) && (!isset($_SESSION['Auth'])) && $_GET['modulo'] != 'User') {
        $_SESSION['message'] = array(
            'text' => "Acesso não autorizado",
            'class' => 'danger'
        );
        header("Location: index.php?modulo=User&acao=login");
    }

    require 'controller.php';
    require './templates/layouts/header.php';
    require 'view.php';
    require 'model/User.php';
    require 'model/Raffle.php';

    $controller = new Controller;