<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nouriture extends Model
{
    use HasFactory;
    protected $table = 'nouriture';

    public function animaux()
    {
        return $this->belongsToMany(Animal::class, 'animal_nourriture');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
