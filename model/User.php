<?php
class User {
    private $user = array();

    public function add() {
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

            if (count($validate) >= 1) {
                return $validate;
            }
            $_SESSION[$this->user['email']] = $this->user;
            $_SESSION['message'] = array(
                'text' => "Usuário cadastrado com sucesso",
                'class' => 'success'
            );
            header("Location: index.php?modulo=User&acao=login");
            return $this->user;
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

            if (!isset($_SESSION[$_POST['email']])) {
                $validate['notExist'] = "Email não cadastrado";
            }
               
            if (count($validate) >= 1) {
                $_SESSION['messagePass'] = array(
                    'text' => "Login ou senha incorretos, por favor tente novamente",
                    'class' => 'danger'
                );
                return $validate;
            }

            if ($_POST['email'] == $_SESSION[$_POST['email']]['email'] && $_POST['password'] == $_SESSION[$_POST['email']]['password']) {
                $_SESSION['Auth'] = $_SESSION[$_POST['email']];
            } 
         
            $_SESSION['messageSuccess'] = array(
                'message' => "Usuário logado com sucesso",
                'class' => 'Success'
            );
            header("Location: index.php?modulo=Raffle&acao=raffleCrud&raffleAction=addRaffle");
        }
    }

    public function logout() {
        unset($_SESSION['Auth']);
        header("Location: index.php?modulo=User&acao=login");
    }
}