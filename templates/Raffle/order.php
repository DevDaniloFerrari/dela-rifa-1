<head>
    <link rel="stylesheet" href="./css/cart.css">
</head>

<style>
    p {
        word-break: break-all;
    }
</style>

<?php if ($_GET['modulo'] != 'Dashboard'): ?>
    <?php require './templates/layouts/header.php'; ?>
<?php endif; ?>
<body>
    <div class="container p-5">
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
                        <p><strong>Rifas compradas:</strong></p>
                        <p><strong>Data da Compra:</strong></p>
                        <?php if ($value['draw_raffle'] != 0): ?>
                            <p><strong>Número sorteado:</strong></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-2 align-self-center text-center">
                        <p><?= $value['quantityRaffles']; ?></p>
                        <p><?= $value['unitaryValue'] ?> R$</p>
                        <p><?= $value['unitaryValue'] *  $value['quantityRaffles']; ?> R$</p>
                        <p class="mt-4">
                            <strong>
                                <button onclick="showRafflesNumbers(<?= $value['raffle_buy_id'] ?>)" id="bought-raffles" class="btn btn-primary">Ver rifas compradas</button>
                                <div id="raffles-to-show-<?= $value['raffle_buy_id'] ?>" class="d-none">
                                    <?= $value['boughtRaffles']; ?>
                                </div>
                            </strong>
                        </p>
                        <p class=""><?= date_format(date_create($data['raffleBought'][$key]['created']), 'd-m-Y'); ?></p>
                        <p><?= $value['draw_raffle']; ?></p>
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

<div id="modal-msg" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Rifas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-size: 30px;">
          <p>Rifas compradas = <span id="insert-text"></span></p>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
<?php if (isset($_GET['pay']) && $_GET['pay'] == '1'): ?>
    <script>
        localStorage.clear();
    </script>
<?php endif; ?>

<script>
    function showRafflesNumbers(raffleId) {
        let rafflesToShow = $(`#raffles-to-show-${raffleId}`).text();
        $("#insert-text").html(rafflesToShow);
        $('#modal-msg').modal('show');
    }
</script>