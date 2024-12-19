import { Component, OnInit } from '@angular/core';
import { ProductService } from '../services/product.service';
import { Product } from '../models/Product.model'; // Import Product interface
import { Router } from '@angular/router';  // Import Router

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {
  products: Product[] = [];  // Store products data as Product[] array
  error: string | null = null;  // Store error message
  showModal = false;  // Track modal visibility
  selectedProduct: Product | null = null;  // Store selected product for editing

  constructor(
    private productService: ProductService, // Inject ProductService
    private router: Router  // Inject Router
  ) { }

  ngOnInit(): void {
    this.loadProducts();
  }

  // Load all products
  loadProducts(): void {
    this.productService.getProducts().subscribe(
      (data) => {
        this.products = data;  // Store product data
      },
      (err) => {
        this.error = 'Error fetching products: ' + err.message;  // Handle error
        console.error(err);
      }
    );
  }

  // Open modal with selected product data
  openEditModal(product: Product): void {
    this.selectedProduct = { ...product };  // Clone product data to avoid modifying original
    this.showModal = true;
  }

  // Close modal
  closeModal(): void {
    this.showModal = false;
    this.selectedProduct = null;
  }

  // Update product
  updateProduct(): void {
    if (this.selectedProduct) {
      const productId = this.selectedProduct.id;
      this.productService.updateProduct(productId, this.selectedProduct).subscribe(
        (response) => {
          console.log('Product updated successfully:', response);
          this.loadProducts();  // Reload product list
          this.closeModal();  // Close modal
        },
        (error) => {
          console.error('Error updating product:', error);
        }
      );
    }
  }

  // Navigate to the orders page
  navigateToOrders(): void {
    this.router.navigate(['/orders']);  // Navigate to the '/orders' route
  }
}
