# Sped Delivery - Round 1

Welcome to the **Sped Delivery Round 1 Submission**.  
This project is a Laravel v12 backend system to manage **Orders, Delivery Zones, and Delivery Men** for a food delivery platform.

---

## 🚀 Project Overview

This project implements the following features:

1. **Delivery Zones**
   - Restaurants can define delivery areas as:
     - **Polygon zones**: Custom-drawn areas
     - **Radius-based zones**: Circular zones around the restaurant
   - Orders are only accepted if the delivery address falls inside a delivery zone.

2. **Orders**
   - Place new orders from restaurants.
   - Orders validate the delivery address against delivery zones.
   - Distance (km) from restaurant to delivery location is calculated automatically.
   - Assign nearest available delivery man within a 5 km radius.

3. **Delivery Men**
   - Add, edit, delete delivery men.
   - Track their status: available, busy, inactive.
   - Nearest available delivery man is automatically assigned to eligible orders.

4. **Order Status**
   - Pending → Assigned → Accepted / Rejected → Processing → Delivered / Cancelled
   - Admin can update order status from dashboard.

---

## 🛠 Technical Stack

- **Framework**: Laravel v12
- **Database**: MySQL
- **Authentication**: Laravel Sanctum (optional)
- **Testing**: PHPUnit (optional)
- **Geo Calculations**: Haversine formula for distance
- **Frontend (Admin UI)**: Blade templates

---

## ⚡ Installation & Setup

### 1. Clone Repository

```bash
git clone https://github.com/mdfahimhossens/sped_delivery_round1.git
cd sped_delivery_round1
