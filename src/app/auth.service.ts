import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from './models/user.model';  // Import User Interface
import { LoginResponse } from './models/login-response.model';  // Import LoginResponse Interface

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private apiUrl = 'http://localhost:8000/api/login';  // Địa chỉ API

  constructor(private http: HttpClient) {}

  login(UserName: string, Password: string): Observable<LoginResponse> {
    const loginData = { UserName, Password };
    console.log('Login data being sent:', loginData);  // In ra dữ liệu để kiểm tra
    return this.http.post<LoginResponse>(this.apiUrl, loginData);
  }

  saveToken(token: string): void {
    localStorage.setItem('auth_token', token);
  }
  getToken(): string | null {
    return localStorage.getItem('auth_token');
  }
}
