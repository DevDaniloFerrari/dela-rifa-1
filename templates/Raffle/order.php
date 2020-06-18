<head>
    <link rel="stylesheet" href="./css/cart.css">
</head>
<?php if ($_GET['modulo'] != 'Dashboard'): ?>
    <?php require './templates/layouts/header.php'; ?>
<?php endif; ?>
<body>
    <div class="container p-5">

        <form>
            <div class="row">
                <div class="form-group col-6">
                    <label for=""></label>
                    <input type="text" class="form-control" placeholder="Filtrar por nome do produto">
                </div>
                <div class="form-group col-3">
                    <label for=""></label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group col-3">
                    <label for=""></label>
                    <input type="submit" class="btn btn-success" value="Buscar">
                </div>
            </div>
        </form>
        <?php if (!empty($data['raffleBought'])): ?>
            <?php foreach ($data['raffleBought'] as $key => $value): ?>
                <div class="row border">
                    <div class="col-3">
                        <h3 class="text-center"><?= $value['productName']; ?></h3>
                        <img class="card-img-top" src="<?= $value['picture']; ?>">
                    </div>
                    <div class="col-2 align-self-center text-center">
                        <p><strong>Quantidade:</strong></p>
                        <p><strong>Valor unitário:</strong></p>
                        <p><strong>Valor total:</strong></p>
                        <p><strong>Números comprados</strong></p>
                        <p><strong>Data da Compra:</strong></p>
                    </div>
                    <div class="col-2 align-self-center text-center">
                        <p><?= $value['quantityRaffles']; ?></p>
                        <p><?= $value['unitaryValue'] ?> R$</p>
                        <p><?= $value['unitaryValue'] *  $value['quantityRaffles']; ?> R$</p>
                        <p>
                            <strong>
                                <?= $value['boughtRaffles']; ?>
                            </strong>
                        </p>
                        <p><?= date_format(date_create($data['raffleBought'][$key]['created']), 'd-m-Y'); ?></p>
                    </div>
                    <?php if ($value['status'] == 1): ?>
                        <div class="col-5 align-self-center text-right">
                            <h1><span class="badge badge-secondary"><i class="far fa-clock"></i> Aguardando Sorteio</span></h1>
                        </div>
                    <?php elseif ($value['status'] == 2 && $value['owner_id'] != $value['id']): ?>
                        <div class="col-5 align-self-center text-right">
                            <h1><span class="badge badge-primary"><i class="far fa-check-circle"></i> Sorteio Realizado</span></h1>
                            <h5>Que pena, <span class="badge badge-warning">Não foi dessa vez!</span></h5>
                        </div>
                    <?php else: ?>
                        <div class="col-5 align-self-center text-right">
                            <h1><span class="badge badge-primary"><i class="far fa-check-circle"></i> Sorteio Realizado</span></h1>
                            <h5>Parabéns, <span class="badge badge-success">Você ganhou!</span></h5>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="finish-cart" class="text-center p-4S">
                <div class="cart-empty">
                    <h2>Ainda não foram realizados pedidos</h2>
                    <a class="btn btn-primary mt-5" href="index.php?modulo=Raffle&acao=home">Voltar para loja</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

<?php if (isset($_GET['pay']) && $_GET['pay'] == '1'): ?>
    <script>
        localStorage.clear();
    </script>
<?php endif; ?>