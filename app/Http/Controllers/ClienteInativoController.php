<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\EnderecoCliente;
use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Support\Facades\Auth;

class ClienteInativoController extends Controller
{
    public function index()
    {
        $vigilanteId = Auth::id();

        $clientes = Cliente::with(['endereco'])
            ->where('cliente_ativo', 0) ->where('vigilante_id', $vigilanteId) // Filtrar pelo vigilante logado
            ->get();

        return view('Vigilante_clientes.inativos', compact('clientes'));
    }

    public function ativar($id, $endereco_id)
    {
        $cliente = Cliente::where('id', $id)->first();
        $endereco = EnderecoCliente::where('id', $endereco_id)->where('cliente_id', $id)->first();

        $cliente->cliente_ativo = 1;
        $cliente->save();

        $endereco->endereco_ativo = 1;
        $endereco->save();

        return redirect()->route('clientes_ativar_index')->with('success', 'Cliente e endereço ativados com sucesso.');
    }

}
