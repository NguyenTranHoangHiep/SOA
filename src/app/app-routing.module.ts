// app-routing.module.ts
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DashboardComponent } from './dashboard/dashboard.component';  // Import DashboardComponent
import { LoginComponent } from './login/login.component';  // Import LoginComponent
import { ProductListComponent } from './product-list/product-list.component';
import { OrdersComponent } from './orders/orders.component';
const routes: Routes = [
  { path: 'dashboard', component: DashboardComponent }, // Route for dashboard
  { path: 'login', component: LoginComponent }, // Correct login route
  { path: 'products', component: ProductListComponent }, // Correct login route
  {path:'orders',component:OrdersComponent},
  { path: '', redirectTo: '/login', pathMatch: 'full' }, // Default route (redirect to login)
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
