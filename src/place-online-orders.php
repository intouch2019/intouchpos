<?php
require_once __DIR__ . '/../partials/config.php';

// Fetch categories
$categories = mysqli_query($link, "SELECT * FROM categories WHERE is_active = 1");

// Fetch products
//$products = mysqli_query($link, "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_active = 1");
$products = mysqli_query($link, "
    SELECT 
        p.*, 
        c.name AS category_name,
        COALESCE(SUM(pb.stock_quantity), 0) AS total_stock
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN product_batches pb ON pb.product_id = p.id AND (pb.expiry_date >= CURDATE() OR pb.expiry_date IS NULL)
    WHERE p.is_active = 1
    GROUP BY p.id
");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Online Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background:#f9fafb; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .navbar { box-shadow: 0 3px 10px rgba(0,0,0,0.08); }
        .btn-primary { background:#0069d9; border:none; border-radius:25px; padding:6px 16px; font-size:14px; }
        .btn-primary:hover { background:#0053b8; }
        .qty-control { display:flex; align-items:center; justify-content:center; gap:6px; margin-top:6px; }
        .qty-input { width:40px; text-align:center; border:none; font-weight:600; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">🛍️ Place Online Order</a>
            <button class="btn btn-warning fw-bold" id="toggleCart">
                🛒 Cart (<span id="cartCount">0</span>)
            </button>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="mb-2 category-wrapper">
            <h5 class="fw-bold mb-2" style="font-size: 18px;">
                <i class="bi bi-tags-fill text-primary"></i> Categories
            </h5>

            <!-- Categories -->
            <div class="category-scroll" id="categoryFilter">
                <button class="btn btn-sm btn-outline-primary active" data-category="all">All</button>
                <?php while($c = mysqli_fetch_assoc($categories)): ?>
                    <button class="btn btn-sm btn-outline-primary" 
                    data-category="<?= (int)$c['id']; ?>">
                    <?= htmlspecialchars($c['name']); ?>
                </button>
            <?php endwhile; ?>
        </div>

    </div>
</div>

<!-- Products -->
<div class="container my-5">
    <h4 class="mb-4 fw-bold">✨ Featured Products</h4>
    <div class="row g-4">
        <?php while($p = mysqli_fetch_assoc($products)): ?>
            <?php 
            //$inStock = !empty($p['stock_quantity']) && $p['stock_quantity'] > 0;
            $inStock = $p['total_stock'] > 0;
            $img = !empty($p['image']) ? "assets/img/products/{$p['image']}" : "assets/img/products/images(1).jpg";
            ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 product-item" data-category="<?= (int)$p['category_id']; ?>">
                <div class="card product-card h-100 shadow position-relative">

                    <!-- Stock Ribbon -->
                    <div class="ribbon <?= $inStock ? 'bg-success' : 'bg-danger'; ?>">
                        <?= $inStock ? 'In Stock' : 'Out of Stock'; ?>
                    </div>

                    <!-- Product Image -->
                    <div class="product-img-wrapper">
                        <img src="<?= htmlspecialchars($img); ?>" class="product-img" alt="<?= htmlspecialchars($p['name']); ?>">
                    </div>

                    <div class="card-body d-flex flex-column text-center">
                        <span class="badge-category mb-2"><?= htmlspecialchars($p['category_name']); ?></span>
                        <h6 class="product-name mb-2"><?= htmlspecialchars($p['name']); ?></h6>
                        <p class="product-price mb-3">₹<?= number_format($p['price'], 2); ?></p>
                        <!-- <p class="product-stock text-muted mb-3">Stock: <?= (int)$p['total_stock']; ?></p> -->

                        <!-- Add to Cart / Disabled -->
                        <div id="product-actions-<?= (int)$p['id']; ?>">
                            <?php if($inStock): ?>
                                <button class="btn btn-primary addToCart w-100" 
                                data-id="<?= (int)$p['id']; ?>" 
                                data-name="<?= htmlspecialchars($p['name']); ?>" 
                                data-price="<?= (float)$p['price']; ?>">
                                ➕ Add to Cart
                            </button>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>
                                    🚫 Not Available
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Cart Sidebar -->
<div id="cartSidebar" class="cart-sidebar shadow-lg">
    <!-- Header -->
    <div class="cart-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">🛒 My Cart</h5>
        <button class="btn-close" onclick="toggleCart()" aria-label="Close"></button>
    </div>

    <!-- Items -->
    <div id="cartItems" class="cart-items mt-3"></div>

    <!-- Footer -->
    <div class="cart-footer mt-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-semibold">Total:</span>
            <span class="fw-bold text-success">₹<span id="cartTotal">0.00</span></span>
        </div>
        <button class="btn btn-success w-100 fw-bold mb-2" data-bs-toggle="modal" data-bs-target="#checkoutModal">
            ✅ Checkout
        </button>
        <button class="btn btn-outline-danger w-100 fw-bold" onclick="toggleCart()">❌ Close</button>
    </div>
</div>

<!-- Checkout Modal (same as your code) -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="orderForm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-semibold">👤 Customer Details</h6>
                    <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
                    <input type="text" name="phone" id="phoneInput" class="form-control mb-2" placeholder="Phone" required>
                    <div id="addressList"></div>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                    <textarea name="address" class="form-control mb-2" placeholder="Full Address" required></textarea>
                    <div class="row">
                        <div class="col-md-4"><input type="text" name="city" class="form-control mb-2" placeholder="City" required></div>
                        <div class="col-md-4"><input type="text" name="state" class="form-control mb-2" placeholder="State" required></div>
                        <div class="col-md-4"><input type="text" name="pincode" class="form-control mb-2" placeholder="Pincode" required></div>
                    </div>

                    <h6 class="fw-semibold mt-3">💳 Payment</h6>
                    <select name="payment_method" class="form-control mb-2">
                        <option value="COD">Cash on Delivery</option>
                        <option value="Online">Online Payment</option>
                    </select>
                    <input type="hidden" name="channel" value="website">
                    <input type="hidden" id="cartData" name="cartData">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">✅ Place Order</button>
                </div>
            </form>
            <div id="result" class="p-3"></div>
        </div>
    </div>
</div>
<div id="floatingCart" onclick="toggleCart()">
    🛒 <span id="cartCountBadge">0</span>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

    let phoneInput = document.getElementById('phoneInput');
    let addressListDiv = document.getElementById('addressList');

    phoneInput.addEventListener('input', function () {
        let phone = this.value.trim();

    // Always clear old address list when typing
    addressListDiv.innerHTML = "";

    if (phone.length >= 8) {
        fetch('get-customer.php?phone=' + phone)
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                let c = data.data;

                    // Fill basic details
                    document.querySelector('[name="name"]').value = c.name || '';
                    document.querySelector('[name="email"]').value = c.email || '';

                    if (c.addresses && c.addresses.length > 0) {
                        let html = `<h6 class="fw-semibold mb-3" style="font-size:13px;">📍 Select Saved Address</h6><div class="row g-3">`;

                        c.addresses.forEach(addr => {
                            html += `
                            <div class="col-md-6">
                            <div class="card address-card shadow-sm border rounded p-3 h-100">
                            <div class="form-check d-flex align-items-start">
                            <input class="form-check-input me-2" type="radio" 
                            name="address_id" 
                            value="${addr.id}" 
                            id="addr${addr.id}"
                            data-address='${JSON.stringify(addr)}'
                            ${addr.is_default == 1 ? 'checked' : ''}>
                            <label class="form-check-label w-100" for="addr${addr.id}">
                            <div class="fw-semibold" style="font-size:13px;">${addr.address}</div>
                            <small class="text-muted" style="font-size:12px;">${addr.city}, ${addr.state} - ${addr.pincode}</small>
                            ${addr.is_default == 1 ? '<div><span class="badge bg-success mt-2" style="font-size:10px;">Default</span></div>' : ''}
                            </label>
                            </div>
                            </div>
                            </div>`;
                        });

                        html += `</div>`;
                        addressListDiv.innerHTML = html;

                        // Attach event listeners to auto-fill form when address is selected
                        document.querySelectorAll('[name="address_id"]').forEach(radio => {
                            radio.addEventListener('change', function () {
                                let selectedAddr = JSON.parse(this.getAttribute('data-address'));

                                document.querySelector('[name="address"]').value = selectedAddr.address || '';
                                document.querySelector('[name="city"]').value = selectedAddr.city || '';
                                document.querySelector('[name="state"]').value = selectedAddr.state || '';
                                document.querySelector('[name="pincode"]').value = selectedAddr.pincode || '';
                                document.querySelector('[name="email"]').value = c.email || '';
                            });
                        });

                        // Auto-fill using default address (if any)
                        let defaultRadio = document.querySelector('[name="address_id"]:checked');
                        if (defaultRadio) {
                            defaultRadio.dispatchEvent(new Event('change'));
                        }

                        // If user edits any address field → deselect saved address
                        ["address", "city", "state", "pincode"].forEach(field => {
                            document.querySelector(`[name="${field}"]`).addEventListener("input", function () {
                                let selected = document.querySelector('[name="address_id"]:checked');
                                if (selected) {
                                    selected.checked = false;
                                }
                            });
                        });
                    }
                } else {
                    // clear details if not found
                    clearAllFields();
                }
            });
    } else {
        clearAllFields();
    }
});

// Helper to clear fields
function clearAllFields() {
    ["email", "address", "city", "state", "pincode"].forEach(f => {
        document.querySelector(`[name="${f}"]`).value = '';
    });
}

// document.getElementById('phoneInput').addEventListener('blur', function() {
//     let phone = this.value.trim();
//     if (phone.length >= 8) {
//         fetch('get-customer.php?phone=' + phone)
//         .then(res => res.json())
//         .then(data => {
//             if (data.status === 'success') {
//                 let c = data.data;
//                 document.querySelector('[name="name"]').value = c.name || '';
//                 document.querySelector('[name="email"]').value = c.email || '';

//                 let addressListDiv = document.getElementById('addressList');
//                 addressListDiv.innerHTML = "";

//                 if (c.addresses && c.addresses.length > 0) {
//                     let html = `<h6 class="fw-semibold mb-3" style="font-size:13px;">📍 Select Saved Address</h6><div class="row g-3">`;
//                     c.addresses.forEach(addr => {
//                         html += `
//                           <div class="col-md-6">
//                             <div class="card address-card shadow-sm border rounded p-3 h-100">
//                               <div class="form-check d-flex align-items-start">
//                                 <input class="form-check-input me-2" type="radio" name="address_id" value="${addr.id}" id="addr${addr.id}">
//                                 <label class="form-check-label w-100" for="addr${addr.id}">
//                                   <div class="fw-semibold" style="font-size:13px;">${addr.address}</div>
//                                   <small class="text-muted" style="font-size:12px;">${addr.city}, ${addr.state} - ${addr.pincode}</small>
//                                   ${addr.is_default == 1 ? '<div><span class="badge bg-success mt-2" style="font-size:10px;">Default</span></div>' : ''}
//                                 </label>
//                               </div>
//                             </div>
//                           </div>`;
//                     });
//                     html += `</div>`;
//                     addressListDiv.innerHTML = html;

//                     let addressEdited = false;

//                     // When address selected → autofill form
//                     document.querySelectorAll('input[name="address_id"]').forEach(radio => {
//                         radio.addEventListener('change', function() {
//                             if (!addressEdited) { // only autofill if not edited
//                                 let selected = c.addresses.find(a => a.id == this.value);
//                                 if (selected) {
//                                     document.querySelector('[name="address"]').value = selected.address || '';
//                                     document.querySelector('[name="city"]').value = selected.city || '';
//                                     document.querySelector('[name="state"]').value = selected.state || '';
//                                     document.querySelector('[name="pincode"]').value = selected.pincode || '';
//                                 }
//                             }
//                         });
//                     });

//                     // If customer edits any field manually → deselect radio
//                     ['address','city','state','pincode'].forEach(field => {
//                         document.querySelector(`[name="${field}"]`).addEventListener('input', function() {
//                             addressEdited = true;
//                             let selectedRadio = document.querySelector('input[name="address_id"]:checked');
//                             if (selectedRadio) selectedRadio.checked = false;
//                         });
//                     });
//                 }
//             }
//         });
//     }
// });

            // Category filter
            document.querySelectorAll('#categoryFilter button').forEach(btn=>{
                btn.addEventListener('click', ()=>{
                    // remove active class
                    document.querySelectorAll('#categoryFilter button').forEach(b=>b.classList.remove('active'));
                    btn.classList.add('active');

                    let category = btn.dataset.category;
                    document.querySelectorAll('.product-item').forEach(item=>{
                        if(category === 'all' || item.dataset.category === category){
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            let cart = [];

        // Add to cart
        document.querySelectorAll('.addToCart').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                let id = btn.dataset.id;
                let name = btn.dataset.name;
                let price = parseFloat(btn.dataset.price);

                // get product image
                let imgSrc = btn.closest('.product-card').querySelector('img').getAttribute('src');

                // check if item already in cart
                let item = cart.find(p=>p.id == id);
                if(item){
                    item.qty += 1; 
                } else { 
                    cart.push({id, name, price, qty:1, image: imgSrc}); 

                    // disable Add to Cart button
                    btn.disabled = true;
                    btn.innerText = "✔ Added";
                    btn.classList.remove("btn-primary");
                    btn.classList.add("btn-success");
                }

                renderCart();
                toggleCart(); // open cart after adding
            });
        });

        // Render cart
        function renderCart(){
            let cartItemsDiv = document.getElementById('cartItems');
            cartItemsDiv.innerHTML = '';
            let total = 0;

            cart.forEach((item,i)=>{
                total += item.qty * item.price;
                cartItemsDiv.innerHTML += `
                <div class="cart-item">
                <img src="${item.image}" alt="">
                <div class="cart-item-info">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-price">₹${item.price} x ${item.qty}</div>
                </div>
                <div class="cart-qty">
                <button onclick="updateQty(${i},-1)">−</button>
                <span>${item.qty}</span>
                <button onclick="updateQty(${i},1)">+</button>
                </div>
                <button class="remove-btn" onclick="removeFromCart(${i})"><i class="bi bi-trash-fill text-danger"></i></button>
                </div>`;
            });

            // Update totals
            document.getElementById('cartCount').innerText = cart.length;
            document.getElementById('cartTotal').innerText = total.toFixed(2);

            // Update floating cart badge
            document.getElementById('cartCountBadge').innerText = cart.length;
        }

        // Update qty in cart
        function updateQty(i,delta){
            cart[i].qty += delta;
            if(cart[i].qty <= 0){
                removeFromCart(i);
            }
            renderCart();
        }

        // Remove item
        function removeFromCart(i){ 
            let removed = cart.splice(i,1)[0];
            renderCart();

            // re-enable Add to Cart button for that product
            let btn = document.querySelector(`.addToCart[data-id="${removed.id}"]`);
            if(btn){
                btn.disabled = false;
                btn.innerText = "➕ Add to Cart";
                btn.classList.remove("btn-success");
                btn.classList.add("btn-primary");
            }
        }

        // Submit order
        document.getElementById('orderForm').addEventListener('submit', function(e){
            e.preventDefault();
            document.getElementById('cartData').value = JSON.stringify(cart);

            let formData = new FormData(this);
            fetch('place-online-orders-save.php', { method:'POST', body:formData })
            .then(res=>res.json())
            .then(data=>{
                if(data.status == 'success'){ 
                    // Clear cart
                    cart.forEach(p=>{
                        let btn = document.querySelector(`.addToCart[data-id="${p.id}"]`);
                        if(btn){
                            btn.disabled = false;
                            btn.innerText = "➕ Add to Cart";
                            btn.classList.remove("btn-success");
                            btn.classList.add("btn-primary");
                        }
                    });
                    cart = []; 
                    renderCart(); 
                    toggleCart();

                    // Close the modal
                    let checkoutModalEl = document.getElementById('checkoutModal');
                    let modal = bootstrap.Modal.getInstance(checkoutModalEl);
                    if(modal) modal.hide();

                    // Reset the form
                    document.getElementById('orderForm').reset();

                    // Show success dialog
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Placed!',
                        text: `Your order number is ${data.order_number}`,
                        confirmButtonColor: '#28a745'
                    });
                } else {
                    // Show error
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        });


                // Update floating cart badge
                document.getElementById('cartCountBadge').innerText = cart.length;

                if(cart.length === 1) {
            toggleCart(); // auto open on first item
        }

        let cartBtn = document.getElementById('floatingCart');
        cartBtn.classList.add('pulse');
        setTimeout(() => cartBtn.classList.remove('pulse'), 600);

    </script>
    <style>

        .category-wrapper {
          position: relative;
      }

      .scroll-arrow {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          background: #fff;
          border: 1px solid #ddd;
          border-radius: 50%;
          width: 32px;
          height: 32px;
          display: flex;
          align-items: center;
          justify-content: center;
          cursor: pointer;
          z-index: 5;
          box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      }

      .scroll-arrow.left {
          left: -12px;
      }
      .scroll-arrow.right {
          right: -12px;
      }

      .scroll-arrow:hover {
          background: #0d6efd;
          color: #fff;
      }

      .badge.bg-success {
        background-color: #28a745 !important;
        font-size: 12px;
        padding: 4px 8px;
    }
    .badge.bg-danger {
        background-color: #dc3545 !important;
        font-size: 12px;
        padding: 4px 8px;
    }

    /* Category Filter Wrapper */
    .category-scroll {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      gap: 8px;
      padding-bottom: 6px;
      scrollbar-width: none; /* Firefox */
  }
  .category-scroll::-webkit-scrollbar {
      display: none; /* Chrome, Safari */
  }

  /* Buttons */
  #categoryFilter .btn {
      border-radius: 20px;
      flex-shrink: 0;   /* prevents button from shrinking */
      white-space: nowrap;
      font-size: 13px;
      padding: 5px 14px;
      transition: 0.3s ease-in-out;
  }
  #categoryFilter .btn:hover {
      background-color: #0d6efd;
      color: #fff;
  }
  #categoryFilter .btn.active {
      background-color: #0d6efd;
      color: #fff;
      font-weight: 600;
  }

  /* On larger screens, keep them inline & centered */
  @media(min-width: 768px){
      .category-scroll {
        justify-content: flex-start;
        overflow-x: visible;
        flex-wrap: wrap;
    }
}

/* Pulse animation */
@keyframes cartPulse {
  0% { transform: scale(1); }
  25% { transform: scale(1.2); }
  50% { transform: scale(0.9); }
  75% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

#floatingCart.pulse {
  animation: cartPulse 0.6s ease;
}

/* ===== Product Card ===== */
.product-card {
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.4s ease;
    cursor: pointer;
    background: #fff;
}
.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* Product Image */
.product-img-wrapper {
    overflow: hidden;
    border-radius: 15px;
}
.product-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.product-card:hover .product-img {
    transform: scale(1.1);
}

/* Stock Ribbon */
.ribbon {
    position: absolute;
    top: 12px;
    left: -8px;
    padding: 6px 12px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    transform: rotate(-45deg);
    z-index: 10;
    box-shadow: 0 2px 5px rgba(0,0,0,0.25);
    text-align: center;
}

/* Ribbon Gradients */
.bg-success { background: linear-gradient(45deg, #28a745, #82e0aa); }
.bg-danger { background: linear-gradient(45deg, #dc3545, #f1948a); }

/* Badge Category */
.badge-category {
    font-size: 11px;
    font-weight: 500;
    background: #eef2f7;
    color: #555;
    padding: 4px 12px;
    border-radius: 15px;
    display: inline-block;
}

/* Product Name & Price */
.product-name { font-size: 14.5px; color: #222; min-height: 42px; }
.product-price { font-size: 16px; color: #28a745; font-weight: 700; }

/* Buttons */
.addToCart {
    font-size: 14px;
    padding: 6px 12px;
    border-radius: 25px;
    transition: all 0.3s ease;
}
.addToCart:hover { background-color: #0056b3; }

/* Responsive */
@media(max-width: 992px){ .product-img { height: 160px; } }
@media(max-width: 768px){ 
    .product-img { height: 140px; }
    .ribbon { font-size: 11px; padding: 4px 10px; }
    .badge-category { font-size: 10px; padding: 3px 10px; }
}
@media(max-width: 576px){
    .product-img { height: 130px; }
    .ribbon { font-size: 10px; padding: 3px 8px; }
    .badge-category { font-size: 9px; padding: 2px 8px; }
    .product-name { font-size: 13px; }
    .product-price { font-size: 15px; }
    .addToCart { font-size: 13px; padding: 5px 10px; }
}

.category-scroll::-webkit-scrollbar { display:none; }
.category-scroll .btn { border-radius:20px; transition:0.3s; }
.category-scroll .btn:hover, .category-scroll .btn.active { background:#0d6efd; color:#fff; font-weight:600; }

/* Floating Cart */
#floatingCart {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(135deg,#4caf50,#2e7d32);
    color:#fff;
    font-size:20px;
    font-weight:bold;
    padding:14px 20px;
    border-radius:50px;
    box-shadow:0 6px 20px rgba(0,0,0,0.2);
    cursor:pointer;
    display:flex;
    align-items:center;
    gap:10px;
    z-index:1100;
    transition:all 0.3s ease;
}
#floatingCart:hover { transform:scale(1.08); box-shadow:0 8px 24px rgba(0,0,0,0.25); }
#cartCountBadge { background:#ff3d00; color:#fff; font-weight:600; padding:4px 10px; border-radius:50%; min-width:28px; text-align:center; }

.cart-sidebar {
    background: #fff;
    border-left: 1px solid #ddd;
    height: 100vh;
    position: fixed;
    top: 0;
    right: 0;
    width: 380px;
    max-width: 100%;
    z-index: 1050;
    overflow-y: auto;
    padding: 20px;
    transform: translateX(100%);
    transition: transform .35s ease-in-out;
    border-radius: 15px 0 0 15px;
    display: flex;
    flex-direction: column;
}
.cart-sidebar.show { transform: translateX(0); }

/* Mobile: make cart slide from bottom full screen */
@media(max-width: 576px) {
    .cart-sidebar {
        width: 100%;
        height: 90vh;
        bottom: 0;
        top: auto;
        right: 0;
        left: 0;
        transform: translateY(100%);
        border-radius: 20px 20px 0 0;
        border-left: none;
        border-top: 3px solid #ddd;
    }
    .cart-sidebar.show {
        transform: translateY(0);
    }
}

.cart-header {
    border-bottom: 2px solid #f1f1f1;
    padding-bottom: 10px;
}

.cart-items {
    flex: 1;
    overflow-y: auto;
    margin-top: 10px;
}

.cart-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}
.cart-item img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
}
.cart-item-info {
    flex: 1;
}
.cart-item-name {
    font-weight: 600;
    font-size: 13px;
}
.cart-item-price {
    font-size: 13px;
    color: #666;
}

.cart-qty {
    display: flex;
    align-items: center;
    /*gap: 6px;*/
}
.cart-qty button {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: 1px solid #ccc;
    background: #fff;
    font-weight: 600;
    cursor: pointer;
}
.cart-qty button:hover { background: #f5f5f5; }
.cart-qty span {
    min-width: 28px;
    text-align: center;
    font-weight: 600;
}

.cart-footer {
    border-top: 2px solid #f1f1f1;
    padding-top: 15px;
}
.cart-qty-value {
    min-width:32px; 
    text-align:center; 
    font-weight:600; 
    font-size:14px;
}
.remove-btn {
    border: none;
    background: transparent;
    font-size: 18px;
    cursor: pointer;
    transition: transform 0.2s;
}
.remove-btn:hover {
    transform: scale(1.2);
}

</style>

<script>
        // Toggle cart sidebar (open/close)
        function toggleCart(){
            document.getElementById('cartSidebar').classList.toggle('show');
        }

        // Replace previous toggleCart event listener
        document.getElementById('toggleCart').addEventListener('click', toggleCart);
    </script>
</body>
</html>
