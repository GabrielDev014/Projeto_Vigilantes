<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class CobrancaController extends Controller
{
    public function index()
    {
        $vigilanteId = Auth::id();

        $clientes = Cliente::with(['endereco'])
            ->where('cliente_ativo', 1) ->where('vigilante_id', $vigilanteId)
            ->get();

        return view('Vigilante_cobrancas.index', compact('clientes'));
    }

   public function enviarCobranca(Request $request)
    {
        $request->validate([
            'cliente_vencimento' => 'required|integer|min:1|max:31',
        ]);

        $vigilanteId = Auth::id();
        $vigiaCelular = User::find($vigilanteId)->vigia_celular;
        $vencimentoDia = $request->input('cliente_vencimento');

        $clientes = Cliente::where('cliente_ativo', 1)
            ->where('vigilante_id', $vigilanteId)
            ->where('cliente_vencimento', $vencimentoDia)
            ->get();

        foreach ($clientes as $cliente) {
            $mensagem = "Olá {$cliente->cliente_nome}, lembramos que sua mensalidade vence no dia {$cliente->cliente_vencimento}! O valor é de {$cliente->cliente_mensalidade} reais. Para pagamento, você pode usar o PIX com o número {$vigiaCelular}.";

            Telegram::sendMessage(['chat_id' => $cliente->chat_id, 'text' => $mensagem]);
        }

        return redirect()->back()->with('success', 'Mensagens de cobrança enviadas com sucesso!');
    }
}
