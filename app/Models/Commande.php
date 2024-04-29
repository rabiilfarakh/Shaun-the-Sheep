<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $table = 'commandes';

    protected $fillable = ['panier_id','client_id','status'];

    public function paniers()
    {
        return $this->hasMany(Panier::class);
    }

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
}
