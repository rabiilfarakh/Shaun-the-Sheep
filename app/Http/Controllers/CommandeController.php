<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Panier;
use App\Models\Commande;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCommandeRequest;

use App\Http\Requests\UpdateCommandeRequest;
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
        // dd($request->client_id);
        $validatedData = $request->validated();
        $arr = $validatedData[ 'arr_id' ];

        foreach ($arr as $value) {
            $product = Commande::create(['panier_id' => $value,'client_id' => $request->client_id]);
            $panier = Panier::find($value);
            $panier->update([ 'status' => false]);
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
        ->where('c.client_id', $request->client_id)
        ->select('a.*')
        ->get();

        return response()->json($resultats, 200);
    }
    
}
