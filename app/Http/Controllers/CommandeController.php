<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Panier;
use App\Models\Commande;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCommandeRequest;

use App\Http\Requests\UpdateCommandeRequest;
use App\Models\panier_animal;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
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
        $validatedData = $request->validated();

        panier_animal::where('panier_id', $request->panier_id)->update(['status' => false]);
    
        // Créer la commande
        $product = Commande::create([
            'panier_id' => $request->panier_id,
            'client_id' => $request->client_id
        ]);
    
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
        $resultat = $commande->delete();
        return response()->json($resultat, 200);
    }
    public function getNotifPanier(StoreCommandeRequest $request){
        $validatedData = $request->validated();
        $arr = $validatedData['arr_id'];
        dd($arr);
        $notifs = Commande::whereIn('panier_id', $arr)->where('status', 1)->get();
        
        dd($notifs);
        
        return response()->json($notifs, 200);
    }

    public function getCommande(Request $request)
    {
        $resultats = DB::table('animals as a')
        ->join('paniers as p', 'p.animal_id', '=', 'a.id')
        ->join('commandes as c', 'c.panier_id', '=', 'p.id')
        ->join('images as i','i.imageable_id',"=","a.id")
        // ->join('categories as cat','cat.id','=','a.categorie_id')
        ->where('c.client_id', $request->client_id)
        ->select('a.prix','i.url','c.id')
        ->get();

        return response()->json($resultats, 200);
    }

    public function deleteStatus(Request $request)
    {
        dd($request);
        // $panier = Panier::findOrFail($id);

        // $panier->update(['status' => false]);

        // return response()->json(['message' => 'Statut du panier mis à jour avec succès'], 200);
    }
    
}
