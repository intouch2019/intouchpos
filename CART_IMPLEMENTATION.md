# Persistent Cart Implementation

This implementation adds persistent cart functionality to the DreamsPOS system. Cart items are now saved to the database and will persist across browser sessions and page refreshes.

## Setup Instructions

1. **Create Cart Table**: Run the setup script to create the cart table
   ```
   Visit: http://localhost/dreampos/dreampos/php/template/setup_cart.php
   ```

2. **Database Schema**: The cart table includes:
   - `id` - Primary key
   - `user_id` - Foreign key to users table
   - `product_id` - Foreign key to products table  
   - `quantity` - Item quantity
   - `created_at` - Timestamp when item was added
   - `updated_at` - Timestamp when item was last updated

## Features

### ✅ Persistent Storage
- Cart items are saved to database
- Cart persists across browser sessions
- Cart survives page refreshes

### ✅ User-Specific Carts
- Each user has their own cart
- Cart items are isolated per user

### ✅ Stock Validation
- Prevents adding more items than available stock
- Real-time stock checking

### ✅ Automatic Cart Management
- Cart is automatically cleared after successful order placement
- Duplicate items are merged (quantities added together)

## API Endpoints

The cart functionality uses `cart_api.php` with the following actions:

- `add` - Add item to cart
- `update` - Update item quantity
- `remove` - Remove item from cart
- `clear` - Clear entire cart
- `get` - Retrieve cart contents

## JavaScript Functions

Updated POS JavaScript functions:
- `addToCart()` - Now saves to database
- `removeFromCart()` - Now removes from database
- `updateCartQuantity()` - Updates database
- `clearCart()` - Clears database cart
- `loadCart()` - Loads cart from database

## Files Modified/Added

### New Files:
- `create_cart_table.sql` - Cart table schema
- `setup_cart.php` - Setup script
- `src/cart_api.php` - Cart API endpoints
- `CART_IMPLEMENTATION.md` - This documentation

### Modified Files:
- `src/pos.php` - Updated JavaScript for persistent cart
- `src/process_order.php` - Added cart clearing after order

## Usage

1. Add products to cart - they're automatically saved
2. Refresh the page - cart items remain
3. Close browser and reopen - cart items persist
4. Place an order - cart is automatically cleared
5. Multiple users can have separate carts simultaneously

## Benefits

- **Better User Experience**: No lost cart items on refresh
- **Multi-Session Support**: Users can continue shopping across sessions
- **Data Integrity**: Cart state is preserved in database
- **Scalability**: Supports multiple concurrent users