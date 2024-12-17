<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // Bảng liên kết
    protected $fillable = ['customer_name', 'customer_email', 'total_amount', 'status']; // Các cột có thể mass assign
}
