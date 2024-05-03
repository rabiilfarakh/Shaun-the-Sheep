<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class panier_animal extends Model
{
    use HasFactory;
    protected $table = 'panier_animal';
    public $timestamps = false; 
    protected $fillable = ['animal_id','panier_id','status'];
}
