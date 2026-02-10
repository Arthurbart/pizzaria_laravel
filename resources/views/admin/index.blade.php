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
        <div class="container">
            <a class="navbar-brand" href="#page-top">Barths & Pizzas</a>
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
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf

                    <label>Senha de Administrador</label>
                    <input type="password" name="senha" class="form-control" placeholder="Digite a senha" required>

                    <button type="submit" class="btn btn-primary mt-3">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <x-footer />

    <x-script />

    </body>
</html>