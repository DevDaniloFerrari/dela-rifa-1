<head>
    <link rel="stylesheet" href="./css/cart.css">
</head>
<?php if ($_GET['modulo'] != 'Dashboard'): ?>
    <?php require './templates/layouts/header.php'; ?>
<?php endif; ?>
<?php $totalPrice = 0; ?>
<body>
    <?php if(!empty($data)): ?>
        <div class="container p-5">
            <?php foreach ($data as $value): ?>
                <?php $totalPrice += count($value['rafflesToBuy']) *  $value['unitaryValue']; ?>
                <div id="raffle-card-<?= $value['id']; ?>" class="row border">
                    <div class="col-3">
                        <h3 class="text-center"><?= $value['productName']; ?></h3>
                        <img class="card-img-top" src="<?= $value['picture']; ?>">
                    </div>
                    <div class="col-2 align-self-center text-center">
                        <p><strong>Quantidade: </strong></p>
                        <p><strong>Valor unitário: </strong></p>
                        <p><strong>Valor total: </strong></p>
                    </div>
                    <div class="col-2 align-self-center text-center">
                        <p><?= count($value['rafflesToBuy']); ?></p>
                        <p><?= $value['unitaryValue']; ?> R$</p>
                        <p><?= count($value['rafflesToBuy']) *  $value['unitaryValue']; ?> R$</p>
                    </div>
                    <div class="col-5 align-self-center text-right">
                        <button onclick="deleteRaffle(<?= $value['id']; ?>);" class="btn btn-danger"><i class="fas fa-minus-circle"></i> Remover</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <div id="finish-buy" class="row">
                <div class="col-3 align-self-center text-center">
                    <h5><strong>Valor total: </strong></h5>
                </div>
                <div class="col-3 align-self-center text-center">
                    <h6><?= $totalPrice; ?> R$</h6>
                </div>
                <div class="col-6">
                    <a href="index.php?modulo=Raffle&acao=pay" class="btn btn-success btn-lg btn-block"><i class="fas fa-check"></i> Finalizar Pedido</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <div id="finish-cart" class="text-center p-4 <?= (!empty($data)) ? 'd-none' : ''; ?>">
            <div class="cart-empty">
                <h2>Carrinho vazio</h2>
                <a class="btn btn-primary mt-5" href="index.php?modulo=Raffle&acao=home">Voltar para loja</a>
            </div>
        </div>
</body>

<script>
    function deleteRaffle(productId) {
        $.ajax({
            type: 'POST',
            url: 'deleteCart.php',
            data: `prodId=${productId}`,
            dataType: 'json',
            success: dados => {
                if (dados.code == 200) {
                    $(`#raffle-card-${productId}`).addClass('d-none');
                    localStorage.removeItem(`raffle-${productId}`);
                }

                if (dados.countRaffle == 0) {
                    $('#finish-buy').addClass('d-none');
                    $("#finish-cart").removeClass('d-none')
                }
            },
            error: erro => {
                console.log(erro)
            }
        });
    }
</script>