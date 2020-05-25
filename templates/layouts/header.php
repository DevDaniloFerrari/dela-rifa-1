<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/register.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="assets/favicon.ico" />

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6c03845565.js" crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Dela Rifa</a>
    <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarNav"
    aria-controls="navbarNav"
    aria-expanded="false"
    aria-label="Toggle navigation"
    >
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-end p-2" id="navbarNav">
        <ul class="navbar-nav ">
        <?php if (!isset($_SESSION['Auth'])): ?>
            <li class="nav-item">
                <a class="nav-link cursor-pointer" href="index.php?modulo=User&acao=add">Registrar <i class="fas fa-user-plus"></i></a> 
            </li>
                <li class="nav-item">
                    <a class="nav-link cursor-pointer" href="index.php?modulo=User&acao=login">Entrar <i class="fas fa-sign-in-alt"></i></a> 
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link cursor-pointer" href="index.php?modulo=User&acao=logout">Sair <i class="fas fa-sign-out-alt"></i></a> 
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>