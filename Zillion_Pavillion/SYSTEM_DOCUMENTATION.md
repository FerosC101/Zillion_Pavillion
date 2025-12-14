# Zillion Pavillion - Hotel & Event Management System

## 🎉 Overview
**Zillion Pavillion** is a comprehensive hotel and event management system with separate portals for Admin, Staff, and Clients. The system provides complete functionality for managing hotel operations including room bookings, service requests, staff management, and client relations.

**Built With:**
- Laravel 11 (PHP Framework)
- PostgreSQL Database
- Bootstrap 5 (Frontend Framework)
- Multi-Guard Authentication System
- Blade Template Engine

**System Capabilities:**
- Multi-user role-based access control (Admin, Staff, Client)
- Real-time booking management
- Room inventory and rate management
- Service request tracking
- Staff account management
- Comprehensive reporting and analytics
- Secure authentication with session management

---

## 🔐 Login Credentials

### Admin Access
- **URL**: `http://localhost:8000/admin/login`
- **Username**: `vince`
- **Password**: `426999`
- **Backup Account**: `vince_alt` / Password: `42699`
- **Role**: Super Administrator with full system access

### Staff Access
- **URL**: `http://localhost:8000/staff/login`
- **Test Accounts**: 
  - Username: `staff1` / Password: `password`
  - Username: `staff2` / Password: `password`
- **Role**: Limited access for operational staff

### Client Access
- **URL**: `http://localhost:8000/client/login`
- **Registration**: `http://localhost:8000/register`
- **Note**: Clients can self-register for new accounts
- **Role**: Personal account management and booking

---

## 🚀 Comprehensive Features

### 🔧 Admin Panel (Full System Control)

#### Dashboard
- **Real-time Statistics**
  - Total Clients count
  - Total Staff count and Active Staff count
  - Total Bookings
  - Services count
  - Pending, Confirmed, and Completed bookings breakdown
  - Total Revenue tracking (completed bookings only)
- **Quick Actions**
  - Create New Staff Account button
  - Recent Bookings table (last 10 bookings)
- **Visual Analytics**
  - Color-coded stat cards with icons
  - 4-column responsive grid layout

#### Client Management (`/admin/clients`)
- **List All Clients** (Paginated)
  - View client details (ID, name, email, phone, address)
  - Search and filter capabilities
  - Status indicators
- **Create New Client**
  - Full registration form
  - Email and phone validation
  - Address information
- **Edit Client Information**
  - Update personal details
  - Modify contact information
  - Change active status
- **View Client Details**
  - Complete profile information
  - Booking history
  - Service request history
- **Delete Client**
  - Soft delete with confirmation
  - Maintains data integrity

#### Staff Management (`/admin/staff`) ⭐ NEW
- **List All Staff Members** (Paginated, 15 per page)
  - Display: ID, Full Name, Username, Email, Position, Department, Status
  - Quick action buttons (View, Edit, Delete)
  - Active/Inactive status badges
- **Create Staff Account**
  - Required fields: Full Name, Username, Email, Password
  - Optional fields: Phone, Position, Department
  - Username uniqueness validation
  - Email format validation
  - Minimum password length (6 characters)
  - Password hashing with bcrypt
- **Edit Staff Account**
  - Update all staff information
  - Optional password change (leave blank to keep current)
  - Activate/Deactivate staff accounts
  - Username cannot be changed
  - Show creation and last update timestamps
- **View Staff Details**
  - Complete staff profile
  - Contact information
  - Position and department
  - Account status
  - Creation and update dates
- **Delete Staff Account**
  - Remove staff member with confirmation
  - Maintains audit trail

#### Booking Management (`/admin/bookings`)
- **View All Bookings**
  - Comprehensive booking list
  - Filter by status (pending, confirmed, completed, cancelled)
  - Sort by date, client, amount
- **Create Booking**
  - Select client
  - Choose room type
  - Set check-in/check-out dates
  - Calculate pricing
- **Edit Booking**
  - Modify booking details
  - Update status
  - Change dates and room assignments
- **View Booking Details**
  - Complete booking information
  - Client details
  - Room information
  - Payment status
  - Service requests
- **Cancel/Delete Booking**
  - Update booking status
  - Refund processing

#### Room Management (`/admin/rooms`)
- **Room Inventory**
  - List all rooms with details
  - Room type, capacity, amenities
  - Availability status
- **Room Rates Management**
  - Create seasonal rates
  - Set pricing for different room types
  - Manage rate periods
  - Delete expired rates
- **Add/Edit Rooms**
  - Room details and specifications
  - Upload room images
  - Set base pricing

#### Service Management (`/admin/services`)
- **Service Catalog**
  - Event packages
  - Add-on services
  - Pricing management
- **Service CRUD Operations**
  - Create new services
  - Edit service details
  - Set pricing and descriptions
  - Activate/deactivate services

#### Service Request Management (`/admin/service-requests`)
- **View All Service Requests**
  - Track all client service requests
  - Status monitoring
  - Priority sorting
- **Manage Requests**
  - Assign to staff
  - Update status
  - Add notes and comments

---

### 👥 Staff Panel (Operational Access)

#### Dashboard (`/staff/dashboard`)
- **Today's Statistics**
  - Check-ins scheduled
  - Check-outs scheduled
  - Active bookings count
  - Pending service requests
