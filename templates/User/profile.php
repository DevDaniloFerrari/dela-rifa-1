<head>
    <link rel="stylesheet" href="./css/profile.css">
</head>

<?php require './templates/layouts/header.php'; ?>

<body>
    <div class="container">
        <div id="modal">
            <ul class="client-data">Email: <div class="ul" id="email"><?= $data['email']; ?></div>
            </ul>
            <div class="row">
                <div class="col">
                    <ul class="client-data">Nome: <div class="ul" id="fullName"><?= $data['name'] ?></div>
                    </ul>
                </div>
                <div class="col">
                    <ul class="client-data">Data de nascimento : <div class="ul" id="birthDate"><?= $data['birthDate']; ?></div>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="client-data">Sexo: <div class="ul" id="gender"><?= Configure::read('gender', $data['gender']) ?></div>
                    </ul>
                </div>
                <div class="col">
                    <ul class="client-data">Estado civil: <div class="ul" id="maritalStatus"><?= Configure::read('maritalStatus', $data['maritalStatus']) ?></div>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="client-data">Telefone: <div class="ul" id="homePhone"><?= $data['homePhone']; ?></div>
                    </ul>
                </div>
                <div class="col">
                    <ul class="client-data">Celular: <div class="ul" id="cellPhone"><?= $data['cellPhone']; ?></div>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="client-data">Endereço: <div class="ul" id="street"><?= $data['street']; ?></div>
                    </ul>
                </div>
                <div class="col">
                    <ul class="client-data">Número: <div class="ul" id="number"><?= $data['number']; ?></div>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="client-data">Bairro: <div class="ul" id="neighborhood"><?= $data['neighborhood']; ?></div>
                    </ul>
                </div>
                <div class="col">
                    <ul class="client-data">CEP: <div class="ul" id="postalCode"><?= $data['postalCode']; ?></div>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <ul class="client-data">Cidade: <div class="ul" id="city"><?= $data['city']; ?></div>
                    </ul>
                </div>
                <div class="col-3">
                    <ul class="client-data">Estado: <div class="ul" id="state"><?= $data['state']; ?></div>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="client-data">País: <div class="ul" id="country"><?= $data['country']; ?></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="footer" class="">
        <?php require './templates/layouts/footer.php'; ?>
    </div>
</body>
