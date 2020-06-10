<div class="d-flex justify-content-center mt-5 text-success">
    <h3>Adicionar rifa</h3>
</div>
<form class="m-3 mt-5" method="POST" enctype="multipart/form-data" action="index.php?modulo=Raffle&acao=addRaffle">
    <div class="form-group">
        <label for="productName">Nome do produto:</label>
        <input name="productName" type="text" class="form-control" id="productName" />
    </div>

    <div class="form-group">
        <label for="description">Descrição do produto:</label>
        <input name="description" type="text" class="form-control" id="description" />
    </div>

    <div class="form-group">
        <label for="participantsQuantity">Quantidade de participantes:</label>
        <input name="participantsQuantity" type="number" min="1" class="form-control" id="participantsQuantity" />
    </div>

    <div class="form-group">
        <label for="unitaryValue">Valor unitário:</label>
        <input name="unitaryValue" type="number" min="1" max="10" class="form-control" id="unitaryValue" />
    </div>

    <div class="form-group">
        <label for="picture">Imagem do produto:</label>
        <input class="form-control" name="picture" type="file"/>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>