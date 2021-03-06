<?php
    session_start();
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    if (!isset($_GET['modulo'])) {
        header("Location: index.php?modulo=User&acao=login");
    }
 
    require 'database/Database.php';
    require 'Config/AcessControl.php';
    require 'Config/Flash.php';

    $acessControl = new AcessControl();
    require 'controller.php';
    require 'view.php';
    require 'model/User.php';
    require 'model/Raffle.php';
    require 'model/Dashboard.php';
    require 'Helpers/Configure.php';
    require 'Config/DelaHash.php';
    $controller = new Controller;
   
    function pr($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
