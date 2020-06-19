<?php if ($_GET['modulo'] != 'Dashboard'): ?>
    <?php require './templates/layouts/header.php'; ?>
<?php endif; ?>
<div class="d-flex justify-content-center mt-5 text-success">
    <h3>Editar usuário</h3>
</div>
<form class="m-3 mt-5" method="POST" action="index.php?modulo=User&acao=edit&userId=<?= $data['id']; ?>">
    <div class="form-group">
        <label for="name">Nome:</label>
        <input name="name" value="<?= $data['name'] ?>" type="text" class="form-control" id="productName" />
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input name="email" value="<?= $data['email'] ?>" type="text" class="form-control" id="email" />
    </div>

    <div class="form-group">
        <label for="category_id">Categoria:</label>
        <select class="form-control" name="category_id" id="">
            <?php foreach (Configure::read('categories') as $key => $cat): ?>
                <option value="<?= $key ?>"><?= $cat ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>
