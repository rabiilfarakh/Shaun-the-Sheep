<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Vérifier si un terme de recherche est fourni dans la requête
        if ($request->has('searchTerm')) {
            $searchTerm = $request->input('searchTerm');
            // Vérifier si le terme de recherche n'est pas vide
            if ($searchTerm !== '') {
                // Filtrer les animaux en fonction du terme de recherche
                $animaux = Animal::with(['image', 'categorie'])
                ->where(function ($query) use ($searchTerm) {
                    $query->where('lieu', 'like', '%'.$searchTerm.'%')
                        ->orWhereHas('categorie', function ($query) use ($searchTerm) {
                            $query->where('name', 'like', '%'.$searchTerm.'%');
                        });
                })
                ->get();
            
            } else {
                // Si le terme de recherche est vide, récupérer tous les animaux
                $animaux = Animal::with(['image', 'categorie'])->get();
            }
        } else {
            // Si aucun terme de recherche n'est fourni, récupérer tous les animaux
            $animaux = Animal::with(['image', 'categorie'])->get();
        }
    
        return response()->json($animaux);
    }
    

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
