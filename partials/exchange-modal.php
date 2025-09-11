<!-- Exchange Modal -->
<div class="modal fade" id="exchange-modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Exchange Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Return Items Section -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Current Cart Items</h6>
                            </div>
                            <div class="card-body">
                                <div id="return-items-list" class="mb-3">
                                    <!-- Return items will be loaded here -->
                                </div>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Cart Total:</span>
                                    <span id="return-total">0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Exchange Items Section -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Exchange With</h6>
                                <input type="text" class="form-control form-control-sm w-50" id="exchange-search" placeholder="Search products...">
                            </div>
                            <div class="card-body">
                                <div id="exchange-products-grid" class="mb-3" style="max-height: 400px; overflow-y: auto;">
                                    <!-- Exchange products will be loaded here -->
                                </div>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Exchange Total:</span>
                                    <span id="exchange-total">0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Selected Exchange Products Section -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Selected Exchange Products</h6>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearExchangeSelection()">Clear All</button>
                            </div>
                            <div class="card-body">
                                <div id="selected-exchange-list">
                                    <div class="text-center text-muted p-3">
                                        <i class="ti ti-package fs-24 mb-2"></i>
                                        <p class="mb-0">No exchange products selected</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Balance Section -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <div id="exchange-balance" class="h5 mb-0">
                                    <!-- Balance will be calculated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="processExchange()">Process Exchange</button>
            </div>
        </div>
    </div>
</div>