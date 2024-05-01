<?php

namespace App\Http\Controllers;

use App\Models\panier_animal;
use App\Http\Requests\Storepanier_animalRequest;
use App\Http\Requests\Updatepanier_animalRequest;

class PanierAnimalController extends Controller
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
    public function store(Storepanier_animalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(panier_animal $panier_animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(panier_animal $panier_animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatepanier_animalRequest $request, panier_animal $panier_animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(panier_animal $panier_animal)
    {
        //
    }
}
