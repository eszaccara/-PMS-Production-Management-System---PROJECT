@extends('layouts.app')

@section('content')
    <h4 class="my-0 fw-normal text-center mt-2 mb-5">GESTÃO DE PRODUÇÃO</h4>
    <div class="container mt-2">
        <form class="row g-3 needs-validation" method="" action="{{ route('gestao-produtos.create') }}" validate>
            @csrf
            <div class="col-md-4">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" placeholder="Nome do produto" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Descrição</label>
                <input type="text" name="descricao" class="form-control" placeholder="Descrição do produto" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Porcentagem de Faturamento</label>
                <input type="number" name="porcentagemVenda" class="form-control" placeholder="Ex: %110" required>
            </div>
            <fieldset class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Matéria-prima</label>
                    <select name="materiasprimas[]" class="form-select" required>
                        <option selected disabled value="">Selecione uma matéria-prima</option>
                        @foreach ($materiasprimas as $materiaprima)
                            <option value="{{ $materiaprima->id }}">{{ $materiaprima->nome }} ||
                                {{ $materiaprima->unidades->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Quantidade</label>
                    <div class="input-group has-validation">
                        <input type="number" name="quantidades[]" class="form-control" placeholder="Ex: 1" required>
                        <select name="und_id[]" class="form-select" required>
                            <option selected disabled value="">Unidade de medida:</option>
                            @foreach ($unidades as $unidade)
                                <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">+ Matéria-prima</label>
                    <div class="input-group has-validation">
                        <a class="btn btn-secondary" onclick="addMP()">Adicionar</a>
                    </div>
                </div>
                <div id="addMP">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Cadastrar</button>
                </div>
            </fieldset>
        </form>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor de Produção</th>
                    <th scope="col">Valor de Comercialização</th>
                    <th scope="col">+</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $produto->nome }}</td>
                        <td class="valorG">@php $valorGeral = 0; @endphp
                            @foreach ($produto->mps as $mps)
                                @if ($mps->und_id == $mps->mp_original->und_id)
                                    @php
                                        $valor =
                                            ($mps->mp_original->valor / $mps->mp_original->quantidade) *
                                            $mps->quantidade;
                                    @endphp
                                @endif
                                @if ($mps->und_id !== $mps->mp_original->und_id)
                                    @if ($mps->mp_original->und_id == 2)
                                        @php
                                            $valor =
                                                ($mps->mp_original->valor / ($mps->mp_original->quantidade * 1000)) *
                                                $mps->quantidade;
                                        @endphp
                                    @endif
                                @endif
                                @php $valorGeral = $valorGeral + $valor; @endphp
                            @endforeach
                            {{ $valorGeral }}
                        </td>
                        <td class="valorG">
                            @php
                                $valorPorcentagem = $produto->porcentagemVenda / 100;
                                $taxa = $valorGeral * $valorPorcentagem;
                                $valorComercio = $valorGeral + $taxa;
                            @endphp
                            {{ $valorComercio }}</td>
                        <td>
                            <div class="dropdown">
                                <a style="color: black" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                        <path
                                            d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Editar (Manutenção)</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('gestao-produtos.show', $produto->id) }}">Visualizar</a>
                                    </li>
                                    <form id="del_{{ $produto->id }}" method="post"
                                        action="{{ route('gestao-produtos.destroy', ['gestao_produto' => $produto->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <li><a class="dropdown-item" href="#"
                                                onclick="document.getElementById('del_{{ $produto->id }}').submit()">Excluir</a>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="../public/js/formValidateMP.js"></script>
    <script>
        tdValores = document.querySelectorAll('.valorG');
        tdValores.forEach(valor => {
            valorNumerico = parseFloat(valor.textContent);
            valorFormatado = valorNumerico.toLocaleString('pt-br', {
                style: 'currency',
                currency: 'BRL'
            });
            valor.textContent = valorFormatado;
        });

        let ct = 1;

        function delMP(button) {
            // Captura o elemento pai do botão clicado (o campo de matéria-prima que queremos remover)
            let fieldset = button.closest('fieldset');

            // Remove o elemento do DOM
            if (fieldset) {
                fieldset.remove();
            }
        }

        function addMP() {
            ct++;
            let container = document.getElementById('addMP');
            let html = `
        <fieldset class="row g-3 mt-1">
            <div class="col-md-4">
                <select name="materiasprimas[]" class="form-select" required>
                    <option selected disabled value="">Selecione uma matéria-prima</option>
                    @foreach ($materiasprimas as $materiaprima)
                    <option value="{{ $materiaprima->id }}">{{ $materiaprima->nome }} || {{ $materiaprima->unidades->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-group has-validation">
                    <input type="number" name="quantidades[]" class="form-control" placeholder="Ex: 1" required>
                    <select name="und_id[]" class="form-select" required>
                        <option selected disabled value="">Unidade de medida:</option>
                        @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-12">
                    <a onclick="delMP(this)" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg></a>
                </div>
            </div>
    </fieldset>
    `;
            container.innerHTML += html;
        }
    </script>
@endsection
