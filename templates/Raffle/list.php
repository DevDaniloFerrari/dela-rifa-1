<head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
</head>
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
                    <a class="dropdown-item" href="index.php?modulo=Dashboard&acao=index&dashboardRoute=raffleEdit&raffleId=<?= $raffle['id'] ?>">Editar</a>
                    <a class="dropdown-item" onclick="return confirm('Você tem certeza que deseja deletar essa rifa ? ');" href="index.php?modulo=Raffle&acao=delete&raffleId=<?= $raffle['id'] ?>">Apagar</a>
                </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>