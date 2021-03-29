<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $table = "books";
    protected $primaryKey = "id";
    protected $fillable = ['title', 'slug', 'description', 'author', 'publisher','cover', 'price', 'weight', 'stock', 'status'];
    /**
     * The categories that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }
}
