<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function blog()
    {
        return view('blog');
    }

    public function products()
    {
        return view('product');
    }

    public function home()
    {
        return view('home');
    }

    public function contact()
    {
        return  view('contact');    
    }

    public function panier()
    {
        return  view('panier');    
    }



    public function index(){
        // $animals = Animal::all();
        // return response()->json($animals);
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
        return response()->json($animal);
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
