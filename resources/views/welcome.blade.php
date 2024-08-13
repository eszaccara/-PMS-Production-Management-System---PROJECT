@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
                                        @auth
                                                                        <a href="{{ url('/home') }}"
                                                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                                            Dashboard
                                                                        </a>
    @else
        <a href="{{ route('login') }}"
                                                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                                            Log in
                                                                        </a>
                                                            
                                                                        @if (Route::has('register'))
        <a href="{{ route('register') }}"
                                                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                                                Register
                                                                            </a>
        @endif
                                        @endauth
                                    </nav>
    @endif -->
    </div>

    <div class="container">
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal text-body-emphasis">SGDC+</h1>
            <p class="fs-5 text-body-secondary">Sistema de gerenciamento de despesas e comercialização.<br><br>O SGDC+
                (Sistema de Gerenciamento de Despesas e Comercialização) é uma ferramenta essencial para auxiliar na
                organização e controle de despesas e na gestão de processos comerciais. Este sistema oferece uma variedade
                de funcionalidades que podem beneficiar significativamente sua rotina e seu negócio.</p>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">GESTÃO DE MATÉRIA PRIMA</h4>
                    </div>
                    <div class="card-body">
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Cadastramento de material</li>
                            <li>Análise de custo por:</li>
                            <li>Unidade, Quilo, Grama, Litro, [...]</li>
                            <li>Entre outros...</li>
                        </ul>
                        <a href="{{ route('gestao-materiaprima.index') }}"
                            class="w-100 btn btn-lg btn-outline-primary">Começar</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">CUSTOS DE PRODUÇÃO</h4>
                    </div>
                    <div class="card-body">
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Cadastramento de produto</li>
                            <li>Calculo de comercialização</li>
                            <li>Análise de custo por unidade</li>
                            <li>Entre outros...</li>
                        </ul>
                        <a href="{{ route('gestao-produtos.index') }}"><button type="button"
                                class="w-100 btn btn-lg btn-outline-primary">Começar</button></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-bg-primary border-primary">
                        <h4 class="my-0 fw-normal">SIMULAR FATURAMENTO</h4>
                    </div>
                    <div class="card-body">
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Simulação de faturamento</li>
                            <li>Análise de lucro</li>
                            <li>Avaliação de despesa dedutível</li>
                            <li>Entre outros...</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-primary">Simular</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
