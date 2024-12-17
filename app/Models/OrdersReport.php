<?php
// OrdersReport Model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersReport extends Model
{
    protected $table = 'orders_reports'; // Bảng liên kết

    protected $fillable = ['order_id', 'total_revenue', 'total_cost', 'total_profit']; // Các cột có thể mass assign
}
