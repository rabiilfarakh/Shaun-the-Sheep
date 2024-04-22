<?php

namespace App\Repositories\Implementations;

use App\Models\Categorie;
use App\Repositories\Interfaces\CategoriesRepositoryInterface;

class CategoriesRepository implements CategoriesRepositoryInterface
{
    public function index()
    {
        return Categorie::all();
    }

    public function store(array $data)
    {
        return Categorie::create($data);
    }

    public function update(array $data, $id)
    {
        $resource = Categorie::findOrFail($id);
        $resource->update($data);
        return $resource;
    }

    public function destroy($id)
    {
        $resource = Categorie::findOrFail($id);
        $resource->delete();
    }
}