- **Upcoming Events**
  - Next 7 days bookings
  - Priority tasks
- **Quick Access**
  - Navigate to bookings
  - View service requests

#### Booking Management (`/staff/bookings`)
- **View Bookings**
  - Access all bookings (read-only)
  - Filter by status and date
  - Search by client name or booking ID
- **View Booking Details**
  - Complete booking information
  - Client contact details
  - Room assignment
  - Special requests
- **Update Booking Status**
  - Confirm pending bookings
  - Mark as checked-in
  - Mark as checked-out
  - Add booking notes

#### Service Request Management (`/staff/service-requests`)
- **View Service Requests**
  - All client service requests
  - Filter by status (pending, in-progress, completed)
  - Sort by priority
- **Manage Requests**
  - Update request status
  - Add progress notes
  - Mark as completed
  - View request history

#### Limitations
- ❌ Cannot create, edit, or delete clients
- ❌ Cannot create or delete staff accounts
- ❌ Cannot manage services or rooms
- ❌ Cannot access financial reports
- ✅ View-only access to most data
- ✅ Can update booking and service request statuses

---

### 🏨 Client Portal (Guest Interface)

#### Dashboard (`/client/dashboard`)
- **Personal Statistics**
  - Total bookings made
  - Upcoming reservations
  - Completed stays
  - Pending service requests
- **Quick Actions**
  - Make new booking
  - View rooms
  - Request service
- **Booking Summary**
  - Current and upcoming bookings
  - Booking status indicators

#### Room Browsing (`/client/rooms`)
- **Browse Available Rooms**
  - View room types and amenities
  - Check pricing and availability
  - View room photos and descriptions
- **Room Details**
  - Complete room specifications
  - Capacity information
  - Available amenities
  - Seasonal rates
- **Book Room**
  - Select dates
  - Choose room type
  - Instant booking confirmation

#### Booking Management (`/client/bookings`)
- **View My Bookings**
  - All personal bookings
  - Status tracking (pending, confirmed, completed)
  - Upcoming and past reservations
- **Create New Booking**
  - Select check-in/check-out dates
  - Choose room type
  - Add special requests
  - Calculate total cost
- **View Booking Details**
  - Reservation information
  - Room details
  - Payment status
  - Check-in instructions
- **Cancel Booking**
  - Cancel pending or confirmed bookings
  - View cancellation policy
  - Request refund

#### Service Requests (`/client/service-requests`)
- **Request Services**
  - Room service
  - Housekeeping
  - Maintenance
  - Special requests
- **Track Requests**
  - View request status
  - Progress updates
  - Request history
- **Cancel Request**
  - Cancel pending requests

#### Profile Management (`/client/profile`)
- **Update Profile**
  - Personal information
  - Contact details
  - Address
- **Change Password**
- **View Booking History**

---

### 🌐 Public Website Features

#### Quick Booking (`/`)
- **Homepage Quick Booking Form**
  - Direct booking from main website
  - Select dates and room type
  - Instant availability check
  - No login required (creates guest booking)

---

## 📊 Database Structure

### Core Tables

#### 1. `users` Table
- Primary user authentication table
- Columns: id, name, email, password, remember_token, timestamps
- Used for general authentication

#### 2. `admins` Table
Administrator accounts with full system access
```sql
- id (Primary Key)
- username (Unique)
- email (Unique)
- password (Hashed)
- full_name
- is_active (Boolean)
- created_at, updated_at
```

#### 3. `staff` Table
Staff member accounts with limited operational access
```sql
- id (Primary Key)
- username (Unique)
- email (Unique)
- password (Hashed)
- full_name
- phone
- position
- department
- is_active (Boolean)
- created_at, updated_at
```

#### 4. `clients` Table
Client/Guest accounts
```sql
- id (Primary Key)
- username (Unique)
- email (Unique)
- password (Hashed)
- full_name
- phone
- address
- is_active (Boolean)
- created_at, updated_at
```

#### 5. `rooms` Table
Hotel room inventory
```sql
- id (Primary Key)
- room_number (Unique)
- room_type (standard, deluxe, suite, etc.)
- capacity
- price_per_night
- description
- amenities (JSON)
- status (available, occupied, maintenance)
- created_at, updated_at
```

#### 6. `room_rates` Table
Dynamic pricing for rooms based on season/dates
```sql
- id (Primary Key)
- room_id (Foreign Key → rooms)
- rate_type (weekday, weekend, holiday, seasonal)
- start_date
- end_date
- rate (Decimal)
- description
- created_at, updated_at
```

#### 7. `bookings` Table
Hotel room reservations
```sql
- id (Primary Key)
- client_id (Foreign Key → clients)
- room_id (Foreign Key → rooms, Nullable)
- room_type
- check_in_date
- check_out_date
- number_of_guests
- special_requests (Text)
- total_amount (Decimal)
- paid_amount (Decimal)
- status (pending, confirmed, checked_in, completed, cancelled)
- created_at, updated_at
```

#### 8. `services` Table
Available services and packages
```sql
- id (Primary Key)
- name
- description
- price (Decimal)
- service_type (package, addon, room_service)
- is_active (Boolean)
- created_at, updated_at
```

