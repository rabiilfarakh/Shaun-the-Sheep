<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Animal;
use App\Models\Panier;
use Illuminate\Console\Command;

class CommandeController extends Controller
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
    public function store(StoreCommandeRequest $request)
    {

        // dd($request->arr_id);
        $validatedData = $request->validated();
        $arr = $validatedData[ 'arr_id' ];
        // dd($arr);

        foreach ($arr as $value) {
            $product = Commande::create(['panier_id' => $value]);

            $panier = Panier::find($value);
            $panier->update([ 'status' => 'false']); // Utilisez 0 pour false
        
            // $animal = Animal::find($panier->animal_id);
            // $animal->update([ 'status' => 0 ]); // Utilisez 0 pour false
        }
        return response()->json($product, 200);
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
