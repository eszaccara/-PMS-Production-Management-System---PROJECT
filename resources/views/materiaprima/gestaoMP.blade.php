@extends('layouts.app')

@section('content')
    <h4 class="my-0 fw-normal text-center mt-2 mb-5">GESTÃO DE MATÉRIA-PRIMA</h4>
    <div class="container mt-2">
        <form class="row g-3 needs-validation" method="" action="{{ route('gestao-materiaprima.create') }}" novalidate>
            @csrf
            <div class="col-md-4">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" placeholder="Nome do insumo" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Quantidade</label>
                <div class="input-group has-validation">
                    <input type="number" name="quantidade" class="form-control" placeholder="Ex: 1" required>
                    <select name="und_id" class="form-select" required>
                        <option selected disabled value="">Unidade de medida:</option>
                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Valor</label>
                <input type="text" name="valor" class="form-control" onkeyup="formatBRL(this)"
                    placeholder="Ex: R$ 1.720,90" required>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Cadastrar</button>
            </div>
        </form>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Unidade de medida</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Configuração</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insumos as $insumo)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $insumo->nome }}</td>
                        <td>{{ $insumo->quantidade }}</td>
                        <td>{{ $unidades[$insumo->und_id - 1]->nome }}</td>
                        <td class="valor">{{ $insumo->valor }}</td>
                        <td>
                            <div class="dropdown">
                                <form id="del_{{ $insumo->id }}" method="post"
                                    action="{{ route('gestao-materiaprima.destroy', ['gestao_materiaprima' => $insumo->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a style="color: black" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path
                                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Editar (Manutenção)</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                onclick="document.getElementById('del_{{ $insumo->id }}').submit()">Excluir</a>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
                <tr>
                    <th scope="row">Total</th>
                    <td colspan="3"></td>
                    <td class="valorTotal" colspan="1">
                        @if (isset($insumo))
                            {{ $insumos->sum('valor') }}
                        @else
                            0
                        @endif
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="p-3 pb-md-1 mt-5 mx-auto text-center">
        <p class="fs-5 text-body-secondary">Efetuado a catalogação da matéria-prima, em seguida, realize o cadastramento de
            produtos.</p>
    </div>
    <div class="d-flex justify-content-center">
        <div class="text-center ct-center">
            <div class="col">
                <div class="card rounded-3 shadow border-primary ">
                    <div class="card-header py-3 px-5 text-bg-primary border-primary">
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
                                class="w-100 btn btn-lg btn-primary">Simular</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/formValidateGMP.js"></script>
@endsection