#### 9. `service_requests` Table
Client service requests during stay
```sql
- id (Primary Key)
- booking_id (Foreign Key → bookings)
- service_id (Foreign Key → services, Nullable)
- client_id (Foreign Key → clients)
- request_type
- description
- priority (low, medium, high)
- status (pending, in_progress, completed, cancelled)
- assigned_to (Foreign Key → staff, Nullable)
- completed_at
- notes (Text)
- created_at, updated_at
```

#### 10. `booking_services` Table
Pivot table linking bookings to services
```sql
- id (Primary Key)
- booking_id (Foreign Key → bookings)
- service_id (Foreign Key → services)
- quantity
- price (Decimal)
- created_at, updated_at
```

### System Tables

#### 11. `cache` & `cache_locks`
Laravel caching system tables

#### 12. `jobs` & `failed_jobs`
Laravel queue system tables

#### 13. `password_reset_tokens`
Password reset functionality

#### 14. `sessions`
User session management

---

## 🎨 Sample Data

### Services (Event & Hotel)
1. **Wedding Package Basic** - ₱50,000
   - Basic event setup, standard catering
2. **Wedding Package Premium** - ₱100,000
   - Premium venue, gourmet catering, decorations
3. **Birthday Party Package** - ₱25,000
   - Party setup, entertainment, catering
4. **Corporate Event Package** - ₱75,000
   - Conference setup, AV equipment, refreshments
5. **Debut Package** - ₱60,000
   - Grand ballroom, photography, catering
6. **Catering Service** - ₱500/person
   - Per-person meal service
7. **Photography Service** - ₱15,000
   - Professional photography package
8. **Sound System** - ₱10,000
   - Audio equipment rental
9. **Room Service** - ₱200-1,000
   - In-room dining and services
10. **Laundry Service** - ₱150/item
11. **Airport Transfer** - ₱1,500
12. **Spa Services** - ₱2,000-5,000

### Room Types
- **Standard Room** - ₱2,500/night (2 guests)
- **Deluxe Room** - ₱4,000/night (2 guests)
- **Suite** - ₱7,000/night (4 guests)
- **Family Room** - ₱5,500/night (5 guests)
- **Presidential Suite** - ₱15,000/night (6 guests)

---

## 🛠️ Technical Stack

### Backend Framework
- **Laravel 11.x** - Modern PHP framework
  - Eloquent ORM for database operations
  - Blade templating engine
  - Multi-guard authentication system
  - Request validation
  - Middleware security
  - Session management
  - CSRF protection

### Database
- **PostgreSQL 16+**
  - Relational database management
  - ACID compliance
  - Complex queries and joins
  - JSON column support
  - Full-text search capabilities

### Frontend
- **Bootstrap 5.3.0**
  - Responsive grid system
  - Modern UI components
  - Mobile-first design
  - Utility classes
- **Bootstrap Icons 1.11.1**
  - Scalable vector icons
  - 2000+ icons library
- **Vanilla JavaScript**
  - Form validation
  - Dynamic interactions
  - AJAX requests

### Authentication & Security
- **Multi-Guard Authentication**
  - Separate guards: `admin`, `staff`, `web` (client)
  - Role-based access control
  - Session-based authentication
- **Security Features**
  - Password hashing (bcrypt)
  - CSRF token protection
  - XSS prevention
  - SQL injection protection
  - Middleware-based route protection

### Development Tools
- **Composer** - PHP dependency manager
- **NPM/Vite** - Frontend asset building
- **Git** - Version control
- **PHP 8.2+** - Server-side scripting

---

## 📁 Project Structure

### Root Directory
```
Zillion_Pavillion/
├── app/                    # Application core
├── bootstrap/              # Framework bootstrap
├── config/                 # Configuration files
├── database/               # Migrations, seeders, factories
├── public/                 # Public assets (CSS, JS, images)
├── resources/              # Views, raw assets
├── routes/                 # Application routes
├── storage/                # Logs, cache, uploads
├── tests/                  # Unit and feature tests
├── vendor/                 # Composer dependencies
├── .env                    # Environment configuration
├── artisan                 # CLI tool
├── composer.json           # PHP dependencies
├── package.json            # Node dependencies
└── vite.config.js          # Frontend build config
```

### Backend Structure (`app/`)

#### Models (`app/Models/`)
- **Admin.php** - Administrator model
  - Authentication guard configuration
  - Relationships to bookings
  - Status management
- **Staff.php** - Staff member model
  - Authentication guard configuration
  - Service request assignments
  - Active status tracking
- **Client.php** - Client model
  - Authentication guard configuration
  - Booking relationships
  - Service request relationships
- **Room.php** - Room model
  - Room rate relationships
  - Booking relationships
  - Availability methods
- **RoomRate.php** - Room pricing model
  - Dynamic rate calculations
  - Date range validations
- **Booking.php** - Booking model
  - Client relationships
  - Room relationships
  - Service relationships (many-to-many)
  - Status management
  - Payment tracking
- **Service.php** - Service model
  - Booking relationships
  - Pricing information
- **ServiceRequest.php** - Service request model
  - Client relationships
  - Booking relationships
  - Staff assignment
  - Status tracking

#### Controllers

##### Admin Controllers (`app/Http/Controllers/Admin/`)
- **AuthController.php** - Admin authentication
  - Login/logout
  - Session management
