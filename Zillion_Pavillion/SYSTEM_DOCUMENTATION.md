# Zillion Pavillion - Event Management System

## 🎉 Overview
Complete event management system with separate portals for Admin, Staff, and Clients. Built with Laravel and PostgreSQL.

## 🔐 Login Credentials

### Admin Access
- **URL**: http://localhost:8000/admin/login
- **Username**: `vince`
- **Password**: `426999` (or use backup account `vince_alt` with password `42699`)

### Staff Access
- **URL**: http://localhost:8000/staff/login
- **Username**: `staff1` or `staff2`
- **Password**: `password`

### Client Access
- **URL**: http://localhost:8000/login
- Clients can register their own accounts

## 🚀 Features

### Admin Panel
- **Full System Control**: Complete access to all features
- **Dashboard**: Overview of clients, staff, bookings, services, and revenue
- **Client Management**: Add, edit, view, and delete clients
- **Staff Management**: Manage staff accounts and their information
- **Booking Management**: Complete CRUD operations for all bookings
- **Service Management**: Manage event packages and add-on services
- **Reports**: View statistics and recent activities

### Staff Panel
- **Dashboard**: View booking statistics and upcoming events
- **Booking Management**: View bookings and update status
- **Limited Access**: Cannot manage clients, staff, or services

### Client Portal
- **Dashboard**: View personal bookings and statistics
- **Make Bookings**: Create new event bookings
- **Select Services**: Choose from available packages and add-ons
- **Track Bookings**: Monitor booking status and details

## 📊 Database Structure

### Tables Created
- `admins` - Administrator accounts
- `staff` - Staff member accounts
- `clients` - Client accounts
- `bookings` - Event bookings
- `services` - Service packages
- `booking_services` - Pivot table for booking-service relationship

### Sample Services
1. Wedding Package Basic - ₱50,000
2. Wedding Package Premium - ₱100,000
3. Birthday Party Package - ₱25,000
4. Corporate Event Package - ₱75,000
5. Debut Package - ₱60,000
6. Catering Service - ₱500/person
7. Photography Service - ₱15,000
8. Sound System - ₱10,000

## 🛠️ Technical Stack
- **Framework**: Laravel 11
- **Database**: PostgreSQL
- **Frontend**: Blade Templates, Bootstrap 5
- **Authentication**: Multi-guard (Admin, Staff, Client)
- **Icons**: Bootstrap Icons

## 📁 Key Files

### Backend
- `app/Models/` - Admin, Staff, Client, Booking, Service models
- `app/Http/Controllers/Admin/` - Admin controllers
- `app/Http/Controllers/Staff/` - Staff controllers
- `app/Http/Middleware/` - Authentication middleware
- `routes/web.php` - All application routes

### Frontend
- `resources/views/admin/` - Admin panel views
- `resources/views/staff/` - Staff panel views
- `resources/views/client/` - Client portal views

### Database
- `database/migrations/` - Database schema
- `database/seeders/DatabaseSeeder.php` - Initial data

## 🔧 Configuration

### Database Connection (.env)
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=zillion_pavillion
DB_USERNAME=vince
DB_PASSWORD=426999
```

### Authentication Guards (config/auth.php)
- `web` - Client authentication
- `admin` - Admin authentication
- `staff` - Staff authentication

## 🎯 Access Levels

### Admin (Super User)
✅ View and manage all clients
✅ Add, edit, delete staff accounts
✅ Full booking CRUD operations
✅ Service management
✅ View system statistics
✅ Access all reports

### Staff (Limited User)
✅ View all bookings
✅ Update booking status
✅ View upcoming events
❌ Cannot manage clients
❌ Cannot manage staff
❌ Cannot manage services

### Client (End User)
✅ Create bookings
✅ View own bookings
✅ Select services
✅ Update profile
❌ Cannot view other clients' data
❌ No administrative access

## 🚦 Getting Started

1. **Start the server**: `php artisan serve`
2. **Access admin panel**: http://localhost:8000/admin/login
3. **Login with**: Username: `vince` | Password: `426999`
4. **Explore the system**: Navigate through dashboard, clients, staff, bookings, and services

## 📝 Notes
- Both admin accounts (vince and vince_alt) have super admin privileges
- Staff can only view and update booking status
- Clients can only manage their own bookings
- All passwords are securely hashed using bcrypt
- PostgreSQL PHP extensions enabled in `C:\php-8.4.12\php.ini`

## 🔐 Security Features
- Multi-guard authentication
- Password hashing
- Session management
- CSRF protection
- Route middleware protection
- Active status checking

## 📞 Support
For any issues or questions, contact the administrator at vince@zillionpavillion.com
