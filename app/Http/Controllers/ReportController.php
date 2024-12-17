<?php
namespace App\Http\Controllers;

use App\Models\OrdersReport;
use App\Models\ProductReport;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Lấy danh sách tất cả báo cáo sản phẩm
    public function getProductsReports()
    {
        $reports = ProductReport::all();
        return response()->json($reports);
    }

    // Lấy báo cáo cho một sản phẩm
    public function getProductReport($id)
    {
        $report = ProductReport::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }
        return response()->json($report);
    }

    // Tạo báo cáo sản phẩm mới
    public function createProductReport(Request $request)
    {
        $request->validate([
            'order_report_id' => 'required|integer|exists:orders_reports,id',
            'product_id' => 'required|integer|exists:products,id',
            'total_sold' => 'required|integer',
            'revenue' => 'required|numeric',
            'cost' => 'required|numeric',
        ]);

        $report = ProductReport::create([
            'order_report_id' => $request->order_report_id,
            'product_id' => $request->product_id,
            'total_sold' => $request->total_sold,
            'revenue' => $request->revenue,
            'cost' => $request->cost,
        ]);

        return response()->json(['message' => 'Product report created successfully', 'data' => $report], 201);
    }

    // Xóa báo cáo sản phẩm
    public function deleteProductReport($id)
    {
        $report = ProductReport::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }
        $report->delete();
        return response()->json(['message' => 'Product report deleted successfully']);
    }

    // Lấy danh sách tất cả báo cáo đơn hàng
    public function getOrdersReports()
    {
        $reports = OrdersReport::all();
        return response()->json($reports);
    }

    // Lấy báo cáo cho một đơn hàng
    public function getOrderReport($id)
    {
        $report = OrdersReport::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }
        return response()->json($report);
    }

    // Tạo báo cáo đơn hàng mới
    public function createOrderReport(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'total_revenue' => 'required|numeric',
            'total_cost' => 'required|numeric',
        ]);

        $order = Order::find($request->order_id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Tính toán tổng lợi nhuận
        $total_profit = $request->total_revenue - $request->total_cost;

        $report = OrdersReport::create([
            'order_id' => $request->order_id,
            'total_revenue' => $request->total_revenue,
            'total_cost' => $request->total_cost,
            'total_profit' => $total_profit,
        ]);

        return response()->json(['message' => 'Order report created successfully', 'data' => $report], 201);
    }

    // Xóa báo cáo đơn hàng
    public function deleteOrderReport($id)
    {
        $report = OrdersReport::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }
        $report->delete();
        return response()->json(['message' => 'Order report deleted successfully']);
    }
}
