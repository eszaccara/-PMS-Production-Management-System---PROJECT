<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Unidade;
use App\Models\Materiaprima;



class GestaoMPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unidades = Unidade::all();
        $insumos = Materiaprima::where('user_id', Auth::id())->get();
        return view('materiaprima.gestaoMP', ['unidades' => $unidades, 'insumos' => $insumos, 'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $valorString = $request->input('valor');
        $valorFormatado = str_replace('.', ' ', $valorString);
        $valorFormatado = str_replace(',', '.', $valorFormatado);
        $valorFormatado = str_replace(['R$', ' '], '', $valorFormatado);
        $valorDecimal = floatval($valorFormatado);

        $request->merge([
            'user_id' => Auth::id(),
            'valor' => $valorDecimal,
        ]);
        $materiaprima = new Materiaprima();
        $materiaprima->create($request->all());

        return redirect()->route('gestao-materiaprima.index');
    }

    public function destroy($id)
    {
        Materiaprima::find($id)->delete();
        return redirect()->route('gestao-materiaprima.index');
    }
}
