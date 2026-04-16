<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    // LISTAR TODOS OS PETS
    public function index()
    {
        $pets = Pet::all();
        return view('pets.index', compact('pets'));
    }

    // FORMULÁRIO DE CRIAÇÃO
    public function create()
    {
        return view('pets.create');
    }

    // SALVAR PET (COM UPLOAD)
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'tipo' => 'required',
            'idade' => 'required|integer',
            'descricao' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pets', 'public');
        }

        Pet::create([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'idade' => $request->idade,
            'descricao' => $request->descricao,
            'foto' => $path
        ]);

        return redirect()->route('pets.index')->with('success', 'Pet cadastrado com sucesso!');
    }

    // MOSTRAR UM PET (OPCIONAL)
    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    // FORMULÁRIO DE EDIÇÃO
    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }

    // ATUALIZAR PET
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'nome' => 'required',
            'tipo' => 'required',
            'idade' => 'required|integer',
            'descricao' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Atualizar imagem se enviada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pets', 'public');
            $pet->foto = $path;
        }

        $pet->update([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'idade' => $request->idade,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('pets.index')->with('success', 'Pet atualizado!');
    }

    // DELETAR PET
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pets.index')->with('success', 'Pet removido!');
    }
}