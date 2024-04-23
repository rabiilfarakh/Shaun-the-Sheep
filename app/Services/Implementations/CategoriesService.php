<?php

namespace App\Services\Implementations;

use App\Models\Categorie;
use App\Repositories\Interfaces\CategoriesRepositoryInterface;
use App\Services\Interfaces\CategoriesServiceInterface;

class CategoriesService implements CategoriesServiceInterface
{
    public function __construct(public  CategoriesRepositoryInterface $reposetory)
    {
    }
    public function index()
    {
        return $this->reposetory->index();
    }

    public function store(array $data)
    {
        return $this->reposetory->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->reposetory->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->reposetory->destroy($id);
    }
}