- **DashboardController.php** - Admin dashboard
  - Statistics aggregation
  - Recent activity
- **ClientController.php** - Client management
  - CRUD operations
  - Client search and filtering
- **StaffController.php** - Staff management
  - Create, read, update, delete staff
  - Account activation/deactivation
  - Position and department management
- **BookingController.php** - Booking management
  - Full CRUD operations
  - Status updates
  - Payment processing
- **RoomController.php** - Room management
  - Room CRUD operations
  - Room rate management
  - Availability tracking
- **ServiceController.php** - Service management
  - Service CRUD operations
  - Pricing updates
- **ServiceRequestController.php** - Service request management
  - View and manage all requests
  - Assignment to staff
  - Status updates

##### Staff Controllers (`app/Http/Controllers/Staff/`)
- **AuthController.php** - Staff authentication
- **DashboardController.php** - Staff dashboard
  - Today's statistics
  - Upcoming tasks
- **BookingController.php** - Booking operations
  - View bookings
  - Update status
  - Add notes
- **ServiceRequestController.php** - Service request handling
  - View assigned requests
  - Update progress
  - Mark as completed

##### Client Controllers (`app/Http/Controllers/`)
- **ClientAuthController.php** - Client authentication & registration
- **ClientDashboardController.php** - Client dashboard & bookings
  - Personal dashboard
  - Booking CRUD
  - Profile management
- **ClientRoomController.php** - Room browsing
  - Browse available rooms
  - Room details
  - Availability check
- **ClientServiceRequestController.php** - Service requests
  - Create requests
  - Track status
  - Cancel requests
- **QuickBookingController.php** - Public quick booking

#### Middleware (`app/Http/Middleware/`)
- **AdminMiddleware.php** - Protect admin routes
- **StaffMiddleware.php** - Protect staff routes
- **ClientMiddleware.php** - Protect client routes
- **Authenticate.php** - General authentication
- **RedirectIfAuthenticated.php** - Redirect authenticated users

### Frontend Structure (`resources/views/`)

#### Admin Views (`resources/views/admin/`)
```
admin/
├── layout.blade.php              # Admin master layout
├── login.blade.php               # Admin login page
├── dashboard.blade.php           # Admin dashboard
├── clients/
│   ├── index.blade.php          # Client list
│   ├── create.blade.php         # Create client
│   ├── edit.blade.php           # Edit client
│   └── show.blade.php           # Client details
├── staff/                        # ⭐ NEW
│   ├── index.blade.php          # Staff list
│   ├── create.blade.php         # Create staff account
│   ├── edit.blade.php           # Edit staff account
│   └── show.blade.php           # Staff details
├── bookings/
│   ├── index.blade.php          # Booking list
│   ├── create.blade.php         # Create booking
│   ├── edit.blade.php           # Edit booking
│   └── show.blade.php           # Booking details
├── rooms/
│   ├── index.blade.php          # Room list
│   ├── create.blade.php         # Add room
│   └── edit.blade.php           # Edit room & rates
├── services/
│   ├── index.blade.php          # Service list
│   ├── create.blade.php         # Add service
│   └── edit.blade.php           # Edit service
└── service-requests/
    ├── index.blade.php          # Request list
    ├── show.blade.php           # Request details
    └── edit.blade.php           # Update request
```

#### Staff Views (`resources/views/staff/`)
```
staff/
├── layout.blade.php              # Staff master layout
├── login.blade.php               # Staff login page
├── dashboard.blade.php           # Staff dashboard
├── bookings/
│   ├── index.blade.php          # Booking list
│   └── show.blade.php           # Booking details
└── service-requests/
    ├── index.blade.php          # Request list
    ├── show.blade.php           # Request details
    └── edit.blade.php           # Update request status
```

#### Client Views (`resources/views/client/`)
```
client/
├── layout.blade.php              # Client master layout
├── login.blade.php               # Client login page
├── register.blade.php            # Client registration
├── dashboard.blade.php           # Client dashboard
├── booking.blade.php             # Booking form
├── profile.blade.php             # Profile management
├── rooms/
│   ├── index.blade.php          # Browse rooms
│   └── show.blade.php           # Room details
└── service-requests/
    ├── index.blade.php          # My requests
    ├── create.blade.php         # Create request
    └── show.blade.php           # Request details
```

#### Public Views (`resources/views/`)
- **home.blade.php** - Homepage with quick booking

### Routes (`routes/web.php`)

#### Route Organization
```php
// Public routes
Route::get('/', HomeController)
Route::post('/quick-booking', QuickBookingController)

// Authentication routes
Route::get('/login', ClientAuthController@showLoginForm)
Route::post('/login', ClientAuthController@login)
Route::get('/register', ClientAuthController@showRegisterForm)
Route::post('/register', ClientAuthController@register)

// Admin routes (prefix: /admin)
Route::prefix('admin')->middleware(['admin'])->group(...)
  - Dashboard, Clients, Staff, Bookings, Rooms, Services

// Staff routes (prefix: /staff)
Route::prefix('staff')->middleware(['staff'])->group(...)
  - Dashboard, Bookings (view only), Service Requests

// Client routes (prefix: /client)
Route::prefix('client')->middleware(['client'])->group(...)
  - Dashboard, Bookings, Rooms, Service Requests, Profile
```

