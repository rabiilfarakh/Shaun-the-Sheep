<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Panier;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePanierRequest;
use App\Http\Requests\UpdatePanierRequest;
use App\Models\panier_animal;

class PanierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePanierRequest $request)
    {
        $validatedData = $request->validated();
    
        // Vérifie si un panier existe pour le client donné
        $panier = Panier::where('client_id', $validatedData['client_id'])->first();
    
        if ($panier) {
            // Ajoute l'animal au panier existant
            $panier->animals()->attach($validatedData['animal_id']);
            return response()->json(["message" => "Animal added to existing panier successfully"], 200);
        }
    
        // Crée un nouveau panier avec l'animal donné
        $panier = Panier::create([
            'client_id' => $validatedData['client_id']
        ]);
        $panier->animals()->attach($validatedData['animal_id']);
    
        return response()->json(["message" => "Panier created successfully"], 200);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Panier $panier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panier $panier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePanierRequest $request, Panier $panier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyA(Request $request)
    {
        // dd($request);
        panier_animal::where('animal_id', $request->idAnimal)->delete();
        // $request->delete();
        return response()->json(['message' => 'product supprime avec succès']);
    }

    public function getProductClient(Request $request)
    {
    $animauxDansPaniers = DB::table('animals as a')
        ->join('panier_animal as pn', 'a.id', '=', 'pn.animal_id')
        ->join('paniers as p', 'p.id', '=', 'pn.panier_id')
        ->join('categories as c', 'c.id', '=', 'a.categorie_id')
        ->join('images as i', 'i.imageable_id', '=', 'a.id')
        ->where('p.client_id', $request->id)
        ->where('pn.status',true)
        ->select('pn.*', 'c.name', 'a.lieu', 'a.prix', 'i.url')
        ->get();

        return response()->json($animauxDansPaniers);
    }

    public function panier_exist(Request $request)
    {
        if (Panier::where("client_id", $request->client_id)
            ->where("animal_id", $request->animal_id)
            ->where("status", true)
            ->exists()
        ) {
            return 1;
        }
        return 0;
    }
}
