<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Adocao;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $pets = Pet::count();
        $adocoes = Adocao::count();
        $pendentes = Adocao::where('status', 'pendente')->count();

        // 🔥 IMPORTANTE: evitando loop pesado
        $lista = Adocao::with([
            'user:id,name,email',
            'pet:id,nome'
        ])->latest()->get();

        return view('admin.dashboard', compact('pets', 'adocoes', 'pendentes', 'lista'));
    }

    // APROVAR
    public function aprovar($id)
    {
        $adocao = Adocao::findOrFail($id);
        $adocao->update(['status' => 'aprovado']);

        return redirect()->back()->with('success', 'Adoção aprovada!');
    }

    // RECUSAR
    public function recusar($id)
    {
        $adocao = Adocao::findOrFail($id);
        $adocao->update(['status' => 'recusado']);

        return redirect()->back()->with('success', 'Adoção recusada!');
    }
}