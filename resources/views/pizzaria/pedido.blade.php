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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    </head>
    <body id="page-top">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">Barths & Pizzas</a>
        </div>
    </nav>
    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4 p-md-5">

                <h2 class="text-center fw-bold mb-3 text-dark">
                    Pedido confirmado 🍕
                </h2>

                <p class="text-center text-muted mb-4">
                    <strong>{{ $pedido->nome_cliente }}</strong>, seu pedido foi recebido com sucesso! Anote sua senha <strong>{{ $pedido->senha }}</strong> para acompanhar o status do pedido.
                </p>

                <h3 class="text-center fw-bold mb-3 text-dark">Status do Pedido: {{ $pedido->status }}</h3>

                <hr>

                <!-- RESUMO DO PEDIDO -->
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-2">📋 Resumo do Pedido</h5>

                    <div class="bg-light rounded p-3">
                        <p class="mb-2">
                            {{ $pedido->pedido }}
                        </p>

                        <h4 class="fw-bold text-success mb-0">
                            Total: R$ {{ number_format($pedido->preco, 2, ',', '.') }}
                        </h4>
                    </div>
                </div>

                @if ($pedido->status === 'Aguardando Pagamento')
                    <!-- PIX -->
                    <div class="text-center mt-4">
                        <h5 class="fw-bold mb-2">💳 Pagamento via PIX</h5>

                        <p class="text-muted">
                            Copie e cole o código pix abaixo para pagar
                        </p>

                        <label class="fw-bold mb-2">PIX Copia e Cola</label>

                        <textarea
                            class="form-control text-center"
                            rows="3"
                            readonly
                            onclick="this.select()"
                        >{{ $pedido->codigo_pix }}</textarea>

                        <small class="text-muted d-block mt-2">
                            Toque no código para copiar
                        </small>
                    </div>
                @endif


                <hr class="my-4">

                <!-- STATUS -->
                @if ($pedido->status === 'Aguardando Pagamento')
                    <div class="alert alert-warning text-center mb-0">
                        ⏳ Aguardando confirmação do pagamento
                    </div>
                @endif


                <form action="{{ route('pizzaria.index') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 mt-4" onclick="return confirm('Tem certeza que deseja voltar ao menu principal? Não esqueça da sua senha para consultar o pedido depois!')">
                            VOLTAR AO MENU PRINCIPAL
                    </button>
                </form>

                @if ($pedido->status === 'Aguardando Pagamento')
                    <!-- CANCELAR PEDIDO -->
                    <form action="{{ route('pizzaria.destroy', $pedido->senha) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="senha" value="{{ $pedido->senha }}">



                        <button type="submit" class="btn btn-danger w-100 mt-4" onclick="return confirm('Tem certeza que deseja cancelar este pedido?')">
                            CANCELAR PEDIDO
                        </button>
                    </form>
                @endif


            </div>
        </div>
    </div>

    <x-footer />

    <x-script />

    </body>
</html>