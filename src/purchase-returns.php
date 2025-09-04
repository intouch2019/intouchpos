<?php ob_start();
require_once __DIR__ . '/../partials/config.php';

// Fetch all purchases to display in the table
$purchases = [];
$sql_purchases = "SELECT p.*, s.name as supplier_name FROM purchase p JOIN suppliers s ON p.supplier_id = s.id where p.purchase_status = 1 ORDER BY p.purchase_date DESC";
$result_purchases = mysqli_query($link, $sql_purchases);
if ($result_purchases) {
	while ($row = mysqli_fetch_assoc($result_purchases)) {
		$purchases[] = $row;
	}
}
?>

<!-- ========================
Start Page Content
========================= -->

<div class="page-wrapper">

	<!-- Start Content -->
	<div class="content" style="margin-top: -42px;">
		<div class="page-header">
			<div class="add-item d-flex">
				<div class="page-title">
					<h4 class="fw-bold">Purchase Returns</h4>
					<h6>Manage your purchase return</h6>
				</div>
			</div>
			<ul class="table-top-head">
				<li>
					<a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
				</li>
				<li>
					<a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
				</li>	
				<li>
					<a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
				</li>
				<li>
					<a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
				</li>
			</ul>
			<div class="page-btn">
				<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-sales-new">
					<i class="ti ti-circle-plus me-1"></i>Add Sales Return
				</a>
			</div>
		</div>
		<!-- /product list -->
		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
				<div class="search-set">
					<div class="search-input">
						<span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
					</div>
				</div>
				<div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
					<div class="dropdown me-2">
						<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
							Status
						</a>
						<ul class="dropdown-menu  dropdown-menu-end p-3">
							<li>
								<a href="javascript:void(0);" class="dropdown-item rounded-1">Paid</a>
							</li>
							<li>
								<a href="javascript:void(0);" class="dropdown-item rounded-1">Unpaid</a>
							</li>										
						</ul>
					</div>
					<div class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
							Sort By : Last 7 Days
						</a>
						<ul class="dropdown-menu  dropdown-menu-end p-3">
							<li>
								<a href="javascript:void(0);" class="dropdown-item rounded-1">Recently Added</a>
							</li>
							<li>
								<a href="javascript:void(0);" class="dropdown-item rounded-1">Ascending</a>
							</li>
							<li>
								<a href="javascript:void(0);" class="dropdown-item rounded-1">Desending</a>
							</li>
							<li>
								<a href="javascript:void(0);" class="dropdown-item rounded-1">Last Month</a>
							</li>
							<li>
								<a href="javascript:void(0);" class="dropdown-item rounded-1">Last 7 Days</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table datatable">
						<thead class="thead-light">
							<tr>
								<th>
									<label class="checkboxs">
										<input type="checkbox" id="select-all">
										<span class="checkmarks"></span>
									</label>
								</th>
								<th>Purchase Date</th>
								<th>Supplier Name</th>
								<th>Reference</th>
								<th>Status</th>
								<th>Total</th>
								<th>Paid</th>
								<th>Due</th>
								<th>Payment Status</th>
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if (!empty($purchases)):
								foreach ($purchases as $purchase): ?>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox" class="select-row">
												<span class="checkmarks"></span>
											</label>
										</td>

										<td><?php echo date("d-m-Y", strtotime($purchase['purchase_date'])); ?></td>
										<td><?php echo htmlspecialchars($purchase['supplier_name']); ?></td>
										<td><?php echo htmlspecialchars($purchase['reference_no'] ?? 'N/A'); ?></td>
										<td>
											<?php if ($purchase['status'] == 'Received'): ?>
												<span class="badges status-badge fs-10 p-1 px-2 rounded-1">Received</span>
												<?php 
											elseif ($purchase['status'] == 'Pending'): 
												?>
												<span class="badges status-badge badge-pending fs-10 p-1 px-2 rounded-1">Pending</span>
											<?php else: 
												?>
												<span class="badges status-badge bg-warning fs-10 p-1 px-2 rounded-1"><?php echo htmlspecialchars($purchase['status']); ?></span>
											<?php endif; ?>
										</td>
										<td><?php echo number_format($purchase['grand_total'], 2); ?></td>
										<td>0.00</td>
										<td><?php echo number_format($purchase['grand_total'], 2); ?></td>
										<td>
											<?php if ($purchase['grand_total'] == 0): ?>
												<span class="p-1 pe-2 rounded-1 text-success bg-success-transparent fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Paid</span>
												<?php 
											else: 
												?>
												<span class="p-1 pe-2 rounded-1 text-danger bg-danger-transparent fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Unpaid</span>
											<?php endif; ?>
										</td>
										<td class="action-table-data">
											<div class="edit-delete-action">
												<!-- Actions -->
												<a class="me-2 p-2 btn-edit-purchase" data-purchase-id="<?php echo (int)$purchase['id']; ?>" data-bs-toggle="modal" data-bs-target="#edit-sales-new">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class="p-2 d-flex align-items-center border rounded btn-delete-purchase" data-del-purchase-id="<?php echo (int)$purchase['id']; ?>">
													<i data-feather="trash-2" class="feather-trash-2"></i>
												</a>
											</div>
										</td>
									</tr>
									<?php 
								endforeach; 
							endif; 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /product list -->
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

