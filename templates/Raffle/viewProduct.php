<?php if ($_GET['modulo'] != 'Dashboard'): ?>
    <?php require './templates/layouts/header.php'; ?>
<?php endif; ?>
<div class="col-12 p-2 mt-5">
    <div class='row m-0'>
        <div class="col-6">
            <div id="modal">
                <div class="product-img mt-2 d-flex justify-content-center card">
                    <img class="card-img-top" src="<?= $data['picture']; ?>" alt="produto" alt="Card image cap">
                </div>
            </div><br>
            <p>Descrição: Produto original e direto da fábrica, acompanhando garantia de 3 meses (caso ocorra algum defeito ou falha).
                Não nos responsabilizamos se o produto for vendido para terceiros, só mantemos contato com o titular da compra.
                Caso tenha alguma dúvida, contate nosso suporte. A equipe Dela Rifa está a disposição. Boa sorte! =) </p>
        </div>

        <div class="col-6">
            <div class="col-12 mb-4">
                <div class="mb-2 d-flex justify-content-center raffle-tittle">
                    <?= $data['productName']; ?>
                </div>
            </div>
            <div class="row m-0 border-bottom p-3">
                <div class="col-6 d-flex justify-content-center">
                    <b>Participantes :</b> <?= $data['participantsQuantity']; ?>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <b>Restante :</b> <?= (isset($data['buyedRaffles'])) ? $data['participantsQuantity'] - $data['buyedRaffles']['countBuyed'] : $data['participantsQuantity']; ?>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center p-2">
                Escolha uma ou mais rifas da cartela abaixo
            </div>

            <div class="border p-3">
                <div class="row m-0">
                    <?php for ($i = 1; $i <= $data['participantsQuantity']; $i++) : ?>
                        <?php if (isset($data['buyedRaffles']) && array_key_exists($i, $data['buyedRaffles'])): ?>
                       
                        <?php else: ?>
                            <div id="raffle-n-<?= $i; ?>" onclick="checkRaffle(<?= $i; ?>, <?= $data['id']; ?>)" class="border p-2 ml-1 mt-2 d-flex justify-content-center raffle-number">
                                <?= $i; ?>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-start mt-2">
                <b>Números escolhidos :</b> <span id="chosen-numbers"></span>
            </div>
            <hr>

            <div class="col-12 raffle-value d-flex justify-content-center mt-4">
                Valor Rifa : R$ <?= $data['unitaryValue']; ?>
            </div>
            <hr>

            <div class="col-12 d-flex justify-content-center mt-4">
                <a id="btn-cart" class="btn btn-success btn-cart" style="width: 500px; height: 50px; font-size:24px" href="#"><i class="fas fa-shopping-cart"> Adicionar ao carrinho</i></a>
            </div>

            <div class="col-12 d-flex justify-content-center mt-4">
                <a id="btn-part" class="btn btn-success btn-part" style="width: 500px; height: 50px; font-size:24px" href="#"><i class="fas fa-check"> Finalizar compra</i></a>
            </div>
        </div>
    </div>
</div>

<script>
    let productGetId = '<?= $_GET['productId']; ?>';
    let raffles = [];
    let rafflesMark = localStorage.getItem(`raffle-${productGetId}`);

    $(document).ready(function() {
        if (rafflesMark != null) {
            if (rafflesMark.includes(',')) {
                let idToMark = rafflesMark.split(",");
                for (i of idToMark) {
                    $(`#raffle-n-${i}`).addClass('border border-primary checked');
                    raffles.push(parseInt(i))
                }
            } else {
                $(`#raffle-n-${rafflesMark}`).addClass('border border-primary checked');
                raffles.push(rafflesMark)
            }
        }
    });

    function checkRaffle(raffleNumber, productId) {
        let selectedRaffle = $(`#raffle-n-${raffleNumber}`);

        if (!raffles.includes(parseInt(raffleNumber))) {
            raffles.push(parseInt(raffleNumber));
            localStorage.setItem(`raffle-${productId}`, raffles);
        } else {
            raffles = removeItemOnce(raffles, raffleNumber);
            localStorage.setItem(`raffle-${productId}`, raffles)
            if (raffles.length == 0) {
                localStorage.removeItem(`raffle-${productId}`)
            }
        }

        if (selectedRaffle.hasClass("checked")) {
            selectedRaffle.removeClass('border border-primary checked');
            selectedRaffle.addClass('border');
        } else {
            selectedRaffle.addClass('border border-primary checked');
        }
        if (localStorage.getItem(`raffle-${productId}`) != null) {
            $('#chosen-numbers').text(' ' + localStorage.getItem(`raffle-${productId}`));
        } else {
            $('#chosen-numbers').text('');
        }
    }

    if (localStorage.getItem(`raffle-${productGetId}`) != null) {
        $('#chosen-numbers').text(' ' + localStorage.getItem(`raffle-${productGetId}`));
    } else {
        $('#chosen-numbers').text('');
    }

    function removeItemOnce(arr, value) {
        let index = arr.indexOf(value);
        if (index > -1) {
            arr.splice(index, 1);
        }
        return arr;
    }

    $('#btn-part').on('click', function() {
        let checkRaffles = localStorage.getItem(`raffle-${productGetId}`);
        if (checkRaffles != null) {
            $('#btn-part').attr('href', 'index.php?modulo=Raffle&acao=pay');
        } else {
            alert('Você precisa selecionar ao menos uma rifa para prosseguir !');
            $('#btn-part').attr('href', '#');
        }
    });

    $("#btn-cart").on('click', function() {
        let dataPost = [{
            productId: productGetId,
            raffles: localStorage.getItem(`raffle-${productGetId}`)
        }, ];
        dataPost = JSON.stringify(dataPost);
        editId = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'cart.php',
            data: `dataCart=${dataPost}`,
            dataType: 'json',
            success: dados => {
                if (dados.code === 200) {
                    window.location = "?modulo=Raffle&acao=cart";
                }
            },
            error: erro => {
                console.log(erro)
            }
        });
    });
</script>