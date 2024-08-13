@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table mt-5">
            <h5>Produto</h5>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Porcentagem de Comercialização</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $produto->id }}</th>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->porcentagemVenda }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <table class="table">
            <h5>Matérias-primas</h5>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Unidade de medida</th>
                    <th scope="col">Valor por unidade/porção</th>
                </tr>
            </thead>
            <tbody>
                @php $valorGeral = 0; @endphp
                @foreach ($produto->mps as $mps)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $mps->mp_original->nome }}</td>
                        <td>{{ $mps->quantidade }}</td>
                        <td>{{ $mps->mp_und->nome }}</td>
                        <td class="valorG">
                            @if ($mps->und_id == $mps->mp_original->und_id)
                                @php
                                    $valor =
                                        ($mps->mp_original->valor / $mps->mp_original->quantidade) * $mps->quantidade;
                                @endphp
                                {{ $valor }}
                            @endif
                            @if ($mps->und_id !== $mps->mp_original->und_id)
                                @if ($mps->mp_original->und_id == 2)
                                    @php
                                        $valor =
                                            ($mps->mp_original->valor / ($mps->mp_original->quantidade * 1000)) *
                                            $mps->quantidade;
                                    @endphp
                                    {{ $valor }}
                                @endif
                            @endif
                        </td>
                    </tr>
                    @php $valorGeral = $valorGeral + $valor; @endphp
                @endforeach
                <tr>
                    <th scope="row">Total:</th>
                    <td colspan="3"></td>
                    <td class="valorG">{{ $valorGeral }}</td>
                </tr>
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
    </script>
@endsection
