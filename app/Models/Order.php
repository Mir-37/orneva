<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class Order extends Model
{
    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::updated(function ($order) {
            // Check if 'status' changed
            if ($order->wasChanged('status')) {
                $user = $order->user;

                Notification::make()
                    ->title('Your order status has been updated')
                    ->body("Order #{$order->order_no} is now '{$order->status}'")
                    ->success()
                    ->sendToDatabase($user);
            }
        });
    }
}
