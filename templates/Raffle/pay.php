<head>
  <link rel="stylesheet" href="./css/raffles.css">
</head>

<body>

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
            <th scope="col">Valor Unitário</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Valor</th>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <h3 class="text-center mt-5 text-success">Pagamento</h3>
  <form class="m-3 mt-5" method="POST" enctype="multipart/form-data" action="">
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

    <div class="form-group text-center mt-4 ">
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
</body>
<div id="footer">
  <?php require './templates/layouts/footer.php'; ?>
</div>


<script>
  $(document).ready(function() {
    $('#modal-msg').modal('show');
  });
</script>