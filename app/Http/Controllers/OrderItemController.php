<?php
namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Lấy danh sách tất cả các mặt hàng trong đơn hàng
    public function index()
    {
        return OrderItem::all();
    }

    // Lấy thông tin chi tiết một mặt hàng
    public function show($id)
    {
        return OrderItem::find($id);
    }

    // Tạo mặt hàng mới
    public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $orderItem
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}

    // Cập nhật mặt hàng
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);
        if ($orderItem) {
            $orderItem->update($request->all());
            return response()->json($orderItem);
        }
        return response()->json(['message' => 'Order item not found'], 404);
    }

    // Xóa một mặt hàng trong đơn hàng
    public function destroy($id)
    {
        $orderItem = OrderItem::find($id);
        if ($orderItem) {
            $orderItem->delete();
            return response()->json(['message' => 'Order item deleted']);
        }
        return response()->json(['message' => 'Order item not found'], 404);
    }
}
