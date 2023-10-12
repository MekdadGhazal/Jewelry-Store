<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getOrderNumberAttribute($value)
    {
        return str_pad($value, 8, '0', STR_PAD_LEFT);
    }
}