### Database (`database/`)

#### Migrations (`database/migrations/`)
- Migration files create database schema
- Ordered by timestamp
- Includes foreign key constraints
- Handles table relationships

#### Seeders (`database/seeders/`)
- **DatabaseSeeder.php** - Master seeder
- **StaffSeeder.php** - Sample staff accounts
- Populates initial data for testing

---

## 🔧 Configuration Files

### Environment Configuration (`.env`)
```env
# Application
APP_NAME="Zillion Pavillion"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=zillion_pavillion
DB_USERNAME=vince
DB_PASSWORD=426999

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_DRIVER=database
```

### Authentication Guards (`config/auth.php`)
```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'clients',  // Client authentication
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',   // Admin authentication
    ],
    'staff' => [
        'driver' => 'session',
        'provider' => 'staff',    // Staff authentication
    ],
],

'providers' => [
    'clients' => [
        'driver' => 'eloquent',
        'model' => App\Models\Client::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
    'staff' => [
        'driver' => 'eloquent',
        'model' => App\Models\Staff::class,
    ],
],
```

### Database Configuration (`config/database.php`)
```php
'pgsql' => [
    'driver' => 'pgsql',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '5432'),
    'database' => env('DB_DATABASE', 'zillion_pavillion'),
    'username' => env('DB_USERNAME', 'vince'),
    'password' => env('DB_PASSWORD', '426999'),
    'charset' => 'utf8',
    'prefix' => '',
    'schema' => 'public',
],
```

---

## 📱 User Interface Design

### Design Principles
- **Responsive Design**: Mobile-first approach, works on all devices
- **Intuitive Navigation**: Clear menu structure, breadcrumbs
- **Consistent Layout**: Uniform design across all panels
- **Color Coding**: Status badges, action buttons
- **Accessibility**: WCAG compliant, keyboard navigation

### Color Scheme
```css
Primary Color: #ff3b30 (Red)
Primary Dark: #e62e24
Sidebar Background: #2c3e50 (Dark Blue)
Sidebar Hover: #34495e
Success: #28a745 (Green)
Warning: #ffc107 (Yellow)
Danger: #dc3545 (Red)
Info: #17a2b8 (Cyan)
```

### Typography
- **Font Family**: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
- **Headings**: Bold, larger sizes
- **Body Text**: Regular weight, readable size
- **Monospace**: Code and technical data

### Components
- **Stat Cards**: Elevated cards with icons, hover effects
- **Tables**: Striped, hoverable rows, responsive
- **Forms**: Validated inputs, inline errors, help text
- **Buttons**: Color-coded by action (primary, secondary, danger)
- **Badges**: Status indicators (success, warning, danger, info)
- **Modals**: Confirmations, detailed views
- **Alerts**: Success messages, error notifications

---

## 🚦 Installation & Setup

### Prerequisites
```bash
- PHP >= 8.2
- PostgreSQL >= 16
- Composer
- Node.js & NPM
- Git
```

### Step-by-Step Installation

#### 1. Clone Repository
```bash
git clone https://github.com/FerosC101/Zillion_Pavillion.git
cd Zillion_Pavillion
```

#### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

#### 3. Configure Environment
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Configure Database
Edit `.env` file:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=zillion_pavillion
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### 5. Create Database
```sql
-- In PostgreSQL
CREATE DATABASE zillion_pavillion;
```

#### 6. Run Migrations
```bash
# Create all database tables
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

#### 7. Build Frontend Assets
```bash
# Development
npm run dev

# Production
npm run build
```

#### 8. Start Development Server
```bash
php artisan serve
```

#### 9. Access Application
```
Application: http://localhost:8000
Admin Panel: http://localhost:8000/admin/login
Staff Panel: http://localhost:8000/staff/login
Client Portal: http://localhost:8000/client/login
```

---

## 🔄 Workflow & Business Logic

### Booking Workflow

#### Client Booking Process
1. **Browse Rooms** → Select room type and view details
2. **Check Availability** → Enter dates, system checks availability
3. **Create Booking** → Fill booking form with guest details
4. **Submit Booking** → Booking created with "pending" status
5. **Wait for Confirmation** → Admin/Staff reviews booking
6. **Receive Confirmation** → Email notification sent
7. **Check-In** → Staff marks as "checked_in" on arrival
8. **Stay** → Guest can request services during stay
9. **Check-Out** → Staff marks as "completed"
10. **Payment** → Final payment processed

#### Booking Status Flow
```
pending → confirmed → checked_in → completed
   ↓
cancelled (can be cancelled anytime before checked_in)
```

### Service Request Workflow

#### Client Request Process
1. **Create Request** → Client submits service request
2. **Review** → Staff sees request in their dashboard
3. **Assign** → Request assigned to staff member
4. **In Progress** → Staff updates status to "in-progress"
5. **Complete** → Service fulfilled, marked as "completed"

#### Request Status Flow
```
pending → in-progress → completed
   ↓
