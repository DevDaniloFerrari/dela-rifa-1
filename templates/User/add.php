<body>
    
    <?php require './templates/layouts/header.php'; ?>

    <div class="container d-flex justify-content-center">
        <div id="modal">
            <form name="registerForm" method="post">
                <div class="row">
                    <div class="col-4">
                        <h3 class="text-center">Dados Pessoais</h3>
                        <hr>
                        <div class="form-group required">
                            <label for="fullName">Nome completo:</label>
                            <input type="text" class="form-control" value="<?= isset($_POST['Nome']) ? $_POST['Nome'] : ''?>" name="name" id="fullName">
                            <span class="text-danger"><?= isset($data['empty']['Nome']) ? $data['empty']['Nome'] : '' ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group required">
                                    <label for="maritalStatus">Estado civil: </label>
                                    <select type="maritalStatus" class="form-control" name="maritalStatus" id="maritalStatus">
                                        <?php foreach (Configure::read('maritalStatus') as $key => $value): ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group required">
                                    <label for="gender">Sexo:</label>
                                    <select type="text" class="form-control" name="gender" id="gender">
                                        <?php foreach (Configure::read('gender') as $key => $value): ?>
                                            <option value="<?= $key ?>"><?= $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="birthDate">Data de nascimento:</label>
                            <input type="date" class="form-control" value="<?= isset($_POST['birthDate']) ? $_POST['birthDate'] : ''?>"  name="birthDate" id="birthDate">
                            <span class="text-danger"><?= isset($data['empty']['birthDate']) ? $data['empty']['birthDate'] : '' ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group required">
                                    <label for="homePhone">Telefone: </label>
                                    <input type="number" class="form-control" value="<?= isset($_POST['homePhone']) ? $_POST['homePhone'] : ''?>" name="homePhone" id="homePhone">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['homePhone'])) {
                                            echo $data['empty']['homePhone'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group required">
                                    <label for="cellPhone">Celular:</label>
                                    <input type="number" class="form-control" value="<?= isset($_POST['cellPhone']) ? $_POST['cellPhone'] : ''?>" name="cellPhone" id="cellPhone">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['cellPhone'])) {
                                            echo $data['empty']['cellPhone'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <h3 class="text-center">Endereço</h3>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group required">
                                    <label for="postalCode">CEP:</label>
                                    <input onblur="verificarCep()" type="text" maxlength="8" class="form-control" value="<?= isset($_POST['postalCode']) ? $_POST['postalCode'] : ''?>" name="postalCode" id="postalCode">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['postalCode'])) {
                                            echo $data['empty']['postalCode'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group required">
                                    <label for="number">Numero:</label>
                                    <input type="number" class="form-control" value="<?= isset($_POST['number']) ? $_POST['number'] : ''?>" name="number" id="number">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['number'])) {
                                            echo $data['empty']['number'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group required">
                                    <label for="street">Logradouro:</label>
                                    <input readonly type="text" class="form-control" value="<?= isset($_POST['street']) ? $_POST['street'] : ''?>" name="street" id="street">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['street'])) {
                                            echo $data['empty']['street'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group required">
                                    <label for="neighborhood">Bairro:</label>
                                    <input readonly type="text" class="form-control" value="<?= isset($_POST['neighborhood']) ? $_POST['neighborhood'] : ''?>" name="neighborhood" id="neighborhood">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['neighborhood'])) {
                                            echo $data['empty']['neighborhood'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group required">
                                    <label for="state">Estado:</label>
                                    <input readonly type="text" class="form-control" value="<?= isset($_POST['state']) ? $_POST['state'] : ''?>" name="state" id="state">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['state'])) {
                                            echo $data['empty']['state'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group required">
                                    <label for="city">Cidade:</label>
                                    <input readonly type="text" class="form-control" value="<?= isset($_POST['city']) ? $_POST['city'] : ''?>" name="city" id="city">
                                    <div class="text-danger">
                                        <?php
                                        if (isset($data['empty']['city'])) {
                                            echo $data['empty']['city'];
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="country">País:</label>
                            <input type="text" class="form-control" value="<?= isset($_POST['country']) ? $_POST['country'] : ''?>" name="country" id="country">
                            <div class="text-danger">
                                <?php
                                if (isset($data['empty']['country'])) {
                                    echo $data['empty']['country'];
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <h3 class="text-center">Dados de Login</h3>
                        <hr>
                        <div class="form-group required">
                            <label for="email">Email:</label>
                            <input type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''?>" class="form-control" name="email" id="email">
                            <div class="text-danger">
                                <?php
                                if (isset($data['empty']['email'])) {
                                    echo $data['empty']['email'];
                                }
                                if (isset($data['emailDiff'])) {
                                    echo $data['emailDiff'];
                                }

                                if (isset($data['existEmail'])) {
                                    echo $data['existEmail'];
                                }

                                ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="confirmEmail">Confirme seu Email:</label>
                            <input type="email" class="form-control" value="<?= isset($_POST['confirmEmail']) ? $_POST['confirmEmail'] : ''?>" name="confirmEmail" id="confirmEmail">
                            <div class="text-danger">
                                <?php
                                if (isset($data['empty']['email'])) {
                                    echo $data['empty']['email'];
                                }
                                if (isset($data['emailDiff'])) {
                                    echo $data['emailDiff'];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div class="text-danger">
                                <?php
                                if (isset($data['empty']['password'])) {
                                    echo $data['empty']['password'];
                                    echo '<br>';
                                }
                                if (isset($data['passwordLength'])) {
                                    echo $data['passwordLength'];
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="confirmPassword">Confirme sua Senha:</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                            <div class="text-danger">
                                <?php
                                if (isset($data['empty']['password'])) {
                                    echo $data['empty']['password'];
                                    echo '<br>';
                                }
                                if (isset($data['passwordLength'])) {
                                    echo $data['passwordLength'];
                                    echo '<br>';
                                }
                                if (isset($data['passwordDiff'])) {
                                    echo $data['passwordDiff'];
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-block register-button">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center">
                <p>Já é cadastrado?
                    <a href="index.php?modulo=User&acao=login">Login</a>
                </p>
            </div>
        </div>
    </div>
    <script>
        function verificarCep(){
            var cep = document.getElementById('postalCode').value;

            var url = `https://viacep.com.br/ws/${cep}/json/`;
            var request = new XMLHttpRequest();

            request.onerror = function () {
                alert("CEP inválido");
                document.forms["registerForm"]["postalCode"].value = "";
                document.forms["registerForm"]["street"].value = "";
                document.forms["registerForm"]["neighborhood"].value = "";
                document.forms["registerForm"]["state"].value = "";
                document.forms["registerForm"]["city"].value = "";
            };

            request.open('GET', url, true);
            request.onload = function () {
                var data = JSON.parse(this.response);

                if (request.status >= 200 && request.status < 400) {
                    document.forms["registerForm"]["street"].value = data.logradouro;
                    document.forms["registerForm"]["neighborhood"].value = data.bairro;
                    document.forms["registerForm"]["city"].value = data.localidade;
                    document.forms["registerForm"]["state"].value = data.uf;
                } else {
                    alert("Erro interno contate um administrador");

                }
            };

            request.send();
        }
    </script>
</body>