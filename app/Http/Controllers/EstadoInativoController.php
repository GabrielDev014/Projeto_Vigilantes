<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Estado;

class EstadoInativoController extends Controller
{
    public function index()
    {
        $estados = Estado::where('estado_ativo', 0)->get();

        return view('ADM_estados.inativos', compact('estados'));
    }

    public function ativar($id)
    {
        $estado = Estado::find($id);

        $estado->estado_ativo = 1;
        $estado->save();
        
        foreach ($estado->cidades as $cidade) {
            $cidade->cidade_ativo = 1;
            $cidade->save();
        }

        return redirect()->route('adm_estados_inativos')
                            ->with('success', 'Estado e suas cidades ativados com sucesso.');
    }

}
