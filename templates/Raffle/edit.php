<div class="d-flex justify-content-center mt-5 text-success">
    <h3>Editar rifa</h3>
</div>
<form class="m-3 mt-5" method="POST" enctype="multipart/form-data" action="index.php?modulo=Raffle&acao=edit&raffleId=<?= $data['raffleId']; ?>">
    <div class="form-group">
        <label for="productName">Nome do produto:</label>
        <input name="productName" value="<?= $data['productName'] ?>" type="text" class="form-control" id="productName" />
    </div>

    <div class="form-group">
        <label for="description">Descrição do produto:</label>
        <input name="description" value="<?= $data['description'] ?>" type="text" class="form-control" id="description" />
    </div>

    <div class="form-group">
        <label for="participantsQuantity">Quantidade de participantes:</label>
        <input name="participantsQuantity" value="<?= $data['participantsQuantity'] ?>" type="number" min="1" class="form-control" id="participantsQuantity" />
    </div>

    <div class="form-group">
        <label for="unitaryValue">Valor unitário:</label>
        <input name="unitaryValue" value="<?= $data['unitaryValue'] ?>" type="number" min="1" max="10" class="form-control" id="unitaryValue" />
    </div>
    <label for="picture">Imagem do produto:</label>

    <div>
        <img src="<?= $data['picture'] ?>" alt="">
        <button id="editPic" type="button" class="btn btn-primary ml-2">Mudar imagem</button>
    </div>
    <div class="form-group mt-3">
        <input id="inputPic" class="form-control" value="<?= $data['picture'] ?>" name="picture" type="hidden"/>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        let inputPic = $('#inputPic');
        $('#editPic').on('click', function() {
            if (inputPic.attr('type') == 'hidden') {
                inputPic.attr('type', 'file');
            } else {
                inputPic.attr('type', 'hidden');
            }
        });
    });
</script>