<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .product { border: 1px solid #ddd; padding: 10px; margin: 10px; display: inline-block; }
        .cart { border: 2px solid #007bff; padding: 20px; margin: 20px 0; }
        .cart-item { border: 1px solid #eee; padding: 10px; margin: 5px 0; }
        button { padding: 5px 10px; margin: 2px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Cart Functionality Test</h1>
    
    <div class="products">
        <h2>Products</h2>
        <div class="product">
            <h3>iPhone 14</h3>
            <p>$15800.00</p>
            <button onclick="addToCart(1, 'iPhone 14', 15800.00)">Add to Cart</button>
        </div>
        <div class="product">
            <h3>Samsung Galaxy S23</h3>
            <p>$12500.00</p>
            <button onclick="addToCart(2, 'Samsung Galaxy S23', 12500.00)">Add to Cart</button>
        </div>
        <div class="product">
            <h3>Nike Air Max</h3>
            <p>$8500.00</p>
            <button onclick="addToCart(3, 'Nike Air Max', 8500.00)">Add to Cart</button>
        </div>
    </div>
    
    <div class="cart">
        <h2>Cart</h2>
        <div id="cartDisplay">
            <p>No items in cart</p>
        </div>
        <div id="cartTotal">
            <strong>Total: $0.00</strong>
        </div>
        <button onclick="clearCart()">Clear Cart</button>
    </div>
    
    <script>
        // Global cart variable
        let cart = [];
        
        // Function to add product to cart
        function addToCart(productId, productName, price) {
            const existingItem = cart.find(item => item.id === productId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: price,
                    quantity: 1
                });
            }
            updateCartDisplay();
        }
        
        // Function to update cart display
        function updateCartDisplay() {
            const cartDisplay = document.getElementById('cartDisplay');
            const cartTotal = document.getElementById('cartTotal');
            
            if (cart.length === 0) {
                cartDisplay.innerHTML = '<p>No items in cart</p>';
                cartTotal.innerHTML = '<strong>Total: $0.00</strong>';
                return;
            }
            
            let cartHtml = '';
            let total = 0;
            
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                cartHtml += `
                    <div class="cart-item">
                        <h4>${item.name}</h4>
                        <p>Price: $${item.price.toFixed(2)} x ${item.quantity} = $${itemTotal.toFixed(2)}</p>
                        <button onclick="removeFromCart(${index})">Remove</button>
                        <button onclick="increaseQuantity(${index})">+</button>
                        <button onclick="decreaseQuantity(${index})">-</button>
                    </div>
                `;
            });
            
            cartDisplay.innerHTML = cartHtml;
            cartTotal.innerHTML = `<strong>Total: $${total.toFixed(2)}</strong>`;
        }
        
        // Function to remove item from cart
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartDisplay();
        }
        
        // Function to increase quantity
        function increaseQuantity(index) {
            if (cart[index]) {
                cart[index].quantity += 1;
                updateCartDisplay();
            }
        }
        
        // Function to decrease quantity
        function decreaseQuantity(index) {
            if (cart[index] && cart[index].quantity > 1) {
                cart[index].quantity -= 1;
                updateCartDisplay();
            } else if (cart[index] && cart[index].quantity === 1) {
                removeFromCart(index);
            }
        }
        
        // Function to clear cart
        function clearCart() {
            cart = [];
            updateCartDisplay();
        }
        
        // Initialize cart display
        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
        });
    </script>
</body>
</html> 