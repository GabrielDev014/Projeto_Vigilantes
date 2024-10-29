<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Estado;

class CidadeInativaController extends Controller
{
    public function index()
    {
        $cidades = Cidade::where("cidade_ativo", "0")->with('estado')->get();
        return view('ADM_cidades.inativos', compact('cidades'));
    }

    public function ativar($id)
    {
        $cidade = Cidade::find($id);

        $cidade->cidade_ativo = 1;
        $cidade->save();
       
        return redirect()->route('adm_cidades_inativas')
                            ->with('success', 'Estado e suas cidades ativados com sucesso.');
    }
}
