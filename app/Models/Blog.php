<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'content',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

}
