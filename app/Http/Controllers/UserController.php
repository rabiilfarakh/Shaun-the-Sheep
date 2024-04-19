<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Admin;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        return response()->json(['user'=>$user]);
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
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {   
        //
    }

    public function register(Request $request)
{
    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'role' => 'required|in:admin,client'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    if ($request->role === "admin") {
        $admin = Admin::create([
            'user_id' => $user->id,
        ]);
    }else{
        $client = Client::create([
            'user_id' => $user->id,
        ]);
    }

    return response()->json(['message' => 'User registered successfully',$request->all()]);
}

    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:8' 
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if($user){

            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('authToken')->plainTextToken;
                return response()->json([
                    'message' => 'Connected Successfully',
                    'token' => $token,'user'=>$user
                ]);
            }else{
                return response()->json([
                    'message' => 'Invalid Credentials',"val"=>$request->all()
                ], 401);
            }
    
        }else{
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logout successfully'
        ]);
    }
    
}
