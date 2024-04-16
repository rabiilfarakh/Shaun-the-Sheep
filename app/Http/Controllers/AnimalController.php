<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Categorie;
use App\Models\Image;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if ($request->has('searchTerm')) {
        $searchTerm = $request->input('searchTerm');
        if ($searchTerm !== '') {
            $animaux = Animal::with(['image', 'categorie'])
                ->where(function ($query) use ($searchTerm) {
                    $query->where('lieu', 'like', '%'.$searchTerm.'%')
                        ->orWhereHas('categorie', function ($query) use ($searchTerm) {
                            $query->where('name', 'like', '%'.$searchTerm.'%');
                        });
                })
                ->paginate(6);
        } else {
            $animaux = Animal::with(['image', 'categorie'])->paginate(6);
        }
    } else {
        $animaux = Animal::with(['image', 'categorie'])->paginate(6);
    }

    return response()->json($animaux);
}

    
public function getAll()
{
    $animals = Animal::with(['image', 'categorie'])->paginate(4);
    return response()->json($animals);
}

public function getAnimal($id){
    $animal = Animal::with(['image', 'categorie'])->findOrFail($id);
    return response()->json($animal);
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
        $validatedData = $request->validated();
        

        $user_id = 1;
        //  Auth::id();
        $image=new Image();
        $animal = Animal::create([
            
            'lieu' => $validatedData['lieu'],
            'status' => $validatedData['status'] = (bool) $validatedData['status'],
            'categorie_id' => $validatedData['categorie_id'],
            'prix' => $validatedData['prix'],
        ]);
        if(isset($validatedData["image"])){
          
            $file = $validatedData["image"];
           $nameImage=$file->getClientOriginalName();
            $file->store('images', 'public');
            $image->url=$nameImage ;
        }
        $image->imageable()->associate($animal)->save();
        
        return response()->json(['message' => 'animal created successfully']);
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
    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
    
        $request->validate([
            'lieu' => 'required',
            'categorie_id' => 'required',
            'prix' => 'required',
            'status' => 'required|boolean',
        ]);
    
        $animal->update([
            'lieu' => $request->input('lieu'),
            'categorie_id' => $request->input('categorie_id'),
            'prix' => $request->input('prix'),
            'status' => $request->input('status'),
        ]);
    
        return response()->json(['message' => 'Animal mis à jour avec succès'], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();
        return response()->json(['message' => 'animal supprime avec succès']);
    }
    
}
