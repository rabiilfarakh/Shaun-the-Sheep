<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Repositories\Interfaces\CategoriesRepositoryInterface;
use App\Services\Interfaces\CategoriesServiceInterface;

class CategorieController extends Controller
{
    public function __construct (public  CategoriesServiceInterface $service) {}

    // index method
    public function index()
    {
        $categories = $this->service->index();
        return response()->json($categories);
    }

    // store method
    public function store(StoreCategorieRequest $request)
    {
        $categories = $this->service->store($request->all());
        return response()->json($categories);
    }

    // update method
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $categories = $this->service->update($request->all(), $categorie->id);
        return response()->json($categories);
    }

    // destroy method
    public function destroy(Categorie $categorie)
    {
        $categories = $this->service->destroy($categorie->id);
        return response()->json($categories);
    }

}
