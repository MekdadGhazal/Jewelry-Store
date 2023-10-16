<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function booted()
    {
        static::creating(function ($event) {
            $event->order_number = Hash::make(static::generateOrderNumber());
        });
    }

    public static function generateOrderNumber()
    {
        $lastEvent = static::latest()->first();
        $lastOrderNumber = $lastEvent ? intval($lastEvent->order_number) : 0;
        return str_pad($lastOrderNumber + 1, 8, '0', STR_PAD_LEFT);
    }
}

