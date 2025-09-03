<?php 
ob_start();
require_once __DIR__ . '/../auth/auth_middleware.php';
require_once __DIR__ . '/../partials/config.php';
requireLogin();

// Get order ID from URL parameter
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($order_id <= 0) {
    header('Location: orders.php');
    exit;
}

// Fetch order details
$order = null;
$order_items = [];
$customer = null;

// Get order with customer and user info
$order_sql = "SELECT o.*, c.name as customer_name, c.email as customer_email, c.phone as customer_phone, c.address as customer_address,
                     u.full_name as user_name, u.email as user_email
              FROM orders o
              LEFT JOIN customers c ON o.customer_id = c.id
              LEFT JOIN users u ON o.user_id = u.id
              WHERE o.id = ?";
$order_stmt = mysqli_prepare($link, $order_sql);

if (!$order_stmt) {
    error_log("Prepare failed: " . mysqli_error($link));
    header('Location: orders.php');
    exit;
}

mysqli_stmt_bind_param($order_stmt, "i", $order_id);
mysqli_stmt_execute($order_stmt);
$order_result = mysqli_stmt_get_result($order_stmt);

if (mysqli_num_rows($order_result) > 0) {
    $order = mysqli_fetch_assoc($order_result);
    
    // Get order items with product details
    $items_sql = "SELECT oi.*, p.name as product_name, p.description as product_description
                  FROM order_items oi
                  JOIN products p ON oi.product_id = p.id
                  WHERE oi.order_id = ?
                  ORDER BY oi.id";
    $items_stmt = mysqli_prepare($link, $items_sql);
    
    if (!$items_stmt) {
        error_log("Items prepare failed: " . mysqli_error($link));
        $order_items = [];
    } else {
        mysqli_stmt_bind_param($items_stmt, "i", $order_id);
        mysqli_stmt_execute($items_stmt);
        $items_result = mysqli_stmt_get_result($items_stmt);
    
        while ($item = mysqli_fetch_assoc($items_result)) {
            $order_items[] = $item;
        }
        mysqli_stmt_close($items_stmt);
    }
} else {
    // Order not found, redirect to orders page
    header('Location: orders.php');
    exit;
}
mysqli_stmt_close($order_stmt);

