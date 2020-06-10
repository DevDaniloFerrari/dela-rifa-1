<body>
    <?php if (isset($_SESSION['flashMessage'])): ?>
        <h3 class="text-<?= ($_SESSION['flashMessage']['class']); ?> d-flex justify-content-center">
            <?php 
                echo $_SESSION['flashMessage']['text'];
                unset($_SESSION['flashMessage']);
            ?>
        </h3>
    <?php endif; ?>
    <?php require './templates/layouts/header.php'; ?>

    <div class="container d-flex justify-content-center mt-5">
        <div id="modal">

            <img src="https://user-images.githubusercontent.com/40414119/79510700-34195c80-8014-11ea-94eb-7d34a9181004.png"
                class="mx-auto d-block">
            <form name="loginForm" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-lg btn-block login-button">Entrar</button>
                </div>
            </form>

            <p>Ainda não possui cadastro?
                <a href="index.php?modulo=User&acao=add">Registre-se</a>
            </p>
        </div>
    </div>
</body>
