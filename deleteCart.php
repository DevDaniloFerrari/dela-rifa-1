<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {    
        $countRaffle = 0;
        unset($_SESSION['Cart'][$_POST['prodId']]);
        if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
            $countRaffle = ($_SESSION['Cart']);
        }
        $data = array(
            'message' =>'Removido do carrinho com successo',
            'code' => 200,
            'countRaffle' => $countRaffle
        );
    
        echo json_encode($data);
    }