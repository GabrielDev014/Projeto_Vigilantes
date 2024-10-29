<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;

class AdminClienteController extends Controller
{
    public function index()
    {
        // Carregar vigilantes com apenas clientes ativos
        $vigilantes = User::where('vigia_ativo', 1)
            ->with(['clientes' => function ($query) {
                $query->where('cliente_ativo', 1);
            }])
            ->get();

        return view('adm_clientes.index', compact('vigilantes'));
    }

    public function formularioAlterar($id)
    {
        $cliente = Cliente::find($id);
        return view('adm_clientes.alterar', compact('cliente'));
    }

    public function salvarAlterar(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|string|max:40', 
        ]);

        $cliente = Cliente::find($request->cliente_id);
        $cliente->chat_id = $request->input('chat_id');
        $cliente->save();

        return redirect()->route('adm_clientes_index')->with('success', 'Chat ID atualizado com sucesso.');
    }
}
