<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
