<?php

use database\Database;

class User {
    private $user = array();

    public function add() {
        $conection = new Database;
        $validate = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            foreach ($_POST as $key => $postData) {
                if (isset($_POST[$key]) && !empty($_POST[$key])) {
                    $this->user[$key] = $postData;
                } else {
                    $validate['empty'][$key] = "Campo está vazio por favor preencher";
                }
            }

            if (isset($this->user['email']) && isset($_SESSION[$this->user['email']])) {
                $validate['existEmail'] = "Email já cadastrado";
            }

            if (isset($this->user['email']) && $this->user['email'] != $this->user['confirmEmail']) {
                $validate['emailDiff'] = "Os emails não coincidem";
            }

            if (isset($this->user['password'])) {
                if (isset($this->user['password']) && $this->user['password'] != $this->user['confirmPassword']) {
                    $validate['passwordDiff'] = "As senhas não coincidem";
                }

                if (isset($this->user['password']) && strlen($this->user['password']) < 6) {
                    $validate['passwordLength'] = "Senha deve conter no minímo 6 caracteres";
                }
            }

            $this->user['password'] = DelaHash::hash($this->user['password']);

            if (count($validate) >= 1) {
                return $validate;
            }
            unset($this->user['confirmEmail']);
            unset($this->user['confirmPassword']);
            if ($conection->save($this->user, 'users')) {
                $_SESSION['message'] = array(
                    'text' => "Usuário cadastrado com sucesso",
                    'class' => 'success'
                );
                return header("Location: index.php?modulo=User&acao=login");
            }
        }
    }

    public function login() {
        $validate = array();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!isset($_POST['email']) && empty($_POST['email'])) {
                $validate['emptyEmail'] = "Por favor preencher o E-mail";
            }

            if (!isset($_POST['password']) && empty($_POST['password'])) {
                $validate['emptyPassword'] = "Por favor preencher a senha";
            }
               
            if (count($validate) >= 1) {
                $_SESSION['messagePass'] = array(
                    'text' => "Login ou senha incorretos, por favor tente novamente",
                    'class' => 'danger'
                );
                return $validate;
            }

            $user = new Database();
            $user = $user->select('users', 'email', $_POST['email']);

            if (!empty($user) && DelaHash::check($_POST['password'], $user['password'])) {
                unset($user['password']);
                $_SESSION['Auth'] = $user;
                return Flash::flashWithRedirect('Usuário autenticado com sucesso', 'success', 'modulo=Raffle&acao=store');
            }
            return Flash::flashWithRedirect('Usuário ou senha incorretos', 'error', 'modulo=User&acao=login');
        }
    }

    public function profile() 
    {
        $user = new Database();
        $this->user = $user->select('users', 'id', $_SESSION['Auth']['id']);
        return $this->user;
    }

    public function logout()
    {
        unset($_SESSION['Auth']);
        header("Location: index.php?modulo=User&acao=login");
    }

    public function list()
    {
        $users = new Database();
        $this->user = $users->selectAll('users');
        return $this->user;
    }

    public function edit()
    {
        $id = $_GET['userId'];
        $user = new Database();
        $this->user = $user->select('users', 'id', $id);
        $this->user['userId'] = $id;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($user->update('users', $_POST, $id)) {
                return Flash::flashWithRedirect('Sucesso ao editar o usuário', 'success', 'modulo=Dashboard&acao=index&dashboardRoute=userList');
            }
            return Flash::flashWithRedirect('Erro ao editar ousuário', 'error', 'modulo=Dashboard&acao=index&dashboardRoute=userList');
        }
        return $this->user;   
    }
}