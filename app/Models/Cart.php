<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = [
        'session_id',
        'user_id',
    ];
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
