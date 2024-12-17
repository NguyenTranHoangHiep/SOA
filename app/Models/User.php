<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    protected $primaryKey = 'IdUser'; // Khai báo khóa chính
    public $incrementing = true;      // Nếu khóa chính là tự tăng
    protected $keyType = 'int';       // Kiểu dữ liệu của khóa chính

    protected $fillable = ['UserName', 'Password']; // Các cột có thể thêm/sửa

    /**
     * JWTSubject Implementation.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Trả về khóa chính
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
