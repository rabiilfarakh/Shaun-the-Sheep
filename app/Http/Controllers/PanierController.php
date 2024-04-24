<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Panier;
use Illuminate\Http\Request;
use App\Http\Requests\StorePanierRequest;
use App\Http\Requests\UpdatePanierRequest;
use App\Models\Categorie;

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
        //
    }

    public function getProductClient(Request $request){
        $animauxDansPaniers = Animal::whereIn('id', function($query) use ($request) {
            $query->select('animal_id')->from('paniers')->where('client_id', $request->id);
        })->with('image','Categorie')->get();

        return response()->json($animauxDansPaniers);
    }
    
    
    
}
