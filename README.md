# DreamsPOS - Dynamic PHP POS System

A comprehensive Point of Sale (POS) system built with PHP, MySQL, and Bootstrap that provides dynamic functionality for managing sales, inventory, and customers.

## Features

### 🔐 Authentication System
- Secure user login with password hashing
- Session management
- Role-based access control (Admin, Manager, Cashier)
- Remember me functionality

### 🛒 Dynamic POS Interface
- Real-time product search and filtering
- Category-based product organization
- Shopping cart functionality
- Dynamic product display from database
- Stock level warnings

### 📊 Dashboard
- Real-time statistics
- Today's sales and orders
- Product and customer counts
- User-friendly interface

### 🗄️ Database Management
- Users table for authentication
- Products table with categories
- Customers management
- Orders and order items tracking
- Complete sales history

## Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

### Step 1: Database Configuration
1. Open `partials/config.php`
2. Update the database credentials:
   ```php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'your_username');
   define('DB_PASSWORD', 'your_password');
   define('DB_NAME', ' dreampos_db');
   ```

### Step 2: Run Setup
1. Navigate to the template directory
2. Visit `setup.php` in your browser
3. The setup script will:
   - Create the database if it doesn't exist
   - Create all necessary tables
   - Insert sample data
   - Allow you to create an admin user

### Step 3: Access the System
1. Go to `src/signin.php`
2. Login with your admin credentials
3. Start using the POS system!

## Default Login Credentials
- **Email**: admin@dreampos.com
- **Password**: password
- **Role**: Administrator

## Database Schema

### Users Table
- User authentication and role management
- Supports multiple user roles (admin, manager, cashier)

### Categories Table
- Product categorization
- Supports image associations

### Products Table
- Product inventory management
- Price, stock, and category tracking
- SKU and barcode support

### Customers Table
- Customer information management
- Contact details and history

### Orders Table
- Sales transaction tracking
- Multiple payment methods
- Order status management

### Order Items Table
- Individual line items for orders
- Quantity and pricing details

## Key Features Explained

### Dynamic Product Loading
- Products are loaded from the database in real-time
- Category filtering works without page refresh
- Search functionality filters products instantly

### Shopping Cart
- Add/remove products dynamically
- Quantity management
- Real-time total calculation
- Cart persistence during session

### User Authentication
- Secure password hashing using PHP's password_hash()
- Session-based authentication
- Automatic redirect for unauthorized access
- Remember me functionality

### Responsive Design
- Bootstrap-based responsive layout
- Works on desktop, tablet, and mobile devices
- Modern UI with intuitive navigation

## File Structure

```
php/template/
├── auth/
│   ├── auth_middleware.php     # Authentication functions
│   ├── login_handler.php       # Login processing
│   └── logout.php              # Logout handling
├── partials/
│   ├── config.php              # Database configuration
│   └── ...                     # Other template files
├── src/
│   ├── signin.php              # Login page
│   ├── pos.php                 # POS interface
│   ├── dashboard.php           # Dashboard
│   └── ...                     # Other pages
├── database_schema.sql         # Database structure
├── setup.php                   # Installation script
└── README.md                   # This file
```

## Security Features

- SQL injection prevention using prepared statements
- XSS protection with htmlspecialchars()
- Secure password hashing
- Session management
- Input validation and sanitization

## Customization

### Adding New Products
1. Access the admin panel
2. Navigate to Products section
3. Add new products with images, prices, and categories

### Modifying Categories
1. Edit the categories table in the database
2. Update category images in assets/img/products/
3. Refresh the POS interface

### Customizing POS Interface
1. Modify `src/pos.php` for layout changes
2. Update JavaScript functions in the same file
3. Customize CSS in assets/css/ for styling

## Support

For technical support or feature requests, please refer to the documentation or contact the development team.

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---

**Note**: This is a dynamic version of the DreamsPOS template with full database integration and authentication system. Make sure to backup your database before making any changes. 