cancelled (can be cancelled if still pending)
```

### Staff Management Workflow

#### Staff Account Lifecycle
1. **Creation** → Admin creates staff account with credentials
2. **Active** → Staff can log in and perform duties
3. **Update** → Admin can modify staff information
4. **Deactivate** → Admin can disable account (is_active = false)
5. **Reactivate** → Admin can re-enable account
6. **Delete** → Admin can permanently remove account

---

## 🎯 Role-Based Access Control (RBAC)

### Permission Matrix

| Feature | Admin | Staff | Client |
|---------|-------|-------|--------|
| **Dashboard Access** | ✅ Full | ✅ Limited | ✅ Personal |
| **View All Clients** | ✅ | ❌ | ❌ |
| **Create Client** | ✅ | ❌ | Self-register |
| **Edit Client** | ✅ | ❌ | Own profile |
| **Delete Client** | ✅ | ❌ | ❌ |
| **View All Staff** | ✅ | ❌ | ❌ |
| **Create Staff** | ✅ | ❌ | ❌ |
| **Edit Staff** | ✅ | ❌ | ❌ |
| **Delete Staff** | ✅ | ❌ | ❌ |
| **View All Bookings** | ✅ | ✅ | Own bookings |
| **Create Booking** | ✅ | ❌ | ✅ |
| **Edit Booking** | ✅ | ❌ | ❌ |
| **Update Booking Status** | ✅ | ✅ | ❌ |
| **Cancel Booking** | ✅ | ❌ | Own bookings |
| **Delete Booking** | ✅ | ❌ | ❌ |
| **View All Rooms** | ✅ | ✅ | ✅ |
| **Manage Rooms** | ✅ | ❌ | ❌ |
| **Manage Room Rates** | ✅ | ❌ | ❌ |
| **View All Services** | ✅ | ✅ | ✅ |
| **Manage Services** | ✅ | ❌ | ❌ |
| **View Service Requests** | ✅ All | ✅ All | Own requests |
| **Create Service Request** | ✅ | ❌ | ✅ |
| **Update Request Status** | ✅ | ✅ | ❌ |
| **Assign Requests** | ✅ | ❌ | ❌ |
| **View Reports** | ✅ | ❌ | ❌ |
| **Financial Data** | ✅ | ❌ | Own bookings |

---

## 🔒 Security Implementation

### Authentication Security
- **Password Hashing**: Bcrypt algorithm with cost factor 10
- **Session Security**: 
  - Secure session cookies
  - HttpOnly flag enabled
  - CSRF token validation
  - Session timeout (120 minutes)
- **Login Protection**:
  - Rate limiting on login attempts
  - Brute force protection
  - Account lockout after failed attempts

### Authorization
- **Middleware Protection**: All routes protected by appropriate middleware
- **Guard Separation**: Admin, Staff, and Client guards completely isolated
- **Active Status Check**: Inactive accounts cannot authenticate
- **Role Verification**: Each request verified against user role

### Data Protection
- **SQL Injection Prevention**: Eloquent ORM with parameterized queries
- **XSS Protection**: Blade template escaping by default
- **CSRF Protection**: Token validation on all POST/PUT/DELETE requests
- **Mass Assignment Protection**: Fillable/guarded properties on models
- **Input Validation**: Server-side validation on all forms
- **Sanitization**: HTML purification on user inputs

### Database Security
- **Encrypted Passwords**: Never stored in plain text
- **Prepared Statements**: All queries use prepared statements
- **Foreign Key Constraints**: Maintain referential integrity
- **Soft Deletes**: Important data preserved even after deletion

---

## 🧪 Testing & Quality Assurance

### Test Accounts

#### Admin Accounts
```
Username: vince
Password: 426999
Status: Active

Username: vince_alt
Password: 42699
Status: Active
```

#### Staff Accounts
```
Username: staff1
Password: password
Position: Front Desk Receptionist
Status: Active

Username: staff2
Password: password
Position: Concierge
Status: Active
```

#### Client Accounts
Clients can self-register through `/register`

### Testing Checklist

#### Admin Panel Testing
- [ ] Login with valid credentials
- [ ] Login with invalid credentials (should fail)
- [ ] View dashboard statistics
- [ ] Create new client
- [ ] Edit client information
- [ ] Delete client
- [ ] Create staff account
- [ ] Edit staff account
- [ ] Deactivate/activate staff
- [ ] Delete staff account
- [ ] View all bookings
- [ ] Create booking
- [ ] Edit booking
- [ ] Update booking status
- [ ] Delete booking
- [ ] Manage rooms
- [ ] Set room rates
- [ ] Manage services
- [ ] View service requests
- [ ] Assign service requests
- [ ] Logout

#### Staff Panel Testing
- [ ] Login with staff credentials
- [ ] View dashboard
- [ ] View all bookings
- [ ] Update booking status
- [ ] View booking details
- [ ] View service requests
- [ ] Update request status
- [ ] Mark request as completed
- [ ] Cannot access admin features
- [ ] Logout

#### Client Portal Testing
- [ ] Register new account
- [ ] Login with client credentials
- [ ] View dashboard
- [ ] Browse rooms
- [ ] View room details
- [ ] Create booking
- [ ] View my bookings
- [ ] Cancel booking
- [ ] Create service request
- [ ] View service requests
- [ ] Update profile
- [ ] Change password
- [ ] Logout

#### Security Testing
- [ ] Unauthorized access attempts blocked
- [ ] CSRF token validation
- [ ] XSS injection prevention
- [ ] SQL injection prevention
- [ ] Session expiration
- [ ] Password strength validation
- [ ] Rate limiting on forms

---

## 🐛 Troubleshooting & Common Issues

### Database Connection Issues

#### Problem: "Could not connect to database"
**Solution:**
```bash
# Check PostgreSQL service is running
# Windows: services.msc → PostgreSQL service
# Check .env database credentials
# Test connection:
psql -U vince -d zillion_pavillion
```

#### Problem: "Table not found"
**Solution:**
```bash
# Run migrations
php artisan migrate

