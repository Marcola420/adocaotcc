<?php

use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::all();
        return view('adoptions.index', compact('adoptions'));
    }

    public function create()
    {
        return view('adoptions.create');
    }

    public function store(Request $request)
    {
        Adoption::create([
            'user_id' => Auth::id(),
            'pet_name' => $request->pet_name,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return redirect('/adoptions')->with('success', 'Solicitação enviada!');
    }
}