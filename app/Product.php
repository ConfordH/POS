<?php

namespace App;
use App\Category;
use App\Transaction;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable  = [
        'name', 'description', 'slug', 'price', 'category_id'
    ];

    // public function category(){
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }
    // public function transactions(){
    //     return $this->hasMany(Transaction::class);
    // }
}