// Helper function to convert number to words
function numberToWords($number) {
    $ones = array(
        0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
        6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
        11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen'
    );
    
    $tens = array(
        20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty',
        60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    );
    
    if ($number < 20) {
        return $ones[$number];
    } elseif ($number < 100) {
        return $tens[10 * floor($number / 10)] . ($number % 10 ? ' ' . $ones[$number % 10] : '');
    } elseif ($number < 1000) {
        return $ones[floor($number / 100)] . ' Hundred' . ($number % 100 ? ' ' . numberToWords($number % 100) : '');
    } elseif ($number < 1000000) {
        return numberToWords(floor($number / 1000)) . ' Thousand' . ($number % 1000 ? ' ' . numberToWords($number % 1000) : '');
    }
    
    return 'Dollar ' . number_format($number, 2);
}
?>

    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Invoice Details</h4>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer" class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="invoice.php" class="btn btn-primary"><i data-feather="arrow-left" class="me-2"></i>Back to Invoices</a>
                </div>
            </div>
            

            <!-- Invoices -->
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between align-items-center border-bottom mb-3">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <img src="assets/img/logo.svg" width="130" class="img-fluid" alt="logo">
                            </div>
                            <p>3099 Kennedy Court Framingham, MA 01702</p>
                        </div>
                        <div class="col-md-6">
                            <div class=" text-end mb-3">
                                <h5 class="text-gray mb-1">Invoice No <span class="text-primary">#<?php echo htmlspecialchars($order['order_number']); ?></span></h5>
                                <p class="mb-1 fw-medium">Created Date : <span class="text-dark"><?php echo date('M d, Y', strtotime($order['created_at'])); ?></span> </p>
                                <p class="fw-medium">Due Date : <span class="text-dark"><?php echo date('M d, Y', strtotime($order['created_at'] . ' +7 days')); ?></span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-3">
                        <div class="col-md-5">
                            <p class="text-dark mb-2 fw-semibold">From</p>
                            <div>
                                <h4 class="mb-1"><?php echo htmlspecialchars($order['user_name'] ?: 'DreamPOS Store'); ?></h4>
                                <p class="mb-1">3099 Kennedy Court Framingham, MA 01702</p>
                                <p class="mb-1">Email : <span class="text-dark"><?php echo htmlspecialchars($order['user_email'] ?: 'info@dreampos.com'); ?></span></p>
                                <p>Phone : <span class="text-dark">+1 987 654 3210</span></p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <p class="text-dark mb-2 fw-semibold">To</p>
                            <div>
                                <h4 class="mb-1"><?php echo htmlspecialchars($order['customer_name'] ?: 'Walk in Customer'); ?></h4>
                                <p class="mb-1"><?php echo htmlspecialchars($order['customer_address'] ?: 'Customer Address'); ?></p>
                                <p class="mb-1">Email : <span class="text-dark"><?php echo htmlspecialchars($order['customer_email'] ?: 'customer@example.com'); ?></span></p>
                                <p>Phone : <span class="text-dark"><?php echo htmlspecialchars($order['customer_phone'] ?: '+1 987 471 6589'); ?></span></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <p class="text-title mb-2 fw-medium">Payment Status </p>
                                <?php 
                                $status_class = 'bg-success';
                                $status_text = 'Paid';
                                if ($order['payment_status'] === 'pending') {
                                    $status_class = 'bg-warning';
                                    $status_text = 'Pending';
                                } elseif ($order['payment_status'] === 'failed') {
                                    $status_class = 'bg-danger';
                                    $status_text = 'Failed';
                                }
                                ?>
                                <span class="<?php echo $status_class; ?> text-white fs-10 px-1 rounded"><i class="ti ti-point-filled "></i><?php echo $status_text; ?></span>
                                <div class="mt-3">
                                    <img src="assets/img/qr.svg" class="img-fluid" alt="QR">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="fw-medium">Invoice For : <span class="text-dark fw-medium">Product Sales Order</span></p>
                        <div class="table-responsive mb-3">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Product Description</th>
                                        <th class="text-end">Qty</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Discount</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order_items as $item): ?>
                                    <tr>
                                        <td>
                                            <h6><?php echo htmlspecialchars($item['product_name']); ?></h6>
                                            <?php if (!empty($item['product_description'])): ?>
                                            <small class="text-muted"><?php echo htmlspecialchars($item['product_description']); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-gray-9 fw-medium text-end"><?php echo $item['quantity']; ?></td>
                                        <td class="text-gray-9 fw-medium text-end">$<?php echo number_format($item['unit_price'], 2); ?></td>
                                        <td class="text-gray-9 fw-medium text-end">$0.00</td>
                                        <td class="text-gray-9 fw-medium text-end">$<?php echo number_format($item['total_price'], 2); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row border-bottom mb-3">
                        <div class="col-md-5 ms-auto mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-2 pe-3">
                                <p class="mb-0">Sub Total</p>
                                <p class="text-dark fw-medium mb-2">$<?php echo number_format($order['subtotal'], 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-2 pe-3">
                                <p class="mb-0">Discount</p>
                                <p class="text-dark fw-medium mb-2">$<?php echo number_format($order['discount_amount'], 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2 pe-3">
                                <p class="mb-0">Tax</p>
                                <p class="text-dark fw-medium mb-2">$<?php echo number_format($order['tax_amount'], 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2 pe-3">
                                <h5>Total Amount</h5>
                                <h5>$<?php echo number_format($order['total_amount'], 2); ?></h5>
                            </div>
                            <p class="fs-12">
                                Amount in Words : <?php echo numberToWords($order['total_amount']); ?>
                            </p>
                        </div>
                    </div>
                    <div class="row align-items-center border-bottom mb-3">
                        <div class="col-md-7">
                            <div>
                                <div class="mb-3">
                                    <h6 class="mb-1">Terms and Conditions</h6>
                                    <p>Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.</p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="mb-1">Notes</h6>
                                    <p><?php echo !empty($order['notes']) ? htmlspecialchars($order['notes']) : 'Please quote invoice number when remitting funds.'; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-end">
                                <img src="assets/img/sign.svg" class="img-fluid" alt="sign">
                            </div>
                            <div class="text-end mb-3">
                                <h6 class="fs-14 fw-medium pe-3"><?php echo htmlspecialchars($order['user_name'] ?: 'Store Manager'); ?></h6>
                                <p>Store Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="mb-3">
                            <img src="assets/img/logo.svg" width="130" class="img-fluid" alt="logo">
                        </div>
                        <p class="text-dark mb-1">Payment Made Via bank transfer / Cheque in the name of Thomas Lawler</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="fs-12 mb-0 me-3">Bank Name : <span class="text-dark">HDFC Bank</span></p>
                            <p class="fs-12 mb-0 me-3">Account Number : <span class="text-dark">45366287987</span></p>
                            <p class="fs-12">IFSC : <span class="text-dark">HDFC0018159</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoices -->

            <div class="d-flex justify-content-center align-items-center mb-4">
                <a href="#" class="btn btn-primary d-flex justify-content-center align-items-center me-2"><i class="ti ti-printer me-2"></i>Print Invoice</a>
                <a href="#" class="btn btn-secondary d-flex justify-content-center align-items-center border"><i class="ti ti-copy me-2"></i>Clone Invoice</a>
            </div>
        </div>
        <!-- End Content -->
    
        <?php require_once '../partials/footer.php'; ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->

<?php
$content = ob_get_clean();

require_once '../partials/main.php'; ?>      