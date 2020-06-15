<div class="d-flex justify-content-center mt-5 text-success">
    <h3>Pagamento</h3>
</div>
<form class="m-3 mt-5" method="POST" enctype="multipart/form-data" action="">
    <div class="d-flex justify-content-center col-12">
        <div class="form-group col-6">
            <label for="name">Nome completo:</label>
            <input name="name" type="text" class="form-control" id="name" />
        </div>
    </div>
    <div class="row m-0 d-flex justify-content-center">
        <div class="form-group col-3">
            <label for="name">Número do cartão</label>
            <input name="name" type="text" class="form-control" id="name" />
        </div>

        <div class="form-group col-2">
            <label for="name">Validade</label>
            <input name="name" type="date" class="form-control" id="name" />
        </div>
        <div class="form-group col-1">
            <label for="name">CVV</label>
            <input name="name" type="text" class="form-control" id="name" />
        </div>
    </div>

    <div class="form-group d-flex justify-content-center mt-4 ">
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

<script>
    $(document).ready(function() {
        $('#modal-msg').modal('show');
    });
</script>