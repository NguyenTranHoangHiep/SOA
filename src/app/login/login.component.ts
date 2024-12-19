import { Component } from '@angular/core';
import { AuthService } from '../auth.service';  // Import AuthService
import { Router } from '@angular/router';
import { User } from '../models/user.model';  // Import User Interface
import { LoginResponse } from '../models/login-response.model';  // Import LoginResponse Interface

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  model: User = { UserName: '', Password: '' };  // Đảm bảo khai báo model đúng

  constructor(private authService: AuthService, private router: Router) {}

  onSubmit() {
    const { UserName, Password } = this.model;

    // Gọi phương thức login từ AuthService
    this.authService.login(UserName, Password).subscribe(
      (response: LoginResponse) => {  // Define the response type as LoginResponse
        if (response.access_token) {
          // Lưu token vào localStorage thông qua AuthService
          this.authService.saveToken(response.access_token);
          // Chuyển hướng đến trang sau khi login thành công
          this.router.navigate(['/products']);
        } else {
          alert('Login failed!');
        }
      },
      (error) => {
        alert('An error occurred during login');
        console.error(error);
      }
    );
  }
}
