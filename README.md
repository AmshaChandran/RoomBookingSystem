# Simple Room Booking System with Admin Panel

This is a simple room booking system built with Laravel, featuring an admin panel for CRUD operations on rooms, the ability to update room availability based on customer bookings, and PayPal payment integration for bookings. Customers can browse rooms, register to book a room, and pay after booking.

### Features:
- **Admin Panel**: CRUD operations for rooms (Create, Read, Update, Delete).
- **Room Availability**: Update room availability based on customer bookings.
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

### 1. Clone the Repository

First, clone this repository to your local machine:

```bash
git clone https://github.com/AmshaChandran/RoomBookingSystem.git

2. Install Dependencies
Navigate to the project directory and install the required PHP and frontend dependencies:
cd room-booking-system
composer install
npm install
3. Configure Environment Variables
Rename the .env.example file to .env and configure the following environment variables:
•	APP_KEY: Generate an application key using php artisan key:generate.
•	DATABASE: Set your database credentials for MySQL or your preferred database.
•	PAYPAL: Configure your PayPal credentials (client ID and secret).
For example, set up your PayPal credentials in .env like this:
PAYPAL_MODE =sandbox or live
PAYPAL_CLIENT_ID=your-client-id
PAYPAL_SECRET=your-secret
4. Set Up the Database
Run the following Artisan command to create the necessary database tables:
php artisan migrate
5. Set Up the Storage
Link the storage directory to the public directory:
php artisan storage:link
6. Compile Frontend Assets
Use the following command to compile the Tailwind CSS and other frontend assets:
npm run dev
7. Create Admin and User Roles
•	The Admin can manage rooms, bookings, and view payment statuses.
•	Users can register, browse available rooms, and make bookings.
8. Run the Application
Now, you are ready to run the application using Laravel's built-in server:
php artisan serve
Visit http://localhost:8000 in your browser.
________________________________________
Features and Functionality
1. Admin Panel
The admin panel allows the admin to:
•	Manage Rooms: Add, update, and delete rooms.
•	Update Room Availability: Mark rooms as available or unavailable based on customer bookings.
•	View Bookings: View the bookings made by customers along with payment statuses.
2. Customer Features
Customers can:
•	Browse Rooms: View available rooms and their details.
•	Register and Login: Register a new account and log in to manage bookings.
•	Book Rooms: Choose a room, enter booking details, and pay via PayPal.
•	Pay via PayPal: Secure payment process via PayPal after booking a room.
________________________________________
Payment Integration with PayPal
PayPal integration allows customers to make payments after booking a room. The process is:
1.	Booking: Customers select a room and book. After booking proceed to checkout via Pay Now.
2.	Payment: Customers are redirected to PayPal to complete the payment.
3.	Confirmation: Upon successful payment, the room availability is updated, and the booking is confirmed.
Setting Up PayPal
You will need to set up a PayPal Developer account and generate API credentials (Client ID and Secret). These credentials should be added to the .env file as mentioned earlier.
________________________________________
Acknowledgements
•	Thanks to the Laravel community for creating a wonderful framework!
•	Special thanks to PayPal for providing a simple and secure payment API.
________________________________________
