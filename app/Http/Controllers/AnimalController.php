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
                ->paginate(3); // Paginer les résultats par groupe de 3
        } else {
            $animaux = Animal::with(['image', 'categorie'])->paginate(3);
        }
    } else {
        $animaux = Animal::with(['image', 'categorie'])->paginate(3);
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
        $validatedData = $request->validated();

        $user_id = 1;
        //  Auth::id();

        $animal = Animal::create([
            'user_id' => $user_id,
            'lieu' => $validatedData['lieu'],
            'status' => $validatedData['status'],
            'categorie_id' => $validatedData['categorie_id'],
            'prix' => $validatedData['prix'],
        ]);

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
