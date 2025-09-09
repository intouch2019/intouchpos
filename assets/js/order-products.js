// Order Products Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    
    // Add click event listeners to all view product buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.edit-icon') && e.target.closest('.edit-icon').querySelector('.feather-eye')) {
            e.preventDefault();
            
            // Close current modal
            const currentModal = e.target.closest('.modal');
            if (currentModal) {
                const modalInstance = bootstrap.Modal.getInstance(currentModal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            }
            
            // Show order products modal
            setTimeout(() => {
                const orderProductsModal = new bootstrap.Modal(document.getElementById('order-products'));
                orderProductsModal.show();
                
                // Load sample products data
                loadOrderProducts();
            }, 300);
        }
    });
    
    function loadOrderProducts() {
        const productsList = document.getElementById('order-products-list');
        
        // Sample products data
        const products = [
            {
                name: 'Nike Jordan Shoes',
                quantity: 2,
                price: 150.00,
                total: 300.00
            },
            {
                name: 'Apple iPhone 14',
                quantity: 1,
                price: 999.00,
                total: 999.00
            },
            {
                name: 'Samsung Galaxy Watch',
                quantity: 1,
                price: 250.00,
                total: 250.00
            }
        ];
        
        // Clear loading message
        productsList.innerHTML = '';
        
        // Add products to table
        products.forEach(product => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.quantity}</td>
                <td>$${product.price.toFixed(2)}</td>
                <td>$${product.total.toFixed(2)}</td>
            `;
            productsList.appendChild(row);
        });
        
        // Add total row
        const totalAmount = products.reduce((sum, product) => sum + product.total, 0);
        const totalRow = document.createElement('tr');
        totalRow.className = 'table-active fw-bold';
        totalRow.innerHTML = `
            <td colspan="3" class="text-end">Total:</td>
            <td>$${totalAmount.toFixed(2)}</td>
        `;
        productsList.appendChild(totalRow);
    }
});