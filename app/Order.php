<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'total_bill', 'invoice_number','courier_service', 'status'];
}
