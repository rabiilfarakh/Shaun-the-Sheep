<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'animals';

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function nouritures()
    {
        return $this->belongsToMany(Nouriture::class, 'animal_nourriture');
    }

    // public function images()
    // {
    //     return $this->morphMany(Image::class, 'imageable');
    // }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function panier()
    {
        return $this->hasOne(Panier::class);
    }
}