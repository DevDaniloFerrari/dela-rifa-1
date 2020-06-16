<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {     
    $data = json_decode($_POST['dataCart'], true);
    $_SESSION['Cart'][$data[0]['productId']] = array(
        'productId' => $data[0]['productId'],
        'raffleNumbers' => $data[0]['raffles']
    );
    $data = array(
        'message' => 'Adicionado ao carrinho com successo',
        'code' => 200
    );

    echo json_encode($data);
}