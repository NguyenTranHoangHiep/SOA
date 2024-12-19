import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class OrderService {

  private apiUrl = 'http://localhost:8000/api/orders';  // API URL for orders

  constructor(private http: HttpClient, private authService: AuthService) { }

  // Lấy token và tạo header cho các yêu cầu
  private getAuthHeaders(): HttpHeaders {
    const token = this.authService.getToken();

    if (!token) {
      throw new Error('No token found');
    }

    return new HttpHeaders({
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    });
  }

  // Lấy danh sách đơn hàng
  getOrders(): Observable<any> {
    return this.http.get<any>(this.apiUrl, { headers: this.getAuthHeaders() });
  }

  // Tạo đơn hàng mới
  createOrder(orderData: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, orderData, { headers: this.getAuthHeaders() });
  }

  // Cập nhật trạng thái đơn hàng
  updateOrderStatus(orderId: number, status: string): Observable<any> {
    const url = `${this.apiUrl}/${orderId}`;
    return this.http.put<any>(url, { status }, { headers: this.getAuthHeaders() });
  }
}
