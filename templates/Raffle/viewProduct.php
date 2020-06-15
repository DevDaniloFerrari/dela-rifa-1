<div class="col-12 p-2 mt-5">
    <div class='row m-0'>
        <div class="col-12 mb-4">
            <div class="mb-2 d-flex justify-content-center raffle-tittle">
                <?= $data['productName']; ?>
            </div>   
        </div>

        <div class="col-6 border-dark border-right">        
            <div class="product-img mt-2 d-flex justify-content-center">
                <img src="<?= $data['picture']; ?>" alt="produto" style="width:450px;height:110px">
            </div>
        </div>

        <div class="col-6">        
            <div class="row m-0 border-bottom p-3">
                <div class="col-6 d-flex justify-content-center">
                    Participantes : <?= $data['participantsQuantity']; ?>
                </div>    
                <div class="col-6 d-flex justify-content-center">
                    Restante : <?= $data['participantsQuantity']; ?>
                </div>  
            </div>
            <div class="col-12 d-flex justify-content-center p-2">
                Escolha uma ou mais rifas na cartilha abaixo
            </div>

            <div class="border p-3">
                <div class="row m-0">
                    <?php for ($i = 1; $i <= $data['participantsQuantity']; $i ++): ?>
                        <div id="raffle-n-<?= $i; ?>" onclick="checkRaffle(<?= $i; ?>, <?= $data['id']; ?>)" class="border p-2 ml-1 mt-2 d-flex justify-content-center raffle-number">
                            <?= $i; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-start mt-2">
                Números escolhidos : <span id="chosen-numbers"></span>
            </div>

            <div class="col-12 raffle-value d-flex justify-content-center mt-4">
                Valor cartela : R$ <?= $data['unitaryValue']; ?>
            </div>

            <div class="col-12 d-flex justify-content-center mt-4">
                <a id="btn-cart" class="btn btn-primary btn-cart" style="width: 500px; height: 50px; font-size:24px" href="#">Adicionar ao carrinho</a>
            </div>

            <div class="col-12 d-flex justify-content-center mt-4">
                <a id="btn-part" class="btn btn-primary btn-part" style="width: 500px; height: 50px; font-size:24px" href="#">Finalizar compra</a>
            </div>
        </div>
    </div>
    <div class="col-6 text-center mt-5">
        detalhes do produto
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

    let dataPost = [
        {
            productId : productGetId, 
            raffles : localStorage.getItem(`raffle-${productGetId}`)
        },
    ];

    dataPost = JSON.stringify(dataPost);

    $("#btn-cart").on('click', function() {
        editId = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'cart.php',
            data: `dataCart=${dataPost}`,
            dataType: 'json',
            success: dados => {
                console.log(dados);
            },
            error:  erro => {console.log(erro)}
        });
    });

</script>