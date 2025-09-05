<?php
// POS Payment Modals
?>

<!-- Quick Payment Selection Modal -->
<div class="modal fade" id="quick-payment-modal" tabindex="-1" aria-labelledby="quickPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickPaymentModalLabel">Select Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="order-summary mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Customer:</span>
                        <span id="quick-customer-name">Walk in Customer</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Items:</span>
                        <span id="quick-item-count">0 item(s)</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span id="quick-total-amount">$0.00</span>
                    </div>
                </div>
                <div class="payment-methods">
                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectQuickPayment('cash')">
                                <i class="ti ti-cash me-2"></i>Cash
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectQuickPayment('card')">
                                <i class="ti ti-credit-card me-2"></i>Card
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectQuickPayment('points')">
                                <i class="ti ti-star me-2"></i>Points
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectQuickPayment('deposit')">
                                <i class="ti ti-wallet me-2"></i>Deposit
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectQuickPayment('cheque')">
                                <i class="ti ti-file-text me-2"></i>Cheque
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100" onclick="selectQuickPayment('gift_card')">
                                <i class="ti ti-gift me-2"></i>Gift Card
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cash Payment Modal -->
<div class="modal fade" id="payment-cash" tabindex="-1" aria-labelledby="cashPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cashPaymentLabel">Cash Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <div class="form-control bg-light fw-bold text-primary" id="cash-total-amount">$0.00</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cash Received <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="cash-received" placeholder="0.00" step="0.01" min="0" oninput="calculateCashChange()">
                </div>
                <div class="mb-3">
                    <label class="form-label">Change</label>
                    <div class="form-control bg-light" id="cash-change">$0.00</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('cash')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Card Payment Modal -->
<div class="modal fade" id="payment-card" tabindex="-1" aria-labelledby="cardPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardPaymentLabel">Card Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <div class="form-control bg-light fw-bold text-primary" id="card-total-amount">$0.00</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Card Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="card-number" placeholder="**** **** **** ****" maxlength="19">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="card-expiry" placeholder="MM/YY" maxlength="5">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">CVV <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="card-cvv" placeholder="***" maxlength="4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('card')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Points Payment Modal -->
<div class="modal fade" id="payment-points" tabindex="-1" aria-labelledby="pointsPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pointsPaymentLabel">Points Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="text" class="form-control" id="points-total-amount" value="$0.00" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Available Points</label>
                    <input type="text" class="form-control" value="1,250 points" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Points to Use</label>
                    <input type="number" class="form-control" id="points-to-use" placeholder="0" min="0" max="1250">
                </div>
                <div class="alert alert-info">
                    <small>1 point = $0.01</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('points')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Deposit Payment Modal -->
<div class="modal fade" id="payment-deposit" tabindex="-1" aria-labelledby="depositPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="depositPaymentLabel">Deposit Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="text" class="form-control" id="deposit-total-amount" value="$0.00" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Available Deposit</label>
                    <input type="text" class="form-control" value="$500.00" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deposit Amount to Use</label>
                    <input type="number" class="form-control" id="deposit-amount" placeholder="0.00" step="0.01" min="0" max="500">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('deposit')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Cheque Payment Modal -->
<div class="modal fade" id="payment-cheque" tabindex="-1" aria-labelledby="chequePaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chequePaymentLabel">Cheque Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="text" class="form-control" id="cheque-total-amount" value="$0.00" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cheque Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="cheque-number" placeholder="Enter cheque number">
                </div>
                <div class="mb-3">
                    <label class="form-label">Bank Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="bank-name" placeholder="Enter bank name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cheque Date</label>
                    <input type="date" class="form-control" id="cheque-date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('cheque')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Gift Card Payment Modal -->
<div class="modal fade" id="gift-payment" tabindex="-1" aria-labelledby="giftPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="giftPaymentLabel">Gift Card Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="text" class="form-control" id="gift-total-amount" value="$0.00" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gift Card Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="gift-card-number" placeholder="Enter gift card number">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gift Card PIN</label>
                    <input type="password" class="form-control" id="gift-card-pin" placeholder="Enter PIN (if required)">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('gift_card')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Scan Payment Modal -->
