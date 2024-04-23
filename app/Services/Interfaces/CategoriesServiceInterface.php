<?php

namespace App\Services\Interfaces;

interface CategoriesServiceInterface
{
    public function index();
    
    public function store(array $data);

    public function update(array $data, $id);

    public function destroy($id);
}
