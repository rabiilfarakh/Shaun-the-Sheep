<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\client;
use App\Http\Requests\StoreclientRequest;
use App\Http\Requests\UpdateclientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = DB::table('clients')
                    ->join('users', 'clients.user_id', '=', 'users.id')
                    ->select('clients.id','clients.user_id','users.name', 'users.email', 'clients.status')
                    ->get();

        return response()->json($clients);
    }

    public function getAll()
    {
        $clients = client::all();
        return response()->json($clients);
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
    public function store(StoreclientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'status' => 'required|boolean',
        ]);

        $client->update(['status' => $request->input('status')]);

        return response()->json(['message' =>"updated", $request->input('status')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
