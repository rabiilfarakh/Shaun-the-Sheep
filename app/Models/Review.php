<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function blog()
    {
        return $this->hasMany(blog::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