# Fresh migration (WARNING: deletes all data)
php artisan migrate:fresh --seed
```

### Authentication Issues

#### Problem: "Session expired" errors
**Solution:**
```bash
# Clear cache and sessions
php artisan cache:clear
php artisan session:clear
php artisan config:clear
```

#### Problem: "Unauthenticated" after login
**Solution:**
- Check guard configuration in `config/auth.php`
- Verify middleware on routes
- Clear browser cookies
- Check session driver in `.env`

### Permission Issues

#### Problem: Staff accessing admin features
**Solution:**
- Verify middleware on routes
- Check guard in controller
- Ensure `AdminMiddleware` applied to admin routes

#### Problem: "403 Forbidden" errors
**Solution:**
- Check user role and permissions
- Verify is_active status
- Check middleware configuration

### View/UI Issues

#### Problem: Styles not loading
**Solution:**
```bash
# Rebuild assets
npm run build

# Clear view cache
php artisan view:clear
```

#### Problem: JavaScript errors
**Solution:**
- Check browser console
- Rebuild assets with `npm run dev`
- Check Bootstrap JS is loaded

### Performance Issues

#### Problem: Slow page loads
**Solution:**
```bash
# Enable caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer dump-autoload -o
```

---

## 📊 API Endpoints (Internal Routes)

### Admin Routes
```
GET    /admin/login                      → Login form
POST   /admin/login                      → Authenticate admin
POST   /admin/logout                     → Logout admin
GET    /admin/dashboard                  → Dashboard
GET    /admin/clients                    → List clients
POST   /admin/clients                    → Create client
GET    /admin/clients/{id}/edit          → Edit client form
PUT    /admin/clients/{id}               → Update client
DELETE /admin/clients/{id}               → Delete client
GET    /admin/staff                      → List staff ⭐
POST   /admin/staff                      → Create staff ⭐
GET    /admin/staff/{id}/edit            → Edit staff form ⭐
PUT    /admin/staff/{id}                 → Update staff ⭐
DELETE /admin/staff/{id}                 → Delete staff ⭐
GET    /admin/bookings                   → List bookings
GET    /admin/rooms                      → List rooms
GET    /admin/rooms/{id}/rates/create    → Create room rate
POST   /admin/rooms/{id}/rates           → Store room rate
DELETE /admin/rooms/{id}/rates/{rateId}  → Delete room rate
GET    /admin/services                   → List services
GET    /admin/service-requests           → List service requests
```

### Staff Routes
```
GET    /staff/login                      → Login form
POST   /staff/login                      → Authenticate staff
POST   /staff/logout                     → Logout staff
GET    /staff/dashboard                  → Dashboard
GET    /staff/bookings                   → List bookings (read-only)
GET    /staff/bookings/{id}              → View booking details
PATCH  /staff/bookings/{id}/status       → Update booking status
GET    /staff/service-requests           → List service requests
GET    /staff/service-requests/{id}      → View request details
PATCH  /staff/service-requests/{id}      → Update request status
```

### Client Routes
```
GET    /client/login                     → Login form
POST   /client/login                     → Authenticate client
GET    /register                         → Registration form
POST   /register                         → Create client account
POST   /client/logout                    → Logout client
GET    /client/dashboard                 → Dashboard
GET    /client/rooms                     → Browse rooms
GET    /client/rooms/{id}                → View room details
GET    /client/bookings                  → My bookings
POST   /client/bookings                  → Create booking
GET    /client/bookings/{id}             → View booking details
PATCH  /client/bookings/{id}/cancel      → Cancel booking
GET    /client/service-requests          → My service requests
POST   /client/service-requests          → Create service request
GET    /client/service-requests/{id}     → View request details
PATCH  /client/service-requests/{id}/cancel → Cancel request
GET    /client/profile                   → View profile
PATCH  /client/profile                   → Update profile
```

---

## 📈 Future Enhancements

### Planned Features
- [ ] **Payment Gateway Integration**: Online payment processing
- [ ] **Email Notifications**: Automated booking confirmations
- [ ] **SMS Notifications**: Real-time status updates
- [ ] **Calendar Integration**: Sync with Google Calendar
- [ ] **Advanced Reporting**: Excel/PDF export, charts
- [ ] **Inventory Management**: Track room amenities, supplies
- [ ] **Employee Scheduling**: Staff shift management
- [ ] **Customer Reviews**: Rating and feedback system
- [ ] **Loyalty Program**: Points and rewards for clients
- [ ] **Multi-language Support**: Internationalization
- [ ] **Mobile App**: Native iOS/Android applications
- [ ] **AI Chatbot**: 24/7 customer support
- [ ] **Revenue Management**: Dynamic pricing algorithms
- [ ] **POS Integration**: Point of sale for services
- [ ] **Housekeeping Module**: Room cleaning schedules
- [ ] **Maintenance Tracker**: Facility maintenance logs
- [ ] **Document Management**: Upload/store client documents
- [ ] **Advanced Analytics**: Occupancy rates, revenue forecasting
- [ ] **API Development**: RESTful API for third-party integration
- [ ] **Backup/Restore**: Automated database backups

### Technical Improvements
- [ ] Unit tests coverage (PHPUnit)
- [ ] Feature tests for critical workflows
- [ ] API rate limiting
- [ ] Redis caching layer
- [ ] Queue jobs for email/SMS
- [ ] Event sourcing for audit trail
- [ ] Real-time notifications (Pusher/WebSockets)
- [ ] Docker containerization
- [ ] CI/CD pipeline (GitHub Actions)
- [ ] Load balancing for high traffic
- [ ] Database replication
- [ ] CDN for static assets

---

## 📞 Support & Maintenance

### System Administrator
- **Name**: Vince
- **Email**: vince@zillionpavillion.com
- **Role**: System Administrator & Lead Developer

### Maintenance Schedule
- **Database Backups**: Daily at 2:00 AM
- **Log Rotation**: Weekly
- **Security Updates**: As needed
- **Feature Updates**: Monthly release cycle

### Error Logging
- **Location**: `storage/logs/laravel.log`
- **Level**: DEBUG (development), ERROR (production)
- **Monitoring**: Check logs daily for critical errors

### Database Backup
```bash
# Manual backup
pg_dump -U vince -d zillion_pavillion > backup.sql

