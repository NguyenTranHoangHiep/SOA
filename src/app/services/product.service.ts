import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from '../auth.service';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  private apiUrl = 'http://localhost:8000/api/products';  // API URL for products

  constructor(private http: HttpClient, private authService: AuthService) { }

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

  // Lấy danh sách sản phẩm
  getProducts(): Observable<any> {
    return this.http.get<any>(this.apiUrl, { headers: this.getAuthHeaders() });
  }

  // Cập nhật sản phẩm
  updateProduct(productId: number, updatedProduct: any): Observable<any> {
    const url = `${this.apiUrl}/${productId}`; // API endpoint cho sản phẩm cụ thể
    return this.http.put<any>(url, updatedProduct, { headers: this.getAuthHeaders() });
  }
}
