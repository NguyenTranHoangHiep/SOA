<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items'; // Bảng liên kết
    protected $fillable = ['order_id', 'product_id', 'product_name', 'quantity', 'unit_price']; // Các cột có thể mass assign

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
