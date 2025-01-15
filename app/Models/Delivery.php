<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Delivery extends Model
{
    protected $fillable = ['order_id', 'status', 'current_location'];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public static function getDelivery($id)
    {
        try {
            $delivery = Delivery::query()->select([
                'id',
                'order_id',
                'status',
                DB::raw("ST_Y(current_location) as lng"),
                DB::raw("ST_X(current_location) as lat"),
                'created_at',
                'updated_at'
            ])->where('id', $id)->firstOrFail();
            return $delivery;
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ]);
        }
    }
}
