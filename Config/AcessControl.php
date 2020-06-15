<?php

use database\Database;

class AcessControl {

    protected $noAuthRoutes = array(
        'routes' => array(
            'User' => array(
                'add',
                'login'
            ),
            'Raffle' => array(
                'about',
                'contact',
                'home',
                'partnership',
                'store'
            )
        )
    );

    protected $routes = array(
        1 => '*',
        2 => array(
            'routes' => array(
                'User' => array(
                    'add',
                    'login',
                    'profile',
                    'logout'
                ),
                'Raffle' => array(
                    'about',
                    'contact',
                    'home',
                    'partnership',
                    'store'
                )
            )
        ),
        3 => array(

        ),
        4 => array(

        ),
        5 => array(

        )
    );

    public function __construct()
    {
        $this->checkAccess($this->checkUserCategory(), $this->returnRoute(), $this->checkAuthUser());   
    }


    public function checkAccess($category = 0, $route, $isAuth = false)
    {
        if (!$isAuth && in_array($route['action'], $this->noAuthRoutes['routes'][$route['model']])) {
            return true;
        } 

        if ($this->routes[$category] === '*') {
            return true;
        }
        
        if (is_array($this->routes[$category]) && isset($this->routes[$category]['routes'][$route['model']]) && in_array($route['action'], $this->routes[$category]['routes'][$route['model']])) {
            return true;
        }

        return Flash::flashWithRedirect('Acesso não autorizado', 'error', 'modulo=Raffle&acao=home');
    }

    public function checkAuthUser()
    {
        if (isset($_SESSION['Auth']) && !empty($_SESSION['Auth']))
        {
            return true;
        }   
        return false;
    }

    public function checkUserCategory()
    {
        if ($this->checkAuthUser()) {
            $db = new Database;
            $user = $db->select('users', 'id', $_SESSION['Auth']['id']);
            if (!empty($user['id'])) {
                return $user['category_id'];
            }
        }
        return null;
    }

    public function returnRoute()
    {
        $route = array(
            'model' => $_GET['modulo'],
            'action' => $_GET['acao']
        );
        return $route;
    }
    
    public function returnUserId()
    {
        if ($this->checkAuthUser) {
            return $_SESSION['Auth']['id'];
        }
        return null;
    }
    
}