# Restore from backup
psql -U vince -d zillion_pavillion < backup.sql
```

### Deployment Checklist
- [ ] Run tests: `php artisan test`
- [ ] Update dependencies: `composer update`
- [ ] Run migrations: `php artisan migrate`
- [ ] Clear caches: `php artisan cache:clear`
- [ ] Build assets: `npm run build`
- [ ] Set APP_ENV=production
- [ ] Set APP_DEBUG=false
- [ ] Configure proper permissions
- [ ] Test all critical workflows
- [ ] Monitor logs for 24 hours post-deployment

---

## 📚 Additional Resources

### Laravel Documentation
- [Laravel Official Docs](https://laravel.com/docs)
- [Laravel Authentication](https://laravel.com/docs/authentication)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
- [Laravel Blade Templates](https://laravel.com/docs/blade)

### Bootstrap Documentation
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3)
- [Bootstrap Icons](https://icons.getbootstrap.com)

### PostgreSQL Documentation
- [PostgreSQL Manual](https://www.postgresql.org/docs/)
- [PostgreSQL PHP Extension](https://www.php.net/manual/en/book.pgsql.php)

### Development Tools
- [Composer](https://getcomposer.org)
- [NPM](https://www.npmjs.com)
- [Git](https://git-scm.com)

---

## 📝 Change Log

### Version 1.2.0 (December 14, 2025) ⭐ LATEST
- ✨ Added comprehensive Staff Management System
  - Staff list with pagination (15 per page)
  - Create staff account with validation
  - Edit staff information
  - View staff details
  - Activate/deactivate staff accounts
  - Delete staff accounts
- ✨ Enhanced Admin Dashboard
  - Added staff statistics (total staff, active staff)
  - Added "Create New Staff Account" quick action
  - Reorganized dashboard with 4-column layout
- ✨ Updated Admin Navigation
  - Added Staff link to sidebar menu
  - Updated menu icons
- 📝 Created comprehensive system documentation

### Version 1.1.0 (December 10, 2025)
- ✨ Room Management System
  - Room inventory tracking
  - Dynamic room rate pricing
  - Seasonal rate management
- ✨ Service Request Module
  - Client service requests
  - Staff assignment
  - Status tracking
- 🐛 Bug fixes and performance improvements

### Version 1.0.0 (December 8, 2025)
- 🎉 Initial release
- ✨ Multi-guard authentication (Admin, Staff, Client)
- ✨ Admin Panel with full CRUD operations
- ✨ Staff Panel with limited access
- ✨ Client Portal with booking capabilities
- ✨ Booking management system
- ✨ Service catalog
- 📊 PostgreSQL database integration

---

## 🏆 Credits & Acknowledgments

### Development Team
- **Lead Developer**: Vince
- **Framework**: Laravel Team
- **UI Framework**: Bootstrap Team
- **Icons**: Bootstrap Icons

### Technologies Used
- Laravel 11
- PostgreSQL 16
- Bootstrap 5
- PHP 8.2
- Blade Templates
- Composer
- NPM

### Special Thanks
- Laravel community for excellent documentation
- Stack Overflow community for solutions
- GitHub for version control and collaboration

---

## 📄 License

This project is proprietary software developed for Zillion Pavillion Hotel & Event Management.
All rights reserved © 2025 Zillion Pavillion

**Unauthorized copying, distribution, or modification of this software is strictly prohibited.**

---

## ✅ System Status

**Current Version**: 1.2.0  
**Status**: ✅ Production Ready  
**Last Updated**: December 14, 2025  
**Database**: ✅ PostgreSQL 16 Connected  
**PHP Version**: ✅ 8.2  
**Laravel Version**: ✅ 11.x  

---

*For technical support or questions, please contact the system administrator.*

**End of Documentation**


