<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barths & Pizzas</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">

        <!-- Navigation-->
        <x-nav/>

        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="masthead-subheading">Bem Vindo ao Barths & Pizzas</div>
                <div class="masthead-heading text-uppercase">Faça já o seu Pedido</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Clicando aqui!</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section pb-0" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Seu Pedido</h2>
                    <h3 class="section-subheading text-muted">Faça já o seu pedido e receba a melhor pizza do mundo em sua casa!</h3>
                    <h3>Quantidade de Pizzas</h3>
                    <div class="row d-flex justify-content-center mb-4">
                        <div class="col-md-8 col-8 justify-content-center d-flex mb-4">
                            <input type="number" name="quantidade" class="form-control" id="quantidadePizzas" value="1" min="1">
                        </div>
                        <div class="col-md-8 col-8">
                        <a class="btn btn-primary btn-xl text-uppercase w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#orderFormModal">
                                Formulário de Pedido
                        </a>
                        </div>
                    </div>
                    <h3 class="pt-4">Acompanhe seu Pedido</h3>

                    <form method="GET" action="{{ route('pizzaria.acompanhar') }}">
                        <div class="row d-flex justify-content-center mb-4">
                            <div class="col-md-8 col-8 mb-3">
                                <input
                                    type="text"
                                    name="senha"
                                    class="form-control"
                                    placeholder="Digite a senha do seu pedido"
                                    required
                                >
                            </div>

                            <div class="col-md-8 col-8">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-xl text-uppercase w-100"
                                >
                                    Consultar Pedido
                                </button>
                            </div>
                        </div>
                    </form>
                </div> 
                <hr>

            </div>

        </section>
        <!-- Portfolio Grid-->
        <x-portfolio :sabores="$sabores" :tamanhos="$tamanhos"/>
        <!-- Contact-->
        <x-contact/>
        <!-- Footer-->
        <x-footer/>

        <x-script/>


        <div class="modal fade" id="orderFormModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Formulário de Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- SEU FORMULÁRIO AQUI -->
                    <form id="formPedidoPizza" action="{{ route('pizzaria.store') }}" method="post">

                        @csrf

                        <div class="row d-flex justify-content-center mt-4">
                            <div class="col-10 col-md-4 border-end border-start text-center pt-3">
                                <h3>Local de Entrega</h3>
                                <input type="text" name="bairro" class="form-control" placeholder="Seu Bairro" required>
                                <input type="text" name="rua" class="form-control mt-2" placeholder="Sua Rua" required>
                                <input type="text" name="numero" class="form-control mt-2" placeholder="Número da Residência" required>
                                <input type="text" name="complemento" class="form-control mt-2" placeholder="Complemento (Opcional)">
                                <hr>
                                <input type="text" name="nome" class="form-control" placeholder="Seu Nome" required>
                                <input type="text" name="telefone" class="form-control mt-2" placeholder="Seu Telefone" required>
                                <input type="text" name="senha" class="form-control mt-2" placeholder="Sua Senha*" required>
                                <span class="text-muted small text-end">*Essa senha serve para consultar o seu pedido, não compartilhe com ninguém!</span>
                                <hr>
                            </div>

                            <div id="pizzasContainer" class="row mt-4"></div>

                            <hr class="mt-4">
                            <input type="hidden" name="pizzas" id="pizzas">
                            <input type="hidden" name="preco" id="preco">
                            <div class="col-12 justify-content-between d-flex flex-column flex-md-row gap-3 mt-4">
                                <div class="col-md-3 col-12 justify-content-center d-flex"><button type="reset" class="btn btn-danger btn-xl text-uppercase">Limpar Pedido</button></div>
                                <div class="col-md-3 col-12 justify-content-center d-flex"><button type="submit" class="btn btn-primary btn-xl text-uppercase">Finalizar Pedido</button></div>
                            </div>
                        </div>


                    </form>
                </div>

                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const modal = document.getElementById('orderFormModal');
                const container = document.getElementById('pizzasContainer');

                modal.addEventListener('show.bs.modal', function () {

                    const quantidade = parseInt(document.getElementById('quantidadePizzas').value) || 1;
                    container.innerHTML = '';

                    for (let i = 0; i < quantidade; i++) {
                        container.innerHTML += gerarPizzaHTML(i + 1);
                    }
                });

                function gerarPizzaHTML(numero) {
                    return `
                    <div class="pizza-bloco">
                        <div class="col-12 mt-4">
                            <h4 class="text-center">Pizza ${numero}</h4>
                            <hr>
                            <div class="row d-flex justify-content-between">
                                <!-- TAMANHO -->
                                <div class="col-10 col-md-6 d-flex justify-content-between flex-column mb-4 ">
                                    <h5>Escolha o Tamanho</h5>
                                    @foreach ($tamanhos as $tamanho)
                                        <div>
                                            <input type="radio"
                                                data-qsabores="{{ $tamanho->qsabores }}"
                                                data-preco="{{ $tamanho->preco }}"
                                                name="pizzas[${numero}][tamanho]"
                                                value="{{ $tamanho->nome }}" required>
                                                
                                            {{ $tamanho->nome }} - {{ $tamanho->qpedacos }} pedaços - {{ $tamanho->qsabores }} sabores - R$ {{ number_format($tamanho->preco, 2, ',', '.') }}
                                        </div>
                                    @endforeach
                                </div>
                                <!-- SABORES -->
                                <div class="col-10 col-md-6 d-flex justify-content-between flex-column">
                                    <h5>Sabores</h5>
                                    <strong>Salgados</strong><br>
                                    @foreach ($salgados as $salgado)
                                        <div>
                                            <input type="checkbox"
                                                data-preco="{{ $salgado->preco }}"
                                                name="pizzas[${numero}][sabores][]"
                                                class="sabor-checkbox"
                                                value="{{ $salgado->nome }}">
                                            {{ $salgado->nome }} - R$ {{ number_format($salgado->preco, 2, ',', '.') }}
                                        </div>
                                    @endforeach
                                    <strong class="mt-2 d-block">Doces</strong>
                                    @foreach ($doces as $doce)
                                        <div>
                                            <input type="checkbox"
                                                data-preco="{{ $doce->preco }}"
                                                class="sabor-checkbox"
                                                name="pizzas[${numero}][sabores][]"
                                                value="{{ $doce->nome }}">
                                            {{ $doce->nome }} - R$ {{ number_format($doce->preco, 2, ',', '.') }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                }

            });

            document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('formPedidoPizza');
            const inputPizzas = document.getElementById('pizzas');
            const inputPreco = document.getElementById('preco');

            form.addEventListener('submit', function (e) {

                let descricaoPizzas = [];
                let precoTotal = 0;
                let erro = false;

                document.querySelectorAll('.pizza-bloco').forEach((pizza, index) => {

                // Tamanho selecionado
                const tamanho = pizza.querySelector('input[type="radio"]:checked');
                if (!tamanho) return;

                const saboresSelecionados = pizza.querySelectorAll('.sabor-checkbox:checked');
                if (saboresSelecionados.length === 0) {
                    alert(`Escolha pelo menos 1 sabor para a Pizza ${index + 1}`);
                    erro = true;
                    return;
                }

                const nomeTamanho = tamanho.value;
                const precoTamanho = parseFloat(tamanho.dataset.preco);
                precoTotal += precoTamanho;

                // Sabores
                let sabores = [];
                pizza.querySelectorAll('.sabor-checkbox:checked').forEach(sabor => {
                    sabores.push(sabor.value);
                    precoTotal += parseFloat(sabor.dataset.preco);
                });

                descricaoPizzas.push(
                    `${nomeTamanho}: ${sabores.join(', ')}`
                );
                });

                if (erro) {
                    e.preventDefault();
                    return;
                }

                // Preenche os hidden inputs
                inputPizzas.value = descricaoPizzas.join('; ');
                inputPreco.value = precoTotal.toFixed(2);

            });

            });
            </script>
            

    </body>
</html>
