<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Đảm bảo sử dụng bảng products
    protected $primaryKey = 'id'; // Khóa chính
    public $timestamps = false; // Bỏ qua timestamps nếu bạn không sử dụng chúng trong bảng

    protected $fillable = [
        'name', 'description', 'price', 'quantity'
    ];
}
