<?php

namespace App\Http\Controllers;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::where("estado_ativo", "1")->get();
        return view('ADM_estados.index', compact('estados'));
    }

    public function BuscarInclusao()
    {
        return view('ADM_estados.incluir');
    }

    public function ExecutaInclusao(Request $request)
    {
        $estado_nome  = $request->input("estado_nome");
        $sigla  = $request->input("sigla");
        
        $nova = new Estado;
        $nova->estado_nome = $estado_nome;
        $nova->sigla = $sigla;

        $nova->save();

        return redirect('/adm_estados');
    }

    public function ExcluirEstado($id)
    {
        $estado = Estado::where("id", $id)->first();

        $estado->estado_ativo = 0;
        $estado->save();

        $cidades = $estado->cidades;
        foreach ($cidades as $cidade) {
            $cidade->cidade_ativo = 0;
            $cidade->save();

            foreach ($cidade->endereco as $endereco) {
                $endereco->endereco_ativo = 0;
                $endereco->save();

                $cliente = $endereco->cliente;
                    $cliente->cliente_ativo = 0;
                    $cliente->save();
            }
        }

        return redirect('/adm_estados')->with('success', 'Estado e suas dependências desativados com sucesso.');
    }

    public function BuscarAlteracao($id)
    {
        $estado = Estado::where("id", $id)->first();
        return view('ADM_estados.alterar', compact('estado'));
    }

    public function ExecutaAlteracao(Request $request)
    {
        $dado_nome = $request->input("estado_nome");
        $dado_sigla = $request->input("sigla");
        $dado_id = $request->input("id");

        $estado = Estado::where("id", $dado_id)->first();
        $estado->estado_nome = $dado_nome;
        $estado->sigla = $dado_sigla;
        $estado->save();

        return redirect('/adm_estados');
    }

}