<script type="text/javascript">

	$(document).ready(function() {

	    // Function to populate a select element with supplier data
	    function populateSuppliers(selectId) {
	    	$.getJSON("getData.php", { type: "suppliers" }, function(data) {
	    		let supplierSelect = $(selectId);
	    		supplierSelect.empty().append('<option value="">Select Supplier</option>');

	    		$.each(data, function(index, supplier) {
	    			supplierSelect.append('<option value="'+ supplier.id +'">'+ supplier.name +'</option>');
	    		});

			    // If using Select2 or Bootstrap select, refresh it
			    if (supplierSelect.hasClass("select")) {
			    	supplierSelect.trigger("change");
			    }
			});
	    }

		// Populate both selects
		populateSuppliers("#return_supplier_id");
		populateSuppliers("#return_edit_supplier_id");


		$('#productReturnSelect').select2({
			placeholder: "Search Product",
			width: '100%',
			dropdownParent: $('#add-sales-new'),
			ajax: {
				url: 'getData.php?type=products',
				dataType: 'json',
				delay: 250,
		    	// IMPORTANT: send the user’s search term as `search`
		    	data: function (params) {
		    		return {
				        search: params.term || '', // what user typed
				        page: params.page || 1
				    };
				},
				processResults: function (data) {
					return {
						results: $.map(data, function (item) {
							return {
								id: item.id,
								text: item.name,
								price: item.price,
								cost: item.cost_price,
								stock: item.stock_quantity
							};
						})
					};
				},
				cache: true
			}
		});

		$('#editProductReturnSelect').select2({
			placeholder: "Search Product",
			width: '100%',
			dropdownParent: $('#edit-sales-new'),
			ajax: {
				url: 'getData.php?type=products',
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						search: params.term || '',
						page: params.page || 1
					};
				},
				processResults: function (data) {
					return {
						results: $.map(data, function (item) {
							return {
								id: item.id,
								text: item.name,
								price: item.price,
								cost: item.cost_price,
								stock: item.stock_quantity
							};
						})
					};
				},
				cache: true
			}
		});


	     // Remove row when trash icon clicked
	     $(document).on('click', '.remove-row', function() {
	     	$(this).closest('tr').remove();
	     });

		// ---------- ADD PURCHASE PRODUCT ----------
		$('#productReturnSelect').on('select2:select', function (e) {
			let data = e.params.data;
			let productId = data.id;
			let productName = data.text;
			let price = parseFloat(data.price) || 0;
			let stock = parseInt(data.stock) || 0;

			if (!productId) return;

			let existingRow = $('#purchaseReturnTable tbody tr').filter(function () {
				return $(this).find('input[name="product_id[]"]').val() == productId;
			});

			if (existingRow.length > 0) {
        		// ✅ Already exists → increase qty
        		let qtyInput = existingRow.find('input[name="quantity[]"]');
        		let newQty = (parseInt(qtyInput.val()) || 0) + 1;
        		qtyInput.val(newQty).trigger('input');
        	} else {
        		// ➕ New product
        		let qty = 1, discount = 0, taxPerc = 0;
        		let subtotal = qty * price - discount;
        		let taxAmount = (subtotal * taxPerc) / 100;
        		let unitCost = subtotal / qty;
        		let totalCost = subtotal + taxAmount;

        		let newRow = `
        		<tr>
        		<td>${productName}<input type="hidden" name="product_id[]" value="${productId}"></td>
        		<td>
        		<div class="input-group qty-control d-flex align-items-center">
        		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-plus">+</button>
        		<input type="text" name="quantity[]" class="form-control text-center mx-1" value="${qty}" min="1" max="${stock}" style="width:40px;">
        		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-minus">-</button>
        		</div>
        		</td>
        		<td><input name="purchase_price[]" class="form-control" value="${price}" readonly></td>
        		<td><input type="number" name="discount[]" class="form-control" value="${discount}"></td>
        		<td><input type="number" name="tax_percentage[]" class="form-control" value="${taxPerc}"></td>
        		<td><input type="text" name="tax_amount[]" class="form-control" value="${taxAmount.toFixed(2)}" readonly></td>
        		<td><input type="text" name="unit_cost[]" class="form-control" value="${unitCost.toFixed(2)}" style="width: 123%;" readonly></td>
        		<td><input type="text" name="total_cost[]" class="form-control" value="${totalCost.toFixed(2)}" style="width: 123%;" readonly></td>
        		<td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        		</tr>`;
        		$('#purchaseReturnTable tbody').append(newRow);
        	}

    		// Reset dropdown
    		$('#productReturnSelect').val(null).trigger('change');
    	});


		// ---------- EDIT PURCHASE PRODUCT ----------
		$('#editProductReturnSelect').on('select2:select', function (e) {
			let data = e.params.data;
			let productId = data.id;
			let productName = data.text;
			let price = parseFloat(data.price) || 0;
			let stock = parseInt(data.stock) || 0;

			if (!productId) return;

			let existingRow = $('#editPurchaseReturnTable tbody tr').filter(function () {
				return $(this).find('input[name="product_id[]"]').val() == productId;
			});

			if (existingRow.length > 0) {
        		// ✅ Already exists → increase qty
        		let qtyInput = existingRow.find('input[name="quantity[]"]');
        		let newQty = (parseInt(qtyInput.val()) || 0) + 1;
        		qtyInput.val(newQty).trigger('input');
        	} else {
        		// ➕ New product
        		let qty = 1, discount = 0, taxPerc = 0;
        		let subtotal = qty * price - discount;
        		let taxAmount = (subtotal * taxPerc) / 100;
        		let unitCost = subtotal / qty;
        		let totalCost = subtotal + taxAmount;

        		let newRow = `
        		<tr>
        		<td>${productName}<input type="hidden" name="product_id[]" value="${productId}"></td>
        		<td>
        		<div class="input-group qty-control d-flex align-items-center">
        		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-plus">+</button>
        		<input type="text" name="quantity[]" class="form-control text-center mx-1" value="${qty}" min="1" max="${stock}" style="width:50px;">
        		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-minus">-</button>
        		</div>
        		</td>
        		<td><input name="purchase_price[]" class="form-control" value="${price}" readonly></td>
        		<td><input type="number" name="discount[]" class="form-control" value="${discount}"></td>
        		<td><input type="number" name="tax_percentage[]" class="form-control" value="${taxPerc}"></td>
        		<td><input type="text" name="tax_amount[]" class="form-control" value="${taxAmount.toFixed(2)}" readonly></td>
        		<td><input type="text" name="unit_cost[]" class="form-control" value="${unitCost.toFixed(2)}" style="width: 120%;" readonly></td>
        		<td><input type="text" name="total_cost[]" class="form-control" value="${totalCost.toFixed(2)}" style="width: 120%;" readonly></td>
        		</tr>`;
        		$('#editPurchaseReturnTable tbody').append(newRow);
        	}

        	$('#editProductReturnSelect').val(null).trigger('change');
        });


		// ---------- COMMON CONTROLS ----------
		$(document).on('click', '.qty-plus', function () {
			let input = $(this).siblings('input[name="quantity[]"]');
			let max = parseInt(input.attr('max')) || 9999;
			let current = parseInt(input.val()) || 0;
			if (current < max) input.val(current + 1).trigger('input');
		});

		$(document).on('click', '.qty-minus', function () {
			let input = $(this).siblings('input[name="quantity[]"]');
			let min = parseInt(input.attr('min')) || 1;
			let current = parseInt(input.val()) || 0;
			if (current > min) input.val(current - 1).trigger('input');
		});

		// Recalculation works same for both tables
		$(document).on('input', 'input[name="quantity[]"], input[name="purchase_price[]"], input[name="discount[]"], input[name="tax_percentage[]"]', function () {
			let row = $(this).closest('tr');
			let qty = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
			let price = parseFloat(row.find('input[name="purchase_price[]"]').val()) || 0;
			let discount = parseFloat(row.find('input[name="discount[]"]').val()) || 0;
			let taxPerc = parseFloat(row.find('input[name="tax_percentage[]"]').val()) || 0;

			let subtotal = qty * price - discount;
			let taxAmount = (subtotal * taxPerc) / 100;
			let unitCost = subtotal / (qty || 1);
			let totalCost = subtotal + taxAmount;

			row.find('input[name="tax_amount[]"]').val(taxAmount.toFixed(2));
			row.find('input[name="unit_cost[]"]').val(unitCost.toFixed(2));
			row.find('input[name="total_cost[]"]').val(totalCost.toFixed(2));
		});

	    // Save supplier dynamically
	    $('#supplierForm').on('submit', function(e) {
	    	e.preventDefault();

	    	$.ajax({
	    		url: 'save_supplier.php',
	    		type: 'POST',
	    		data: $(this).serialize(),
	    		dataType: 'json',
	    		success: function(response) {
	    			if (response.status === 'success') {
		                // Add new supplier to dropdown
		                $('#supplier_id').append(
		                	`<option value="${response.id}" selected>${response.name}</option>`
		                	).trigger('change');

		                // Close modal
		                $('#add_customer').modal('hide');
		                location.reload(); 
		                // Reset form
		                $('#supplierForm')[0].reset();
		            } else {
		            	alert('Error: ' + response.message);
		            }
		        }
		    });
	    });

		// Open modal with data
		$(document).on('click', '.btn-edit-purchase', function() {
		    let id = $(this).data('purchase-id'); // fix: use purchase-id

		    $.getJSON("getData.php", { type: "get_purchase", id: id }, function(response) {
		    	if (response.status === "success") {
		    		let purchase = response.purchase;
		    		let items = response.items;

		            // Fill form fields
		            $("#edit_return_purchase_id").val(purchase.id);
		            $("#return_edit_supplier_id").val(purchase.supplier_id);
		            $("#return_edit_purchase_date").val(purchase.purchase_date);
		            $("#return_edit_reference_no").val(purchase.reference_no);
		            $("#return_edit_order_tax").val(purchase.order_tax);
		            $("#return_edit_order_discount").val(purchase.discount);
		            $("#return_edit_shipping").val(purchase.shipping);
		            $("#return_edit_status").val(purchase.status);
		            $("#return_edit_description").val(purchase.description);

		            $("#return_edit_summary_order_tax").text(`${parseFloat(purchase.order_tax).toFixed(2)}`);
		            $("#return_edit_summary_discount").text(`${parseFloat(purchase.discount).toFixed(2)}`);
		            $("#return_edit_summary_shipping").text(`${parseFloat(purchase.shipping).toFixed(2)}`);
		            $("#return_edit_summary_grand_total").text(`${parseFloat(purchase.grand_total).toFixed(2)}`);

		            // Fill items table
		            let tbody = $("#editPurchaseReturnTable tbody");
		            tbody.empty();
		            $.each(items, function(i, item) {
		            	tbody.append(`
		            		<tr>
		            		<td>${item.name}<input type="hidden" name="product_id[]" value="${item.product_id}"></td>
		            		<td>
		            		<div class="input-group qty-control d-flex align-items-center">
		            		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-plus" style="width: 20px; height: 20px; padding: 0;">+</button>
		            		<input type="text" name="quantity[]" class="form-control text-center mx-1" value="${item.quantity}" min="1" style="width: 50px;">
		            		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-minus" style="width: 20px; height: 20px; padding: 0;">-</button>
		            		</div>
		            		</td>
		            		<td><input type="number" name="purchase_price[]" class="form-control" value="${item.purchase_price}" readonly></td>
		            		<td><input type="number" name="discount[]" class="form-control" value="${item.discount}"></td>
		            		<td><input type="number" name="tax_percentage[]" class="form-control" value="${item.tax_percentage}"></td>
		            		<td><input type="number" name="tax_amount[]" class="form-control" value="${item.tax_amount}" readonly></td>
		            		<td><input type="number" name="unit_cost[]" class="form-control" value="${item.unit_cost}" style="width: 120%;" readonly></td>
		            		<td><input type="number" name="total_cost[]" class="form-control" style="width: 120%;"  value="${item.total_cost}" readonly></td>
		            		</tr>
		            		`);
		            });

		            // Show modal
		            $("#edit-sales-new").modal("show");
		        } else {
		        	alert(response.message || "Failed to fetch purchase details.");
		        }
		    });
		});

		// Save changes
		$("#editPurchaseReturnForm").on("submit", function(e) {
			e.preventDefault();

			$.ajax({
				url: "purchase_returns-update.php",
				type: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function(res) {
					if (res.status === "success") {
						alert("Purchase updated successfully!");
						$("#edit-sales-new").modal("hide");
		                location.reload(); // refresh list
		            } else {
		            	alert("Error updating purchase");
		            }
		        }
		    });
		});

		// For Edit Purchase table
		$(document).on('input', '#editPurchaseReturnTable input', function() {
			updateSummary('editPurchaseReturnTable', 'return_edit_summary_order_tax', 'return_edit_summary_discount', 'return_edit_summary_shipping', 'return_edit_summary_grand_total');
		});

		// Also trigger when product is added
		$('#editProductReturnSelect').on('change', function() {
			updateSummary('editPurchaseReturnTable', 'return_edit_summary_order_tax', 'return_edit_summary_discount', 'return_edit_summary_shipping', 'return_edit_summary_grand_total');
		}); 

		// Function to recalc totals
		function updateSummary(tableId, orderTaxId, discountId, shippingId, grandTotalId) {
			let subtotal = 0;
			let totalTax = 0;
			let totalDiscount = 0;

		    // Loop all rows in table
		    $('#' + tableId + ' tbody tr').each(function() {
		    	let qty = parseFloat($(this).find('input[name="quantity[]"]').val()) || 0;
		    	let price = parseFloat($(this).find('input[name="purchase_price[]"]').val()) || 0;
		    	let discount = parseFloat($(this).find('input[name="discount[]"]').val()) || 0;
		    	let taxPerc = parseFloat($(this).find('input[name="tax_percentage[]"]').val()) || 0;

		    	let rowSubtotal = (qty * price) - discount;
		    	let taxAmount = (rowSubtotal * taxPerc) / 100;

		    	subtotal += rowSubtotal;
		    	totalTax += taxAmount;
		    	totalDiscount += discount;
		    });

		    // Example: Shipping as a fixed input (or fetch from form)
		    let shipping = parseFloat($('#shipping').val()) || 0;

		    // Calculate grand total
		    let grandTotal = subtotal + totalTax + shipping;

		    // Update UI
		    $('#' + orderTaxId).text(totalTax.toFixed(2));
		    $('#' + discountId).text(totalDiscount.toFixed(2));
		    $('#' + shippingId).text(shipping.toFixed(2));
		    $('#' + grandTotalId).text(grandTotal.toFixed(2));
		}

		$(document).on('click', '.btn-delete-purchase', function() {
			let purchaseId = $(this).data('del-purchase-id');
			$("#delete_purchase_return_id").val(purchaseId);
			$("#delete-purchase-return").modal("show");
		});

		$('#confirmDeletePurchaseReturn').on('click', function() {
			let purchaseId = $("#delete_purchase_return_id").val();
			if (!purchaseId) {
				alert("Invalid purchase ID");
				return;
			}

			$.ajax({
				url: "purchase-returns-delete.php",
				type: "POST",
				data: { purchase_id: purchaseId },
				dataType: "json",
				success: function(res) {
					if (res.status === "success") {
						$("#delete-purchase").modal("hide");
						alert("Purchase deleted successfully!");
		                	location.reload(); // refresh table/list
		                } else {
		                	alert(res.message || "Error deleting purchase.");
		                }
		            }
		        });
		});

	});

</script>
<style type="text/css">
	.qty-control {
		max-width: 120px;
	}
	.qty-control .form-control {
		max-width: 60px;
		padding: 4px;
		text-align: center;
	}
	.qty-control .btn {
		padding: 4px 8px;
	}
</style>