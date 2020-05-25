<body>
    <?php if (isset($_SESSION['message'])): ?>
        <h3 class="text-danger d-flex justify-content-center">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']); 
            ?>
        </h3>
    <?php endif; ?>

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
                <a href="register.html">Registre-se</a>
            </p>

        </div>
    </div>
</body>