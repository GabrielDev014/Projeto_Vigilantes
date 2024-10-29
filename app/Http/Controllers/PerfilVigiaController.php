<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PerfilVigiaController extends Controller
{
    public function index()
    {
        $vigilante = Auth::user();
        return view('Vigilante_perfil.index', compact('vigilante'));
    }

    public function salvarAlteracao(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vigia_celular' => 'required|string|max:15',
            'password' => 'nullable|min:8|confirmed'
        ]);

        $vigilante = Auth::user();
        $vigilante->name = $request->input('name');
        $vigilante->vigia_celular = $request->input('vigia_celular');

        if ($request->filled('password')) {
            $vigilante->password = Hash::make($request->input('password'));
        }

        $vigilante->save();

        return redirect()->route('vigilante_perfil')->with('success', 'Perfil atualizado com sucesso.');
    }
}
