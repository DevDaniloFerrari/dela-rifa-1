<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {     
    $data = json_decode($_POST['dataCart'], true);
    $_SESSION['Cart'][] = array(
        'productId' => $data[0]['productId'],
        'raffleNumbers' => $data[0]['raffles']
    );
    header("Location: index.php?modulo=Raffle&acao=cart");
}