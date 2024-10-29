<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\EnderecoCliente;
use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        $vigilanteId = Auth::id();

        $clientes = Cliente::with(['endereco'])
            ->where('cliente_ativo', 1) ->where('vigilante_id', $vigilanteId)
            ->get();
        
        // Obter todos os estados para o dropdown
        $estados = Estado::where('estado_ativo', 1)->get();

        return view('Vigilante_clientes.index', compact('clientes', 'estados'));
    }

    //Select dinâmico para cadastro de cidade
    public function buscarCidades($estado_id)
    {
        // Obter todas as cidades com base no estado selecionado
        $cidades = Cidade::where('estado_id', $estado_id)->where('cidade_ativo', 1)->get();

        return response()->json($cidades);
    }

    public function salvarCliente(Request $request) {

        $request->validate([
            'vigilante_id' => 'required|exists:users,id',
            'estado_id' => 'required|exists:estado,id',
            'cidade_id' => 'required|exists:cidade,id',
            'cliente_nome' => 'required|string|max:255',
            'cliente_celular' => 'required|string|max:15',
            'cliente_mensalidade' => 'required|numeric',
            'cliente_vencimento' => 'required|int',
            'rua' => 'required|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'numero_casa' => 'required|string|max:10',
        ]);
    
        $cliente = new Cliente();
        $cliente->cliente_nome = $request->cliente_nome;
        $cliente->cliente_celular = $request->cliente_celular;
        $cliente->cliente_mensalidade = $request->cliente_mensalidade;
        $cliente->cliente_vencimento = $request->cliente_vencimento;
        $cliente->vigilante_id = $request->vigilante_id;
        $cliente->save();
    
        $endereco = new EnderecoCliente();
        $endereco->rua = $request->rua;
        $endereco->bairro = $request->bairro;
        $endereco->numero_casa = $request->numero_casa;
        $endereco->cidade_id = $request->cidade_id;
        $endereco->estado_id = $request->estado_id;
        $endereco->cliente_id = $cliente->id;
        $endereco->save();
    
        return redirect()->route('clientes_index')->with('success', 'Cliente cadastrado com sucesso!');
    }
    
    public function formularioAlterar($id, $endereco_id)
    {
        $cliente = Cliente::find($id);
        $endereco = EnderecoCliente::find($endereco_id);

        //buscando para o select
        $estados = Estado::where('estado_ativo', '1')->get();

        $vigilanteId = Auth::id();

        return view('Vigilante_clientes.alterar', compact('cliente', 'endereco', 'estados'));
    }

    //Select dinâmico para alteração de cidade
    public function buscarCidadesAlteracao($estado_id)
    {
        $cidades = Cidade::where('estado_id', $estado_id)->where('cidade_ativo', 1)->get();
        return response()->json(['cidades' => $cidades]);
    }

    public function salvarAlteracaoCliente(Request $request)
    {

        $request->validate([
            'vigilante_id' => 'required|exists:users,id',
            'cliente_id' => 'required|exists:cliente,id',
            'endereco_id' => 'required|exists:endereco_cliente,id',
            'estado_id' => 'required|exists:estado,id',
            'cidade_id' => 'required|exists:cidade,id',
            'cliente_nome' => 'required|string|max:255',
            'cliente_celular' => 'required|string|max:15',
            'cliente_mensalidade' => 'required|numeric',
            'cliente_vencimento' => 'required|int',
            'rua' => 'required|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'numero_casa' => 'required|string|max:10',
        ]);

        $cliente = Cliente::find($request->cliente_id);
        $endereco = EnderecoCliente::find($request->endereco_id);

        $cliente->cliente_nome = $request->cliente_nome;
        $cliente->cliente_celular = $request->cliente_celular;
        $cliente->cliente_mensalidade = $request->cliente_mensalidade;
        $cliente->cliente_vencimento = $request->cliente_vencimento;
        $cliente->vigilante_id = $request->vigilante_id;
        $cliente->save();

        $endereco->rua = $request->rua;
        $endereco->bairro = $request->bairro;
        $endereco->numero_casa = $request->numero_casa;
        $endereco->cidade_id = $request->cidade_id;
        $endereco->estado_id = $request->estado_id; 
        $endereco->save();

        return redirect('/clientes')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function excluirCliente($id, $endereco_id)
    {
        $cliente = Cliente::where("id", $id)->first();
        $cliente->cliente_ativo = 0;
        $cliente->save();

        $endereco = EnderecoCliente::where("id", $endereco_id)->first();
        $endereco->endereco_ativo = 0;
        $endereco->save();

        return redirect('/clientes')->with('success', 'Cliente removido com sucesso!');
    }

}

