<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barths & Pizzas - ADM</title>
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
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="#page-top">Barths & Pizzas</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light">
                    Sair
                </button>
            </form>
        </div>
    </nav>
    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4 p-md-5">
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <h2 class="text-center fw-bold mb-3 text-dark">
                    Área Administrativa
                </h2>

                <p class="text-center text-muted mb-4">
                    Bem-vindo à área administrativa. Aqui você pode gerenciar os pedidos e outras configurações do sistema.
                </p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('erro') }}
                    </div>
                @endif

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active"id="home-tab"data-bs-toggle="tab"data-bs-target="#pedidos"type="button"role="tab">Pedidos</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link"id="profile-tab"data-bs-toggle="tab"data-bs-target="#tamanhos"type="button"role="tab">Tamanhos
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link"id="contact-tab"data-bs-toggle="tab"data-bs-target="#sabores"type="button"role="tab">Sabores
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pedidos" role="tabpanel" aria-labelledby="pedidos-tab">                
                        @if ($pedidos->isNotEmpty())
                            @foreach ($pedidos as $pedido)
                                <hr>
                                <div class="card">
                                    <div class="card-header">
                                        Cliente: {{ $pedido->nome_cliente }} - Whatsapp: {{ $pedido->fone_cliente }} - Horário do Pedido: {{ $pedido->horario }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pedido->status }}</h5>
                                        <p class="card-text">{{ $pedido->pedido }}</p>
                                        <p class="card-text">R$ {{ number_format($pedido->preco, 2, ',', '.') }}</p>
                                        <p class="card-text">{{ $pedido->locEntrega }}</p>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPedidoAtualizar"
                                            data-id="{{ $pedido->id }}"
                                            data-status="{{ $pedido->status }}">
                                            Mudar Status
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <hr>
                            <p class="text-center text-muted">Nenhum pedido encontrado.</p>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="tamanhos" role="tabpanel" aria-labelledby="tamanhos-tab"> 
                        <div class="row d-flex justify-content-center pt-4 mt-4 pb-4 mb-4">
                            <div class="col-4 d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTamanho">
                                    Adicionar Novo Tamanho
                                </button>
                            </div>
                        </div>
                        <div class="container">
                            <table class="table py-4 my-4">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Tamanho</th>
                                        <th scope="col">Pedaços</th>
                                        <th scope="col">Sabores</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tamanhos as $tamanho)
                                        <input type="hidden" name="id" value="{{ $tamanho->id }}">
                                        <tr>
                                            <td>{{ $tamanho->nome }}</td>
                                            <td>{{ $tamanho->qpedacos }}</td>
                                            <td>{{ $tamanho->qsabores }}</td>
                                            <td>{{ $tamanho->status }}</td>
                                            <td>R$ {{ number_format($tamanho->preco, 2, ',', '.') }}</td>
                                            <td class="d-flex gap-1">
                                                <!-- EDITAR -->
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalTamanhoAtualizar"
                                                    data-id="{{ $tamanho->id }}"
                                                    data-nome="{{ $tamanho->nome }}"
                                                    data-qpedacos="{{ $tamanho->qpedacos }}"
                                                    data-qsabores="{{ $tamanho->qsabores }}"
                                                    data-status="{{ $tamanho->status }}"
                                                    data-preco="{{ $tamanho->preco }}">
                                                    Editar
                                                </button>

                                                <!-- DELETAR -->
                                                <form action="{{ route('admin.destroyTamanhos', $tamanho->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Deseja realmente excluir este tamanho?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        Deletar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="sabores" role="tabpanel" aria-labelledby="sabores-tab">
                        <div class="container">
                            <div class="row d-flex justify-content-center pt-4 mt-4 pb-4 mb-4">
                                <div class="col-4 d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSabor">
                                        Adicionar Novo Sabor
                                    </button>
                                </div>
                            </div>
                            <table class="table border-bottom">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Sabor</th>
                                        <th scope="col">Ingredientes</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Preço Adicional</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sabores as $sabor)
                                        <input type="hidden" name="id" value="{{ $sabor->id }}">
                                        <tr>
                                            <td>{{ $sabor->nome }}</td>                                        
                                            <td>{{ $sabor->ingredientes }}</td>
                                            <td>{{ $sabor->status }}</td>
                                            <td>R$ {{ number_format($sabor->preco, 2, ',', '.') }}</td>
                                            <td class="d-flex gap-1">
                                                <!-- EDITAR -->
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalSaborAtualizar"
                                                    data-id="{{ $sabor->id }}"
                                                    data-nome="{{ $sabor->nome }}"
                                                    data-ingredientes="{{ $sabor->ingredientes }}"
                                                    data-classificacao="{{ $sabor->classificacao }}"
                                                    data-status="{{ $sabor->status }}"
                                                    data-preco="{{ $sabor->preco }}">
                                                    Editar
                                                </button>

                                                <!-- DELETAR -->
                                                <form action="{{ route('admin.destroySabores', $sabor->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Deseja realmente excluir este sabor?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        Deletar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach    
                                </tbody>   
                            </table> 
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal sabor -->
    <div class="modal fade" id="modalSabor" tabindex="-1" aria-labelledby="Modal Sabor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicione um Novo Sabor ao Cardápio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeSabores') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Sabor</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="ingredientes" class="form-label">Ingredientes</label>
                            <input type="text" class="form-control" id="ingredientes" name="ingredientes" placeholder="Ingredientes" required>
                        </div>
                        <div class="mb-3">
                            <label for="classificacao" class="form-label">Classificação</label>
                            <select class="form-select" id="classificacao" name="classificacao" required>
                                <option value="" disabled selected>Selecione a Classificação</option>
                                <option value="Salgado">Salgado</option>
                                <option value="Doce">Doce</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço Adicional (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="Preço" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal tamanho -->
    <div class="modal fade" id="modalTamanho" tabindex="-1" aria-labelledby="Modal Tamanho" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicione um Novo Tamanho ao Cardápio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeTamanhos') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Tamanho</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="qpedacos" class="form-label">Quantidade de Pedaços</label>
                            <input type="number" class="form-control" id="qpedacos" name="qpedacos" placeholder="Quantidade de Pedaços" required>
                        </div>
                        <div class="mb-3">
                            <label for="qsabores" class="form-label">Quantidade de Sabores</label>
                            <input type="number" class="form-control" id="qsabores" name="qsabores" placeholder="Quantidade de Sabores" required>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="Preço" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal atualizar sabor -->
    <div class="modal fade" id="modalSaborAtualizar" tabindex="-1" aria-labelledby="Modal Atualizar Sabor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atualize um Sabor do Cardápio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formAtualizarSabor" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="modal_sabor_id" name="id">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Sabor</label>
                            <input type="text" class="form-control" id="modal_nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="ingredientes" class="form-label">Ingredientes</label>
                            <input type="text" class="form-control" id="modal_ingredientes" name="ingredientes" required>
                        </div>
                        <div class="mb-3">
                            <label for="classificacao" class="form-label">Classificação</label>
                            <select class="form-select" id="modal_classificacao" name="classificacao">
                                <option value="Salgado">Salgado</option>
                                <option value="Doce">Doce</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="modal_status" name="status">
                                <option value="Disponível">Disponível</option>
                                <option value="Indisponível">Indisponível</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço Adicional (R$)</label>
                            <input type="number" step="0.01" class="form-control" id="modal_preco" name="preco" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal atualizar tamanho -->
    <div class="modal fade" id="modalTamanhoAtualizar" tabindex="-1" aria-labelledby="Modal Atualizar Tamanho" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atualize um Tamanho do Cardápio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formAtualizarTamanho" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="modal_tamanho_id" name="id">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Tamanho</label>
                            <input type="text" id="modal_nome_tamanho" name="nome" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="qpedacos" class="form-label">Quantidade de Pedaços</label>
                            <input type="number" id="modal_qpedacos" name="qpedacos" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="qsabores" class="form-label">Quantidade de Sabores</label>
                            <input type="number" id="modal_qsabores" name="qsabores" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="modal_status_tamanho" name="status">
                                <option value="Disponível">Disponível</option>
                                <option value="Indisponível">Indisponível</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço (R$)</label>
                            <input type="number" id="modal_preco_tamanho" name="preco" required class="form-control" type="number">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Atualizar Pedido -->
    <div class="modal fade" id="modalPedidoAtualizar" tabindex="-1" aria-labelledby="Modal Pedido" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mudar Status do Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formAtualizarPedido" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="modal_pedido_id" name="id">
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Selecione o Status</option>
                                <option value="Aguardando Pagamento">Aguardando Pagamento</option>
                                <option value="Preparando Pedido">Preparando Pedido</option>
                                <option value="Saiu para Entrega">Saiu para Entrega</option>
                                <option value="Finalizado">Finalizado</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <x-footer />

    <x-script />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('modalSaborAtualizar');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');
                const nome = button.getAttribute('data-nome');
                const ingredientes = button.getAttribute('data-ingredientes');
                const classificacao = button.getAttribute('data-classificacao');
                const preco = button.getAttribute('data-preco');

                const form = document.getElementById('formAtualizarSabor');
                form.action = `/admin/sabores/${id}`;

                document.getElementById('modal_sabor_id').value = button.dataset.id;
                document.getElementById('modal_nome').value = nome;
                document.getElementById('modal_ingredientes').value = ingredientes;
                document.getElementById('modal_classificacao').value = classificacao;
                document.getElementById('modal_status').value = button.dataset.status;
                document.getElementById('modal_preco').value = preco;
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('modalTamanhoAtualizar');

        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');
            const nome = button.getAttribute('data-nome');
            const qpedacos = button.getAttribute('data-qpedacos');
            const qsabores = button.getAttribute('data-qsabores');
            const preco = button.getAttribute('data-preco');

            const form = document.getElementById('formAtualizarTamanho');
            form.action = `/admin/tamanhos/${id}`;

            document.getElementById('modal_tamanho_id').value = button.dataset.id;
            document.getElementById('modal_nome_tamanho').value = nome;
            document.getElementById('modal_qpedacos').value = qpedacos;
            document.getElementById('modal_qsabores').value = qsabores;
            document.getElementById('modal_status_tamanho').value = button.dataset.status;
            document.getElementById('modal_preco_tamanho').value = preco;
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('modalPedidoAtualizar');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.dataset.id;
                const status = button.dataset.status;

                const form = document.getElementById('formAtualizarPedido');
                form.action = `/admin/pedidos/${id}`;

                document.getElementById('modal_pedido_id').value = id;
                document.getElementById('status').value = status;
            });
        });

    </script>


    </body>
</html>