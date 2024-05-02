<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;
    protected $table = 'paniers';
    protected $fillable = ['animal_id','client_id','status'];

    public function animals()
    {
        return $this->belongsToMany(Animal::class, 'panier_animal', 'panier_id', 'animal_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
