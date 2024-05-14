<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publish_date',
        'description',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'favorites',
            'user_id',
            'book_id',
            'id',
            'id'
        );
    }
}
