<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

     protected $fillable = [
         'name',
         'category_id',
         'amount',
         'minus_amount',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function category(){
        return $this->belongsTo('Category','id');
    }
}
