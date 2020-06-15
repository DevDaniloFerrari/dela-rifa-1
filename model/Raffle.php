<?php

use database\Database;

class Raffle {
    
    public $data = array();
    private $raffle = array();

    public function home()
    {

    }

    public function raffleCrud() 
    {
        $action = '';
        $this->data['actionTitle'] = 'Rifas';
        $this->data['action'] = '/';
        $id = 1;
        if (isset($_GET['raffleAction'])) {
            $action = $_GET['raffleAction'];
        }
        $this->data['action'] = $action;

        switch($action) {
            case 'listAll':
                if (isset($_SESSION['raffles'])) {
                    $this->data['raffles'] = $_SESSION['raffles'];
                }
                $this->data['actionTitle'] = "Listar todas rifas";
                break;
            case 'listOneRaffle':
                $this->data['actionTitle'] = "Listar uma rifa";

                if ($_SERVER['REQUEST_METHOD'] === "POST") {

                    $raffleid = 0;
                    if (isset($_POST['raffleId'])) {
                        $raffleid = $_POST['raffleId'];
                    }

                    if (isset($_SESSION['raffles'][$raffleid])) {
                        $this->data['raffles'][$raffleid] = $_SESSION['raffles'][$raffleid];
                    } else {
                        $_SESSION['message'] = "Nenhuma rifa encontrada com o ID solicitado, por favor tente novamente";
                        $this->data['messageClass'] = 'danger';
                    }
                }
                break;
            case 'addRaffle':
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    if (isset($_SESSION['raffles']) && !empty($_SESSION['raffles'])) {
                        $lastId = end($_SESSION['raffles']);
                        $id = $lastId['id'] + 1;
                    } 
                        $this->raffle = array(
                            'id' => $id,
                            'productName' => $_POST['productName'],
                            'participantsQuantity' => $_POST['participantsQuantity'],
                            'unitaryValue' => $_POST['unitaryValue']
                        );
                        $_SESSION['raffles'][$id] = $this->raffle;

                    $_SESSION['message'] = "Rifa adicionada com sucesso";
                    $this->data['messageClass'] = 'success';
                }
                $this->data['actionTitle'] = "Adicionar rifa";
                break;
            case 'editRaffle';
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    if (isset($_SESSION['raffles'][$_POST['raffleEdit']])) {
                       $_SESSION['raffles'][$_POST['raffleEdit']]['id'] = $_POST['raffleEdit'];
                       $_SESSION['raffles'][$_POST['raffleEdit']]['productName'] = $_POST['productName'];
                       $_SESSION['raffles'][$_POST['raffleEdit']]['participantsQuantity'] = $_POST['participantsQuantity'];
                       $_SESSION['raffles'][$_POST['raffleEdit']]['unitaryValue'] = $_POST['unitaryValue'];
                       $_SESSION['message'] = "Rifa editada com sucesso";
                       $this->data['messageClass'] = 'success';
                    } else {
                        $_SESSION['message'] = "Nenhuma rifa encontrada com o ID solicitado, por favor tente novamente";
                        $this->data['messageClass'] = 'danger';
                    }
                }
                $this->data['actionTitle'] = "Editar rifa";
                break;
            case 'deleteRaffle';
                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                    if (isset($_SESSION['raffles'][$_POST['raffleDelete']])) {
                        $_SESSION['message'] = "Rifa deletada com sucesso";
                        $this->data['messageClass'] = 'success';
                        unset($_SESSION['raffles'][$_POST['raffleDelete']]);
                    } else {
                        $_SESSION['message'] = "Nenhuma rifa encontrada com o ID solicitado, por favor tente novamente";
                        $this->data['messageClass'] = 'danger';
                    }
                }
                $this->data['actionTitle'] = "Deletar rifa";

                break;
        }

        return $this->data;
    }

    public function store()
    {
        $raffles = new Database();
        $this->raffle = $raffles->selectAll('raffles');
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['product-name'])) {
                $productName = $_POST['product-name'];
                $query = "SELECT * FROM `raffles` WHERE `productName` LIKE '%$productName%'";
                $this->raffle = $raffles->makeQuery($query);
            }
        }
        return $this->raffle;
    }

    public function about()
    {

    }

    public function contact()
    {

    }

    public function partnership()
    {
        
    }

    public function participate()
    {

    }

    public function addRaffle()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {     
            $validate = array();
            foreach ($_POST as $key => $postData) {
                if (isset($_POST[$key]) && !empty($_POST[$key])) {
                    $this->user[$key] = $postData;
                } else {
                    $validate['empty'][$key] = "Campo está vazio por favor preencher";
                }
            }

            if (count($validate) >= 1) {
                return $validate;
            }
            $uploadedFileName = $_FILES['picture']['name'];
            $date = date('d/m/Y  H:i:s');
            $fileExtension = explode('.', $uploadedFileName);
            $fileExtension = strtolower(end($fileExtension));
            $fileTmpPath = $_FILES['picture']['tmp_name'];
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
            $fileName = md5($_FILES['picture']['name'] . $date) . '.' . $fileExtension;
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = "./assets/productsImg/$fileName";
                $dest_path = $uploadFileDir;
                $db = new Database();
                $save = array(
                    'productName' => $_POST['productName'],
                    'description' => $_POST['description'],
                    'participantsQuantity' => $_POST['participantsQuantity'],
                    'unitaryValue' => $_POST['unitaryValue'],
                    'picture' => $uploadFileDir,
                    'created_by' => $_SESSION['Auth']['id'],
                    'updated' => date('Y-m-d H:i:s'),
                    'created' => date('Y-m-d H:i:s')
                );
                if ($db->save($save, 'raffles') && move_uploaded_file($fileTmpPath, $dest_path)) {
                    return Flash::flashWithRedirect('Rifa adicionada com sucesso', 'success', 'modulo=Dashboard&acao=index');
                } 
            }
            return Flash::flashWithRedirect('Erro ao adicionar rifa', 'success', 'modulo=Dashboard&acao=index&dashboardRoute=userList');
        }
    }

    public function list()
    {
        $raffle = new Database();
        $query = "SELECT users.name, raffles.id, raffles.productName, raffles.description, raffles.participantsQuantity, raffles.unitaryValue, raffles.created_by, raffles.updated, raffles.created FROM users INNER JOIN raffles WHERE users.id = raffles.created_by";
        $this->raffle = $raffle->makeQuery($query);
        return $this->raffle;
    }

    public function delete()
    {
        return $_GET;
        $id = $_GET['raffleId'];
        $raffle = new Database();
        if ($raffle->delete('raffle', $id)) {
            return Flash::flashWithRedirect('Sucesso ao deletar rifa', 'success', 'modulo=Dashboard&acao=index&dashboardRoute=raffleList');
        }
        return Flash::flashWithRedirect('Erro ao deletar rifa', 'error', 'modulo=Dashboard&acao=index&dashboardRoute=raffleList');
    }

    public function editar() {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

} 