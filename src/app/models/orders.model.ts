export interface Order {
    id: number;                  // ID của đơn hàng
    customer_name: string;       // Tên khách hàng
    customer_email: string;      // Email khách hàng
    total_amount: number;        // Tổng số tiền
    status: string;              // Trạng thái đơn hàng
    created_at: string;          // Thời gian tạo
    updated_at: string;          // Thời gian cập nhật
  }
  