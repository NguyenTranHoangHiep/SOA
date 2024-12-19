import { Component, OnInit } from '@angular/core';
import { OrderService } from '../order.service';
import { Order } from '../models/orders.model';

@Component({
  selector: 'app-order-list',
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css']
})
export class OrdersComponent implements OnInit {
  orders: Order[] = []; // List of orders
  error: string | null = null; // Error message
  showModal = false; // Flag to control modal visibility
  newOrder: Order = { // New order initialization
    id: 0,
    customer_name: '',
    customer_email: '',
    total_amount: 0,
    status: 'pending',
    created_at: '',
    updated_at: ''
  };

  constructor(private orderService: OrderService) {}

  ngOnInit(): void {
    this.loadOrders();
  }

  loadOrders(): void {
    this.orderService.getOrders().subscribe(
      (data) => {
        this.orders = data; // Assign fetched data to orders
      },
      (err) => {
        this.error = 'Error fetching orders: ' + err.message;
        console.error(err);
      }
    );
  }

  createOrder(): void {
    if (this.newOrder.customer_name && this.newOrder.customer_email && this.newOrder.total_amount) {
      this.orderService.createOrder(this.newOrder).subscribe(
        (response) => {
          console.log('Order created successfully:', response);
          this.loadOrders(); // Reload orders after creating a new one
          this.resetNewOrderForm(); // Reset form after submission
          this.showModal = false; // Close modal after creating the order
        },
        (error) => {
          console.error('Error creating order:', error);
          this.error = 'An error occurred while creating the order.';
        }
      );
    } else {
      this.error = 'Please fill in all fields correctly.'; // Validation message
    }
  }

  resetNewOrderForm(): void {
    this.newOrder = {
      id: 0,
      customer_name: '',
      customer_email: '',
      total_amount: 0,
      status: 'pending',
      created_at: '',
      updated_at: ''
    };
  }

  openModal(): void {
    this.showModal = true; // Show modal
  }

  closeModal(): void {
    this.showModal = false; // Hide modal
  }
  updateOrderStatus(orderId: number, newStatus: string): void {
    this.orderService.updateOrderStatus(orderId, newStatus).subscribe(
      (updatedOrder) => {
        // Cập nhật trạng thái đơn hàng trong danh sách
        const index = this.orders.findIndex(order => order.id === orderId);
        if (index !== -1) {
          this.orders[index].status = updatedOrder.status;
        }
      },
      (error) => {
        console.error('Error updating order status:', error);
        this.error = 'An error occurred while updating the order status.';
      }
    );
  }
}
