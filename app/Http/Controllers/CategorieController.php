<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Repositories\Interfaces\CategoriesRepositoryInterface;

class CategorieController extends Controller
{
    public function __construct(public CategoriesRepositoryInterface  $repository) {}

    // index method
    public function index()
    {
        $categories = $this->repository->index();
        return response()->json($categories);
    }

    // store method
    public function store(StoreCategorieRequest $request)
    {
        $categories = $this->repository->store($request->all());
        return response()->json($categories);
    }

    // update method
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $categories = $this->repository->update($request->all(), $categorie->id);
        return response()->json($categories);
    }

    // destroy method
    public function destroy(Categorie $categorie)
    {
        $categories = $this->repository->destroy($categorie->id);
        return response()->json($categories);
    }

}
