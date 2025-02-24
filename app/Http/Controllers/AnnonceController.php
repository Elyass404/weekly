<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Category;


class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces = Annonce::paginate(10);
        return view('annonces.index', compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('annonces.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();
        $data['status'] = 'pending'; 
        $data['user_id'] = Auth::id(); 

        Annonce::create($data);
        return redirect()->route('annonces.index')->with('success', 'Annonce created successfully.');
    }

        
    

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        $annonce->load('category');
        return view('annonces.show', compact('annonce'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('annonces.edit', compact('annonce'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'nullable|numeric',
            'image' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'status' => 'required|in:actif,brouillon,archive',
        ]);

        $annonce->update($request->all());
        return redirect()->route('annonces.index')->with('success', 'Annonce updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        $annonce->delete(); // Soft delete
        return redirect()->route('annonces.index')->with('success', 'Annonce deleted successfully.');
    }
}