<div class="modal fade" id="scan-payment" tabindex="-1" aria-labelledby="scanPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scanPaymentLabel">Scan Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="text" class="form-control" id="scan-total-amount" value="$0.00" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">QR Code / Barcode <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="scan-code" placeholder="Scan or enter code">
                </div>
                <div class="text-center mb-3">
                    <div class="border rounded p-4">
                        <i class="ti ti-qrcode fs-48 text-muted"></i>
                        <p class="text-muted mt-2">Scan QR Code or Barcode</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('scan')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Split Payment Modal -->
<div class="modal fade" id="split-payment" tabindex="-1" aria-labelledby="splitPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="splitPaymentLabel">Split Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Total Amount</label>
                    <input type="text" class="form-control" id="split-total-amount" value="$0.00" readonly>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Payment Method 1</label>
                            <select class="form-select" id="split-method-1">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="points">Points</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Amount 1</label>
                            <input type="number" class="form-control" id="split-amount-1" placeholder="0.00" step="0.01" min="0" oninput="calculateSplitAmounts()">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Payment Method 2</label>
                            <select class="form-select" id="split-method-2">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="points">Points</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Amount 2</label>
                            <input type="number" class="form-control" id="split-amount-2" placeholder="0.00" step="0.01" min="0" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="validateAndPlaceOrder('split')">Complete Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Payment Completed Modal -->
<div class="modal fade" id="payment-completed" tabindex="-1" aria-labelledby="paymentCompletedLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="paymentCompletedLabel">
                    <i class="ti ti-check-circle me-2"></i>Payment Successful
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="ti ti-check-circle text-success" style="font-size: 4rem;"></i>
                </div>
                <h4>Order Placed Successfully!</h4>
                <p class="text-muted">Order #<span id="completed-order-number">ORD123</span></p>
                <p>Total Amount: <span id="completed-total-amount">$0.00</span></p>
                <p>Payment Method: <span id="completed-payment-method">Cash</span></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" onclick="printReceipt()">
                    <i class="ti ti-printer me-2"></i>Print Receipt
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Hold Order Modal -->
<div class="modal fade" id="hold-order" tabindex="-1" aria-labelledby="holdOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="holdOrderLabel">
                    <i class="ti ti-player-pause me-2"></i>Hold Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="order-summary mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Customer:</span>
                        <span id="hold-customer-name" class="fw-bold">Walk in Customer</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Items:</span>
                        <span id="hold-item-count">0 item(s)</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Amount:</span>
                        <span id="hold-total-amount" class="fw-bold text-primary fs-18">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Hold Reference:</span>
                        <span id="hold-reference" class="fw-bold text-success">HOLD-000000</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hold Notes (Optional)</label>
                    <textarea class="form-control" id="hold-notes" rows="3" placeholder="Add notes for this hold order..."></textarea>
                </div>
                <div class="alert alert-info">
                    <i class="ti ti-info-circle me-2"></i>
                    The current order will be set on hold. You can retrieve this order from the pending orders section.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-orange" onclick="confirmHoldOrder()">
                    <i class="ti ti-check me-2"></i>Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Additional POS Modals -->

<!-- Create Customer Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCustomerLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add_customer.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Barcode Scanner Modal -->
<div class="modal fade" id="barcode" tabindex="-1" aria-labelledby="barcodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barcodeLabel">Scan Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Barcode</label>
                    <input type="text" class="form-control" id="barcode-input" placeholder="Scan or enter barcode">
                </div>
                <div class="text-center">
                    <div class="border rounded p-4">
                        <i class="ti ti-scan fs-48 text-muted"></i>
                        <p class="text-muted mt-2">Scan product barcode</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="searchByBarcode()">Search Product</button>
            </div>
        </div>
    </div>
</div>

<!-- Shipping Cost Modal -->
<div class="modal fade" id="shipping-cost" tabindex="-1" aria-labelledby="shippingCostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shippingCostLabel">Shipping Cost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Shipping Amount</label>
                    <input type="number" class="form-control" id="shipping-amount" placeholder="0.00" step="0.01" min="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateShipping()">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Order Tax Modal -->
<div class="modal fade" id="order-tax" tabindex="-1" aria-labelledby="orderTaxLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderTaxLabel">Order Tax</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Tax Percentage</label>
                    <input type="number" class="form-control" id="tax-percentage" placeholder="0" step="0.01" min="0" max="100">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tax Amount</label>
                    <input type="number" class="form-control" id="tax-amount" placeholder="0.00" step="0.01" min="0" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="updateTax()">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Coupon Code Modal -->
