<head>
    <link rel="stylesheet" href="./css/raffles.css">
</head>
<?php if ($_GET['modulo'] != 'Dashboard'): ?>
    <?php require './templates/layouts/header.php'; ?>
<?php endif; ?>
<body>

    <br>
    <div class="serach-button">
        <form action="" method="POST">
            <div class="col-12">
                <div class="row m-4 p-0">
                    <div class="col-1">

                    </div>
                    <div class="col-10">
                        <input type="text" placeholder="Digite o nome do produto....." name="product-name" class="form-control p-3">
                    </div>
                    <div class="p-0 search-btn d-flex justify-content-center border">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php if (isset($data) && !empty($data)): ?>
        <div class="container p-5">
            <div class="row">
                <?php foreach ($data as $raffle) : ?>
                    <div class="col" style="padding-top: 5px;">
                        <div class="card card-raffle">
                            <img class="card-img-top" src="<?= $raffle['picture']; ?>"  alt="Card image cap">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= $raffle['productName']; ?></h5>
                                <p class="card-text"><?= $raffle['description'] ?></p>
                                <p><i class="fas fa-users"></i> Participantes : <?= $raffle['participantsQuantity'] ?></p>
                                <p><i class="fas fa-money-check-alt"></i> Valor: R$ <?= $raffle['unitaryValue'] ?></p>
                                <a href="index.php?modulo=Raffle&acao=viewProduct&productId=<?= $raffle['id'] ?>" class="mt-auto btn btn-lg btn-block btn-primary"> Participar</a>
                            </div>
                        </div>
                        <br>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <div id="finish-cart" class="text-center p-4 <?= (!empty($data)) ? 'd-none' : ''; ?>">
            <div class="cart-empty">
                <h2>Nenhuma rifa dispónivel no momento</h2>
                <a class="btn btn-primary mt-5" href="index.php?modulo=Raffle&acao=home">Voltar para loja</a>
            </div>
        </div>
    <?php endif; ?>
    <div id="footer">
        <?php require './templates/layouts/footer.php'; ?>
    </div>
</body>