<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitem extends Model
{
    use HasFactory;

    protected $fillable=[
        'code',
        'item_id',
        'room_id',
        'building_id',
    ];
}
