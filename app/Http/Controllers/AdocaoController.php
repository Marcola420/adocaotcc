<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adocao;

class AdocaoController extends Controller
{
    // FORMULÁRIO
    public function create($id)
    {
        return view('adocao.create', ['pet_id' => $id]);
    }

    // SALVAR ADOÇÃO
    public function store(Request $request)
    {
        $request->validate([
            'telefone' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'estado' => 'required'
        ]);

        Adocao::create([
            'user_id' => auth()->id(),
            'pet_id' => $request->pet_id,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'status' => 'pendente'
        ]);

        return redirect('/')->with('success', 'Solicitação enviada!');
    }
}