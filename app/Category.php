<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'slug', 'image', 'status'];
    /**
     * The books that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category', 'category_id', 'book_id');
    }
}
