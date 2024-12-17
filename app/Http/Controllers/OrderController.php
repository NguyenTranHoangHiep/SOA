<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Lấy danh sách tất cả các đơn hàng
    public function index()
    {
        return Order::all();
    }

    // Lấy thông tin chi tiết một đơn hàng
    public function show($id)
    {
        return Order::find($id);
    }

    // Tạo đơn hàng mới
    public function store(Request $request)
    {
        // Kiểm tra tồn kho (giả sử bạn có logic kiểm tra kho)
        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    // Cập nhật trạng thái đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update($request->all());
            return response()->json($order);
        }
        return response()->json(['message' => 'Order not found'], 404);
    }

    // Xóa một đơn hàng
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json(['message' => 'Order deleted']);
        }
        return response()->json(['message' => 'Order not found'], 404);
    }
}
