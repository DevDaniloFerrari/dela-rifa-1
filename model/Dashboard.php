<?php
class Dashboard {

    public function index() {

    }

    public static function render()
    {
        if (isset($_GET['dashboardRoute'])) {
            $dashboardRoute = $_GET['dashboardRoute'];
            switch ($dashboardRoute) {
                case null:
                    break;
                case 'userList':
                    require "./templates/User/list.php";
                    break;
                case 'raffleAdd':
                    require "./templates/Raffle/addRaffle.php";
                    break;
                case 'raffleList':
                    $raffle = new Raffle();
                    $data = $raffle->list();
                    require './templates/Raffle/list.php';
                    break;
            }
        }
    }


}