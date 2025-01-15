<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'store_id',
        'user_id',
        'number',
        'status',
        'payment_method',
        'payment_status'
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->withPivot(['product_name', 'price', 'quantity', 'options']);
    }

    /*
      * Get the products for this order
      */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class, 'order_id', 'id');
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', 'shipping');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        // select max(nubmer) from orders where
        $number = Order::whereYear('created_at', $year)->max('number');
        if ($number) {
            return $number + 1;
        }
        return $year . '00001';
    }
}
