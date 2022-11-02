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
        'section_id',
        'item_id',
        'new_item_id',
        'status_1',
        'status_1_id',
        'status_2',
        'status_2_id',
        'status_3',
        'status_3_id',
        'quantity',
        'new_quantity',
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

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
