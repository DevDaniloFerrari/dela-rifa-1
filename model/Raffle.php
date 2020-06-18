<?php

use database\Database;

class Raffle
{

    public $cart = array();
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

        switch ($action) {
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
        $this->raffle = $raffles->makeQuery('SELECT * FROM raffles where raffles.status = 1');
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['product-name'])) {
                $productName = $_POST['product-name'];
                $query = "SELECT * FROM `raffles` WHERE raffles.status = 1 AND `productName` LIKE '%$productName%'";
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

    public function order()
    {
        $userId = $_SESSION['Auth']['id'];
        $raffle = new Database();
        $this->raffle['raffleBought'] = $raffle->makeQuery("SELECT    
            u.id, u.name,
            rb.quantityRaffles, rb.created, rb.boughtRaffles, rb.id as raffle_buy_id,
            r.productName, r.unitaryValue, r.picture, r.status, r.owner_id, r.id as raffleId
            FROM `raffles_buy` as rb
            INNER JOIN raffles as r on rb.prod_id = r.id
            INNER JOIN users as u on rb.user_id = u.id
            WHERE rb.`user_id` = '" . $userId . "' ORDER BY rb.id DESC"
        );
        foreach ($this->raffle['raffleBought'] as $key => $value) {
            $raffleNumbers = new Database();
            $productId = $value['raffleId'];
            $this->raffle['raffleBought'][$key]['raffleNumbers'] = $raffleNumbers->makeQuery("SELECT raffles_draw.id, raffles_draw.raffle_number FROM raffles_draw INNER join raffles_buy as rb on rb.id = raffles_draw.raffle_buy_id WHERE raffles_draw.product_id = '" . $productId . "' and raffles_draw.user_id = '" . $userId . "'");
        }
        return $this->raffle;
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
        $id = $_GET['raffleId'];
        $raffle = new Database();
        if ($raffle->delete('raffles', $id)) {
            return Flash::flashWithRedirect('Sucesso ao deletar rifa', 'success', 'modulo=Dashboard&acao=index&dashboardRoute=raffleList');
        }
        return Flash::flashWithRedirect('Erro ao deletar rifa', 'error', 'modulo=Dashboard&acao=index&dashboardRoute=raffleList');
    }

    public function editar()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

    public function edit()
    {
        $id = $_GET['raffleId'];
        $raffle = new Database();
        $this->raffle = $raffle->select('raffles', 'id', $id);
        $this->raffle['raffleId'] = $id;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($raffle->update('raffles', $_POST, $id)) {
                return Flash::flashWithRedirect('Sucesso ao deletar rifa', 'success', 'modulo=Dashboard&acao=index&dashboardRoute=raffleList');
            }
            return Flash::flashWithRedirect('Erro ao deletar rifa', 'success', 'modulo=Dashboard&acao=index&dashboardRoute=raffleList');
        }
        return $this->raffle;   
    }

    public function viewProduct()
    {
        $this->raffle['buyedRaffles'] = array();
        $this->raffle['buyedRaffles']['countBuyed'] = 0;
        $id = $_GET['productId'];
        $raffle = new Database();
        $this->raffle = $raffle->select('raffles', 'id', $id);
        $arrayToFormat = $raffle->makeQuery("SELECT * FROM raffles_draw WHERE `product_id` = '" . $id . "' ");
        if (!empty($arrayToFormat)) {
            foreach ($arrayToFormat as $value) {
                $this->raffle['buyedRaffles'][$value['raffle_number']] = $value['product_id'];
                $this->raffle['buyedRaffles']['countBuyed'] = count($arrayToFormat);
            }
        }
        return $this->raffle;
    }

    public function cart()
    {
        return $this->returnCartItems();
    }

    public function pay()
    {
        $rafflePay = array();
        $validate = array();
        $save = array();
        $productsIds = array();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            foreach ($_POST as $key => $postData) {
                if (isset($_POST[$key]) && !empty($_POST[$key])) {
                    $rafflePay[$key] = $postData;
                } else {
                    $validate['empty'][$key] = "Campo está vazio por favor preencher";
                }
            }
       
            if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
                $boughtRaffles = '';
                foreach ($_POST['raffles'] as $k => $value) {
                    $implodeValues = implode(',', $value);
                    $boughtRaffles .= $implodeValues;
                    $saveBuyProducts = array(
                        'user_id' => $_SESSION['Auth']['id'],
                        'price' => $_POST['totalPrice'],
                        'quantityRaffles' => count($value),
                        'prod_id' => $k,
                        'status' => '1',
                        'boughtRaffles' => $boughtRaffles,
                        'created' => date('Y-m-d H:i:s')
                    );
                    $productsIds[] = $k;
                    $buyRaffle = new Database();
                    $lastId = $buyRaffle->save($saveBuyProducts, 'raffles_buy', true);
                    foreach ($value as $key => $data) {
                        $save = array(
                            'product_id' => $k,
                            'raffle_number'=> $data,
                            'user_id' => $_SESSION['Auth']['id'],
                            'raffle_buy_id' => $lastId,
                            'created' => date('Y-m-d H:i:s')
                        );
                        $raffle = new Database();
                        if ($raffle->save($save, 'raffles_draw')) {
                            unset($_SESSION['Cart'][$k]);
                        }
                    }
                }

                $this->checkQuantityRiffles($productsIds);
            }
            return Flash::flashWithRedirect('Sucesso ao comprar rifa', 'success', 'modulo=Raffle&acao=order&pay=1');
        }
        return $this->returnCartItems();
    }

    public function returnCartItems()
    {
        if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
            $cart = $_SESSION['Cart'];
            $cartItems = array();
            foreach ($cart as $key => $value) {
                $raffle = new Database();
                $this->raffle[$value['productId']] = $raffle->select('raffles', 'id', $value['productId']);
                $explodeCartItems = explode(',', $value['raffleNumbers']);
                $cartItems = $explodeCartItems;
                $this->raffle[$value['productId']]['rafflesToBuy'] = $cartItems;
            }
        }
        return $this->raffle;
    }

    public function checkQuantityRiffles(array $ids)
    {
        foreach ($ids as $id) {
            $db = new Database();
            $countRaffles = $db->makeQuery("SELECT count(product_id) AS total FROM `raffles_draw` WHERE raffles_draw.product_id = '" . $id . "' ");
            $raffle = $db->select("raffles", 'id', $id);
            
            if ($countRaffles[0]['total'] >= $raffle['participantsQuantity']) {
                $sortRaffleNumbers = $db->makeQuery("SELECT * FROM raffles_draw where product_id = '" . $id . "'");
                $sortKey = array_rand($sortRaffleNumbers);
                $updateRaffleStatus = array(
                    'status' => 2,
                    'owner_id' => $sortRaffleNumbers[$sortKey]['user_id'],
                    'draw_raffle' => $sortKey
                );
                $db->update('raffles', $updateRaffleStatus, $id);
            }
        }
        return true;
    }

}
