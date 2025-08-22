<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
