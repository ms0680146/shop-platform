<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = [
        'user_id', 'carts',
    ];

    protected $casts = [
        'carts' => 'array',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
