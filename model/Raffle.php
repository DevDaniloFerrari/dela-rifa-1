<?php
class Raffle {
    
    public $data = array();
    private $raffle = array();

    public function raffleCrud() {
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

    public function editar() {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

} 