<div class="modal fade" id="coupon-code" tabindex="-1" aria-labelledby="couponCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="couponCodeLabel">Apply Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Coupon Code</label>
                    <input type="text" class="form-control" id="coupon-code-input" placeholder="Enter coupon code">
                </div>
                <div class="mb-3">
                    <label class="form-label">Discount Amount</label>
                    <input type="number" class="form-control" id="coupon-discount" placeholder="0.00" step="0.01" min="0" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="applyCoupon()">Apply Coupon</button>
            </div>
        </div>
    </div>
</div>

<!-- Discount Modal -->
<div class="modal fade" id="discount" tabindex="-1" aria-labelledby="discountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="discountLabel">Apply Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Discount Type</label>
                    <select class="form-select" id="discount-type" onchange="calculateDiscount()">
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed Amount</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Discount Value</label>
                    <input type="number" class="form-control" id="discount-value" placeholder="0" step="0.01" min="0" oninput="calculateDiscount()">
                </div>
                <div class="mb-3">
                    <label class="form-label">Discount Amount</label>
                    <input type="number" class="form-control" id="discount-amount-display" placeholder="0.00" step="0.01" min="0" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="applyDiscount()">Apply Discount</button>
            </div>
        </div>
    </div>
</div>

<script>
// Function to print receipt
function printReceipt() {
    // You can implement receipt printing functionality here
    alert('Receipt printing functionality would be implemented here');
}

// Function to validate and place order

// Function to search by barcode
function searchByBarcode() {
    const barcode = document.getElementById('barcode-input').value;
    if (barcode) {
        // Implement barcode search logic
        alert('Barcode search functionality would be implemented here for: ' + barcode);
    }
}

// Function to update shipping
function updateShipping() {
    const amount = parseFloat(document.getElementById('shipping-amount').value) || 0;
    document.getElementById('shippingCost').textContent = '$' + amount.toFixed(2);
    const modal = bootstrap.Modal.getInstance(document.getElementById('shipping-cost'));
    modal.hide();
    updateCartDisplay();
}

// Function to update tax
function updateTax() {
    const percentage = parseFloat(document.getElementById('tax-percentage').value) || 0;
    const subtotal = getCartSubtotal();
    const taxAmount = (subtotal * percentage) / 100;
    document.getElementById('taxAmount').textContent = '$' + taxAmount.toFixed(2);
    const modal = bootstrap.Modal.getInstance(document.getElementById('order-tax'));
    modal.hide();
    updateCartDisplay();
}

// Function to calculate tax amount
document.getElementById('tax-percentage').addEventListener('input', function() {
    const percentage = parseFloat(this.value) || 0;
    const subtotal = getCartSubtotal();
    const taxAmount = (subtotal * percentage) / 100;
    document.getElementById('tax-amount').value = taxAmount.toFixed(2);
});

// Function to apply coupon
function applyCoupon() {
    const code = document.getElementById('coupon-code-input').value;
    const discount = parseFloat(document.getElementById('coupon-discount').value) || 0;
    if (code && discount > 0) {
        document.getElementById('couponAmount').textContent = '$' + discount.toFixed(2);
        const modal = bootstrap.Modal.getInstance(document.getElementById('coupon-code'));
        modal.hide();
        updateCartDisplay();
    }
}

// Function to calculate discount
function calculateDiscount() {
    const type = document.getElementById('discount-type').value;
    const value = parseFloat(document.getElementById('discount-value').value) || 0;
    const subtotal = getCartSubtotal();
    
    let discountAmount = 0;
    if (type === 'percentage') {
        discountAmount = (subtotal * value) / 100;
    } else {
        discountAmount = value;
    }
    
    document.getElementById('discount-amount-display').value = discountAmount.toFixed(2);
}

// Function to apply discount
function applyDiscount() {
    const discountAmount = parseFloat(document.getElementById('discount-amount-display').value) || 0;
    document.getElementById('discountAmount').textContent = '$' + discountAmount.toFixed(2);
    const modal = bootstrap.Modal.getInstance(document.getElementById('discount'));
    modal.hide();
    updateCartDisplay();
}

// Format card number input
document.addEventListener('DOMContentLoaded', function() {
    const cardNumberInput = document.getElementById('card-number');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });
    }
    
    // Format expiry date input
    const cardExpiryInput = document.getElementById('card-expiry');
    if (cardExpiryInput) {
        cardExpiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }
});
</script>