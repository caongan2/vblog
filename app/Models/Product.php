<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['category_id', 'name', 'price', 'img', 'user_id'];
    function category(){
        return $this->belongsTo(Categories::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
