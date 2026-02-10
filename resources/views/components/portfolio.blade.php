@props(['sabores', 'tamanhos'])

<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Conheça melhor a Barths & Pizzas!</h2>
            <h3 class="section-subheading text-muted">Veja os sabores, tamanhos e cozinheiros que a nossa pizzaria possui!</h3>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- Portfolio item 1-->
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio/pizzas.jpg" alt="..."/>
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Opções</div>
                        <div class="portfolio-caption-subheading text-muted">Veja antes de fazer o seu pedido</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- Portfolio item 2-->
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio/entrega.jpeg" alt="..." />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Entrega</div>
                        <div class="portfolio-caption-subheading text-muted">Entregamos em qualquer lugar de Florianópolis</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- Portfolio item 3-->
                <div class="portfolio-item">
                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio/equipe.jpg" alt="..." />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">Equipe</div>
                        <div class="portfolio-caption-subheading text-muted">Conheça os nossos pizzaiolos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio Modals-->
<!-- Portfolio item 1 modal popup-->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 class="text-uppercase">Sabores e Tamanhos das nossas Pizzas</h2>
                            <p class="item-intro text-muted">Uma imensidão de sabores</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/pizzas.jpg" alt="..." />
                            <table class="table border-bottom">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Sabor</th>
                                        <th scope="col">Ingredientes</th>
                                        <th scope="col">Preço Adicional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sabores as $sabor)
                                    <tr>
                                        <td>{{ $sabor->nome }}</td>                                        
                                        <td style="width: 250px; word-wrap: break-word; font-size: 10px">{{ $sabor->ingredientes }}</td>
                                        <td>R$ {{ number_format($sabor->preco, 2, ',', '.') }}</td>
                                    </tr>
                                </tbody>   
                                @endforeach
                            </table>  
                            <table class="table py-4 my-4">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Tamanho</th>
                                        <th scope="col">Pedaços</th>
                                        <th scope="col">Sabores</th>
                                        <th scope="col">Preço</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tamanhos as $tamanho)
                                    <tr>
                                        <td>{{ $tamanho->nome }}</td>
                                        <td>{{ $tamanho->qpedacos }}</td>
                                        <td>{{ $tamanho->qsabores }}</td>
                                        <td>R$ {{ number_format($tamanho->preco, 2, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                                @endforeach

                            </table>
                            <button class="btn btn-primary btn-xl text-uppercase mt-4" data-bs-dismiss="modal" type="button">
                                <i class="fas fa-xmark me-1"></i>
                                Voltar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio item 2 modal popup-->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 class="text-uppercase">Sobre a Entrega</h2>
                            <p class="item-intro text-muted">Entregamos pizzas em toda ilha!</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/entrega.jpeg" alt="..." />
                            <p>Contamos com uma frota de X entregadores próprios, visando sobretudo entregar o seu pedido em boas condições.</p>
                            <ul class="list-inline">
                                <li>
                                    <strong>Pizzaria localizada em:</strong>
                                    Rua XXX, n° xxxx, Florianópolis - SC
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                <i class="fas fa-xmark me-1"></i>
                                Voltar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio item 3 modal popup-->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 class="text-uppercase">Equipe da Cozinha</h2>
                            <p class="item-intro text-muted">Nossa equipe de profissionais qualificados prepara as pizzas com carinho e dedicação.</p>
                            <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/equipe.jpg" alt="..." />
                            <p>A pizzaria foi originalmente fundada por um excelente pizzaiolo local, que trouxe sua paixão e expertise para criar uma experiência única em sabores autênticos. Com a expansão da marca, mantivemos o compromisso com a qualidade e o sabor tradicional. Esperamos que nossos clientes tenham uma experiência memorável em cada pizza que servimos. <br> Faça já o seu pedido!</p>

                            

                            <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                <i class="fas fa-xmark me-1"></i>
                                Voltar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>