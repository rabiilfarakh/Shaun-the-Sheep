<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Panier;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePanierRequest;
use App\Http\Requests\UpdatePanierRequest;

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
        $product = Panier::create($validatedData);
        
        
        return response()->json($product, 200);
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
    public function destroy(Panier $panier)
    {
        $panier->delete();
        return response()->json(['message' => 'product supprime avec succès']);
    }

    public function getProductClient(Request $request)
    {
        $animauxDansPaniers = DB::table('paniers as p')
            ->join('animals as a', 'a.id', '=', 'p.animal_id')
            ->join('categories as c', 'c.id', '=', 'a.categorie_id')
            ->join('images as i', 'i.imageable_id', '=', 'a.id')
            ->select('p.*', 'c.name', 'a.lieu','a.prix','i.url')
            ->where('p.client_id', $request->id)
            ->get();
    
        return response()->json($animauxDansPaniers);
    }

    public function panier_exist(Request $request){
        
        if (Panier::where("client_id", $request->client_id)->where("animal_id", $request->animal_id)->exists()) {    
            return 1;
        }
        return 0;
    }

}
