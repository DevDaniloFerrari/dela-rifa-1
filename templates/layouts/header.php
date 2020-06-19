<head>
    <title>Dela Rifa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/favicon.ico" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6c03845565.js" crossorigin="anonymous"></script>
    <script src="./js/navbar.js"></script>
</head>

<h1 class="d-flex justify-content-center titulo p-0 m-0">Dela Rifa</h1>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto space">
            <li class="nav-item space">
                <a id="nav-index" class="nav-link nav-title" href="index.php?modulo=Raffle&acao=home"><i class="fas fa-home"></i> Home </a>
            </li>
            <li class="nav-item space">
                <a id="nav-raffles" class="nav-link cursor-pointer nav-title" href="index.php?modulo=Raffle&acao=store"><i
                        class="fas fa-box-open"></i>
                    Rifas</a>
            </li>
            <li class="nav-item space">
                <a id="nav-about" class="nav-link cursor-pointer nav-title" href="index.php?modulo=Raffle&acao=about"><i
                        class="fas fa-info-circle"></i>
                    Sobre</a>
            </li>
            <li class="nav-item space">
                <a id="nav-contact" class="nav-link cursor-pointer nav-title" href="index.php?modulo=Raffle&acao=contact"><i
                        class="far fa-address-card"></i>
                    Contato</a>
            </li>
            <li class="nav-item space">
                <a id="nav-partnership" class="nav-link cursor-pointer nav-title" href="index.php?modulo=Raffle&acao=partnership"><i
                        class="fas fa-handshake"></i>
                    Parcerias</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
        <?php if (!isset($_SESSION['Auth'])): ?>
            <li class="nav-item">
                <a class="nav-link cursor-pointer" href="index.php?modulo=User&acao=add">Registrar <i class="fas fa-user-plus"></i></a> 
            </li>
                <li class="nav-item">
                    <a class="nav-link cursor-pointer" href="index.php?modulo=User&acao=login">Entrar <i class="fas fa-sign-in-alt"></i></a> 
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a id="orderBtn" class="nav-link cursor-pointer" href="index.php?modulo=Raffle&acao=order"><i class="fas fa-clipboard-list"></i> Pedidos</a>
                </li>
                <li class="nav-item">
                    <a id="cartBtn" class="nav-link cursor-pointer" href="index.php?modulo=Raffle&acao=cart"><i class="fas fa-shopping-cart"></i> Carrinho</a>
                </li>
                <?php if ($_SESSION['Auth']['category_id'] == 1): ?>
                    <li class="nav-item">
                        <a id="loginBtn" class="nav-link cursor-pointer" href="index.php?modulo=Dashboard&acao=index"><i class="fas fa-chart-line"></i> Dashboard</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a id="loginBtn" class="nav-link cursor-pointer" href="index.php?modulo=User&acao=profile"><i class="fas fa-user-circle"></i> Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cursor-pointer" href="index.php?modulo=User&acao=logout"><i class="fas fa-sign-out-alt"></i> Sair</a> 
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav> 
</body>
<?php if (isset($_SESSION['flashMessage'])): ?>
        <h3 class="text-<?= ($_SESSION['flashMessage']['class']); ?> d-flex justify-content-center">
            <?php 
                echo $_SESSION['flashMessage']['text'];
                unset($_SESSION['flashMessage']);
            ?>
        </h3>
<?php endif; ?>