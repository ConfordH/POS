<?php

namespace App;
use App\User;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'amount'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
