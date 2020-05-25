<?php
session_start();

if (isset($_SESSION['raffles'][$_POST['raffleEdit']])) {
    echo json_encode($_SESSION['raffles'][$_POST['raffleEdit']]);
}
