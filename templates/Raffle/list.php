<div class="d-flex justify-content-center mt-5 text-success">
    <h3>Listar rifa</h3>
</div>

<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nome do produto</th>
      <th scope="col">Participantes</th>
      <th scope="col">Valor da rifa</th>
      <th scope="col">Criado por</th>
      <th scope="col">Data criação</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data as $raffle): ?>
        <tr>
            <th><?= $raffle['id']; ?></th>
            <td><?= $raffle['productName']; ?></td>
            <td><?= $raffle['participantsQuantity']; ?></td>
            <td><?= $raffle['unitaryValue']; ?></td>
            <td><?= $raffle['name']; ?></td>
            <td><?= $raffle['created']; ?></td>
            <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Editar</a>
                    <a class="dropdown-item" href="#">Apagar</a>
                </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>