<?php
class Dashboard
{

    public function index()
    {
    }

    public static function render()
    {
        $dashboardRoute = null;
        if (isset($_GET['dashboardRoute'])) {
            $dashboardRoute = $_GET['dashboardRoute'];
        }
        switch ($dashboardRoute) {
            case null:
                require "./templates/Dashboard/bodyOfDashboard.php";
                break;
            case 'userList':
                $user = new User();
                $data = $user->list();
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
            case 'raffleEdit':
                $raffle = new Raffle();
                $data = $raffle->edit();
                require './templates/Raffle/edit.php';
                break;
            case 'userEdit':
                $user = new User();
                $data = $user->edit();
                require './templates/User/edit.php';
                break;
        }
    }
}
