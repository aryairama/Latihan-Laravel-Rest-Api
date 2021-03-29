<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    protected $table = 'book_order';
    protected $primaryKey = "id";
    protected $fillable = ['book_id', 'order_id', 'quantity'];
}
