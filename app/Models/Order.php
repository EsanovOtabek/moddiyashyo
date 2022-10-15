<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'building_id',
        'item_id',
        'status_1',
        'status_2',
        'status_3',
        'quantity',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function building(){
        return $this->belongsTo(Building::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
