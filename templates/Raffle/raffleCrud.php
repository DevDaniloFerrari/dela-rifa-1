<div class="container">
    <h3>Opções</h3>
    <?php if (isset($_SESSION['messageSuccess'])): ?>
        <h3 class="text-<?= $_SESSION['messageSuccess']['class']; ?> d-flex justify-content-center">
            <?php 
                echo $_SESSION['messageSuccess']['message'];
                unset($_SESSION['messageSuccess']); 
            ?>
        </h3>
    <?php endif; ?>
    <div class="col-12 border p-2 row m-0">
        <div class="col-1">
        </div>
        
        <div class="col-md-2 p-2">
            <a href="index.php?modulo=Raffle&acao=raffleCrud&raffleAction=editRaffle" class="btn btn-secondary"> <i class="fas fa-edit"></i> Editar rifa</a>
        </div>

        <div class="col-md-2 p-2">
            <a href="index.php?modulo=Raffle&acao=raffleCrud&raffleAction=deleteRaffle" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Deletar rifa</a>
        </div>

        <div class="col-md-3 p-2">
            <a href="index.php?modulo=Raffle&acao=raffleCrud&raffleAction=listAll" class="btn btn-primary"> <i class="fas fa-list"></i> Listar todas rifas</a>
        </div>

        <div class="col-md-3 p-2">
            <a href="index.php?modulo=Raffle&acao=raffleCrud&raffleAction=listOneRaffle" class="btn btn-primary"> <i class="fas fa-dice-one"></i> Listar apenas uma rifa</a>
        </div>


    </div>
    <br>
    <?php if (isset($_SESSION['message'])): ?>
        <h3 class="text-<?= $data['messageClass']; ?> d-flex justify-content-center">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']); 
            ?>
        </h3>
    <?php endif; ?>
    <br>
    <br>
    <?php if ($data['action'] == 'listOneRaffle'): ?>
        <form action="" method="POST">
            <div>
                <label for="raffleId">ID da rifa:</label>
                <input class="form-control" type="text" placeholder="Digite o ID da rifa" name="raffleId">
                <button type="submit" class="btn btn-success my-4">Enviar</button>
            </div>
        </form>
    <?php endif; ?>

    <h3 class="d-flex justify-content-center"><?= $data['actionTitle']; ?></h3>
    <?php if ($data['action'] == 'listAll' || $data['action'] == 'listOneRaffle'): ?>
        <?php if (isset($data['raffles']) && !empty($data['raffles'])): ?>
            <div class="d-flex justify-content-center p-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome do Produto</th>
                            <th scope="col">Qntd Participantes</th>
                            <th scope="col">VALOR UNITÁRIO</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    <?php foreach($data['raffles'] as $raffle): ?>
                        <tr>
                            <th><?= $raffle['id']; ?></th>
                            <td><?= $raffle['productName']; ?></td>
                            <td><?= $raffle['participantsQuantity']; ?></td>
                            <td><?= $raffle['unitaryValue']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-primary d-flex justify-content-center my-5 ">
                <h3 class="text-warning">Não foram adicionadas rifas.</h3>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($data['action'] != 'listAll' && $data['action'] != 'listOneRaffle'): ?>
        <form class="m-3" method="POST">

            <?php if ($data['action'] == 'deleteRaffle'): ?>
                <div class="form-group">
                    <label for="raffleDelete">ID da rifa:</label>
                    <input placeholder="Digite o ID da rifa que deseja deletar" name="raffleDelete" type="text" class="form-control" id="raffleDelete" />
                </div>
            <?php else: ?>
                <div class="form-group <?= ($data['action'] == 'editRaffle') ? '' : 'd-none'; ?>">
                    <label  class="form-group <?= ($data['action'] == 'editRaffle') ? '' : 'd-block'; ?>" for="raffleEdit">ID da rifa:</label>
                    <input placeholder="Digite o ID da rifa que deseja editar" name="raffleEdit" type="<?= ($data['action'] == 'editRaffle') ? 'text' : 'hidden'; ?>" class="form-control" id="raffleEdit" />
                </div>

                <div class="form-group">
                    <label for="productName">Nome do produto:</label>
                    <input <?= ($data['action'] == 'editRaffle') ? 'readonly' : ''; ?> name="productName" type="text" class="form-control" id="productName" />
                </div>
                
                <div class="form-group">
                    <label for="participantsQuantity">Quantidade de participantes:</label>
                    <input <?= ($data['action'] == 'editRaffle') ? 'readonly' : ''; ?> name="participantsQuantity" type="number" min="1" class="form-control" id="participantsQuantity" />
                </div>

                <div class="form-group">
                    <label for="unitaryValue">Valor unitário:</label>
                    <input <?= ($data['action'] == 'editRaffle') ? 'readonly' : ''; ?> name="unitaryValue" type="number" min="1" max="10" class="form-control" id="unitaryValue" />
                </div>
            <?php endif; ?>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<script>
    $('#raffleEdit').on('blur', function() {
        editId = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'getData.php',
            data: `raffleEdit=${editId}`,
            success: dados => {
                if (dados != '') {
                    let editData = $.parseJSON(dados);
                    $('#productName').val(editData.productName);
                    $('#participantsQuantity').val(editData.participantsQuantity);
                    $('#unitaryValue').val(editData.unitaryValue);
                    $('#productName').removeAttr("readonly");
                    $('#participantsQuantity').removeAttr("readonly");
                    $('#unitaryValue').removeAttr("readonly");
                } else {
                    $('#productName').val('');
                    $('#participantsQuantity').val('');
                    $('#unitaryValue').val('');
                    $('#productName').attr("readonly", "readonly");;
                    $('#participantsQuantity').attr("readonly", "readonly");;
                    $('#unitaryValue').attr("readonly", "readonly");;
                }
                
            },
            error:  erro => {console.log(erro)}

        });
    });

</script>