<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    
    protected $fillable = [
        'user_id', "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function paniers()
    {
        return $this->hasMany(Panier::class);
    }
}
