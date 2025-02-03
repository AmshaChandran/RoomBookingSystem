```markdown
# Simple Room Booking System with Admin Panel

This is a simple room booking system built with Laravel, featuring an admin panel for CRUD operations on rooms, the ability to update room availability based on customer bookings, and PayPal payment integration for bookings. Customers can browse rooms, register to book a room, and pay after booking.

### Features:
- **Admin Panel**: CRUD operations for rooms (Create, Read, Update, Delete).
- **Room Availability**: Admin can update room availability based on customer bookings and payment statuses.
- **Customer Booking**: Customers can browse available rooms and book them.
- **PayPal Integration**: Secure payment processing via PayPal after booking.
- **Authentication**: Users can register, login, and manage their bookings.
- **Breeze Frontend**: Laravel Breeze with Blade templates and Tailwind CSS.

---

## Prerequisites

Before you begin, make sure you have the following installed:

- **PHP**: Version 8.0 or higher.
- **Composer**: To manage dependencies.
- **Laravel**: Version 10.x or higher.
- **Node.js** (for frontend assets with Tailwind CSS).
- **MySQL** or any other supported database.

---

## Setup Guide

1. **Clone the Repository**

   Clone or download the repository:

   ```bash
   git clone https://github.com/AmshaChandran/RoomBookingSystem.git
   ```

   Alternatively, you can download the ZIP file.

2. **Install Dependencies**

   Navigate to the project directory and install the required PHP and frontend dependencies:

   ```bash
   cd RoomBookingSystem
   composer install
   npm install
   ```

3. **Configure Environment Variables**

   Copy the contents of `.env.example` into a new `.env` file:

   ```bash
   cp .env.example .env
   ```

   In the `.env` file, set the following values:
   - **DB_DATABASE**: Create a new MySQL database and set the name here.
   - **PayPal Settings**: Replace the following with your PayPal API credentials:

   ```env
   PAYPAL_MODE=sandbox    # or live
   PAYPAL_SANDBOX_CLIENT_ID=your-sandbox-client-id
   PAYPAL_SANDBOX_CLIENT_SECRET=your-sandbox-client-secret
   PAYPAL_LIVE_CLIENT_ID=your-live-client-id
   PAYPAL_LIVE_CLIENT_SECRET=your-live-client-secret
   ```

4. **Generate Application Key**

   Set the application key for the project:

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Run the migrations to create the necessary tables in the database:

   ```bash
   php artisan migrate
   ```

6. **Run Seeders**

   Seed the database with initial data for the admin and rooms:

   ```bash
   php artisan db:seed --class=AdminSeeder
   php artisan db:seed --class=RoomSeeder
   ```

7. **Run Storage Link**

   Link the storage directory to the public directory:

   ```bash
   php artisan storage:link
   ```

8. **Compile Frontend Assets**

   Use the following command to compile the Tailwind CSS and other frontend assets:

   ```bash
   npm run dev
   ```

9. **Run the Application**

   Now, you're ready to run the application:

   ```bash
   php artisan serve
   ```

   Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## Admin Credentials

- **Email**: `admin@example.com`
- **Password**: `adminpassword`

You can now log in as an admin to manage rooms and bookings.

---

## Admin Features

The **admin** can:
- **Manage Rooms**: Add, update, and delete rooms.
- **Check Payment Status**: Admin can view and verify the payment status of bookings.
- **Update Room Availability**: Based on the payment status, the admin can update room availability (e.g., mark as unavailable if booked and paid).
- **View Bookings**: View the bookings made by customers, including details like room type, booking date, and payment status.

---

## Customer Features

Customers can:
- Browse available rooms and their details.
- Register a new account and log in to manage bookings.
- Book a room, enter booking details, and pay via PayPal.

---

## PayPal Payment Integration

PayPal integration allows customers to make payments after booking a room. The process is as follows:

1. **Booking**: Customers select a room and book. After booking, proceed to checkout via PayPal.
2. **Payment**: Customers are redirected to PayPal to complete the payment.
3. **Confirmation**: Upon successful payment, the room availability is updated, and the booking is confirmed. Admin can also manually verify the payment status.

---

## Acknowledgements

- Thanks to the Laravel community for creating a wonderful framework!
- Special thanks to PayPal for providing a simple and secure payment API.

Happy Coding! 🚀
```

I added that the admin can check the payment status and update room availability accordingly. Let me know if you'd like any further edits!