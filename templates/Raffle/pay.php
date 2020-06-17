<head>
  <link rel="stylesheet" href="./css/raffles.css">
</head>

<body>
<?php $totalPrice = 0; ?>
  <div class="container">
    <div id="border">
      <div class="row">
        <div class="col-md-6">
          <h2>Pedido:</h2>
        </div>
      </div>
      <div class="row">
        <table class="table table-striped">
          <thead>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Valor Unitário</th>
            <th scope="col">Valor</th>
            <th scope="col">Remover</th>
          </thead>
          <tbody>
            <?php foreach ($data as $value): ?>
              <?php $totalPrice += count($value['rafflesToBuy']) *  $value['unitaryValue']; ?>
              <tr>
                <th scope="row"><?= $value['productName'] ?></th>
                <td><?= count($value['rafflesToBuy']); ?></td>
                <td><?= $value['unitaryValue']; ?> R$</td>
                <td><?= count($value['rafflesToBuy']) *  $value['unitaryValue']; ?> R$</td>
                <td><button onclick="deleteRaffle(<?= $value['id']; ?>);" class="btn btn-danger">Remover item</button></td>
              </tr>
            <?php endforeach; ?>
            <tr>
                <th scope="row"></th>
                <td class="m-5"></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            <tr>
                <th scope="row"></th>
                <td class="m-5">Valor Total : </td>
                <td></td>
                <td><?= $totalPrice; ?> R$</td>
                <td></td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <h3 class="text-center mt-5 text-success">Pagamento</h3>
  <form class="m-3 mt-2" method="POST" enctype="multipart/form-data">
    <div class="d-flex justify-content-center row">
      <div class="form-group col-md-6">
        <label for="name">Nome completo:</label>
        <input name="name" type="text" class="form-control" id="name" />
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="form-group col-md-3">
        <label for="name">Número do cartão</label>
        <input name="name" type="text" class="form-control" id="name" />
      </div>
      <div class="form-group col-md-2">
        <label for="name">Validade</label>
        <input name="name" type="date" class="form-control" id="name" />
      </div>
      <div class="form-group col-md-1">
        <label for="name">CVV</label>
        <input name="name" type="text" class="form-control" id="name" />
      </div>
	</div>
	
	<?php foreach ($data as $value): ?>
		<?php foreach ($value['rafflesToBuy'] as $v): ?>
			<input type="hidden" name="raffles[<?= $value['id'] ?>][]" value="<?= $v; ?>">
		<?php endforeach; ?>
	<?php endforeach; ?>

    <div class="form-group text-center mt-2">
      <button type="submit" class="btn btn-success col-3">Enviar</button>
    </div>
  </form>


  <div id="modal-msg" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Atenção</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-danger">Atenção este site foi produzido apenas para fim didáticos por favor não insira dados reais para teste da plataforma</p>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  <div id="footer">
    <?php require './templates/layouts/footer.php'; ?>
  </div>
</body>


<script>
  $(document).ready(function() {
    $('#modal-msg').modal('show');
  });

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
					window.location = "?modulo=Raffle&acao=store";
			} else {
				window.location = "?modulo=Raffle&acao=pay";
			}
		},
		error: erro => {
			console.log(erro)
		}
	});
  }
</script>