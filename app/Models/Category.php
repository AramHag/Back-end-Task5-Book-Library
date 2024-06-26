<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
    ];

    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id' , 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault('Main Categroy');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
