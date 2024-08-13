<?php

namespace App\Http\Controllers;

use App\Models\Produto_materiasprimas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produto;
use App\Models\Unidade;
use App\Models\Materiaprima;

class GestaoProdutosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiasprimas = Materiaprima::where('user_id', Auth::id())->get();
        $unidades = Unidade::all();
        $produtos = Produto::where('user_id', Auth::id())->get();
        
        
        
        return view('produto.index', ['materiasprimas' => $materiasprimas, 'unidades' => $unidades, 'produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $produto = new Produto();
        $produto->user_id = Auth::id();
        $produto->nome = $request->input('nome');
        $produto->descricao = $request->input('descricao');
        $produto->porcentagemVenda = $request->input('porcentagemVenda');
        $produto->save();

        $materiasprimas = $request->input('materiasprimas', []);
        $quantidades = $request->input('quantidades', []);
        $und_ids = $request->input('und_id', []);

        $totalItens = count($materiasprimas);

        for ($i=0; $i < $totalItens; $i++) { 
            $produtoMateriaPrima = new Produto_materiasprimas();
            $produtoMateriaPrima->id_produto = $produto->id;
            $produtoMateriaPrima->id_materiaprima = $materiasprimas[$i];
            $produtoMateriaPrima->quantidade = $quantidades[$i];
            $produtoMateriaPrima->und_id = $und_ids[$i];
            $produtoMateriaPrima->save();
        }

        return redirect()->route('gestao-produtos.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $produto = Produto::find($id);

        return view('produto.show', ['id' => $id, 'produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Produto::find($id)->delete();
        return redirect()->route('gestao-produtos.index');
    }
}
