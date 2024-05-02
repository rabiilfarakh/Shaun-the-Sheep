<?php

namespace App\Http\Controllers;
use App\Models\Image;
use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with(['image'])->get();
        return response()->json($blogs);
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
    public function store(StoreBlogRequest $request)
    {
        $validatedData = $request->validated();
        
        // Crée le blog
        $blog = Blog::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);

        // Vérifie s'il y a une image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();

            // Enregistre l'image dans le dossier public/images
            $file->storeAs('images', $name, 'public');

            // Crée une entrée dans la table images pour lier l'image au blog
            $image = new Image();
            $image->url = $name;
            $image->imageable_id = $blog->id;
            $image->imageable_type = Blog::class;
            $image->save();
        }

        return response()->json(['message' => 'Blog créé avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $comments = $blog->comment()->with('client.user')->get();
        $blog->load('image');
        
        return response()->json([
            'blog' => $blog,
            'comments' => $comments
        ]);
    }
    
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
    
        return response()->json(['message' => 'Blog mis à jour avec succès'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $resultat = $blog->delete();
        return response()->json($resultat, 200);
    }
}
