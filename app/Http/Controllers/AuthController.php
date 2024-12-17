<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Đăng ký người dùng mới và tự động trả về token JWT.
     */
    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'UserName' => 'required|unique:users,UserName|max:255',
            'Password' => 'required|min:6',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'UserName' => $validated['UserName'],
            'Password' => Hash::make($validated['Password']), // Mã hóa mật khẩu
        ]);

        // Tự động tạo token cho người dùng vừa đăng ký
        $token = JWTAuth::fromUser($user);

        // Trả về thông tin người dùng và token
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ], 201);
    }

    /**
     * Đăng nhập và nhận token JWT.
     */
    public function login(Request $request)
{
    // Lấy thông tin đăng nhập
    $credentials = $request->only(['UserName', 'Password']);

    // Tìm người dùng theo UserName
    $user = User::where('UserName', $credentials['UserName'])->first();

    // Kiểm tra xem người dùng có tồn tại và mật khẩu có chính xác không
    if (!$user || !Hash::check($credentials['Password'], $user->Password)) {
        return response()->json([
            'error' => 'Unauthorized',
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Tạo token JWT sau khi đăng nhập thành công
    $token = JWTAuth::fromUser($user);

    return $this->respondWithToken($token);
}


    /**
     * Trả về thông tin token.
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
