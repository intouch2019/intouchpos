<?php ob_start();
require_once __DIR__ . '/../partials/config.php';

// Fetch all purchases to display in the table
$purchases = [];
$sql_purchases = "SELECT p.*, s.name as supplier_name FROM purchase_returns p JOIN suppliers s ON p.supplier_id = s.id ORDER BY p.created_at DESC";
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
								<th>Return Date</th>
								<th>Supplier Name</th>
								<th>Purchase No</th>
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

										<td><?php echo date("d-m-Y", strtotime($purchase['return_date'])); ?></td>
										<td><?php echo htmlspecialchars($purchase['supplier_name']); ?></td>
										<td><?php echo htmlspecialchars($purchase['purchase_no'] ?? 'N/A'); ?></td>
										<td>
											<?php if ($purchase['status'] == 'Returned'): ?>
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
										<td><?php echo number_format($purchase['total_return_amount'], 2); ?></td>
										<td>0.00</td>
										<td><?php echo number_format($purchase['total_return_amount'], 2); ?></td>
										<td>
											<?php if ($purchase['total_return_amount'] == 0): ?>
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
												<a class="me-2 p-2 btn-edit-purchase" data-purchase-id="<?php echo $purchase['id']; ?>" data-bs-toggle="modal" data-bs-target="#edit-sales-new">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class="p-2 d-flex align-items-center border rounded btn-delete-purchase" data-del-purchase-id="<?php echo $purchase['id']; ?>">
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
		//populateSuppliers("#return_edit_supplier_id");

		// When supplier changes, load purchase references
		$('#return_supplier_id').on('change', function () {
			let supplierId = $(this).val();

			if (!supplierId) {
				$('#purchase_reference').html('<option value="">Select Purchase No</option>');
				return;
			}

			$.getJSON("getData.php", { type: "purchase_references", supplier_id: supplierId }, function (data) {
				let refSelect = $("#purchase_reference");
				refSelect.empty().append('<option value="">Select Purchase No</option>');

				$.each(data, function (index, ref) {
					refSelect.append('<option value="' + ref.id + '">' + ref.reference_no + '</option>');
				});
			});
		});

		// ✅ For Edit modal
		// function populatePurchaseReferences(supplierId, selectId, selectedRef = null) {
		//     if (!supplierId) {
		//         $(selectId).html('<option value="">Select Purchase No</option>');
		//         return;
		//     }

		//     $.getJSON("getData.php", { type: "purchase_references", supplier_id: supplierId }, function (data) {
		//         let refSelect = $(selectId);
		//         refSelect.empty().append('<option value="">Select Purchase No</option>');

		//         $.each(data, function (index, ref) {
		//             refSelect.append('<option value="' + ref.id + '">' + ref.reference_no + '</option>');
		//         });

		//         // Preselect existing purchase reference
		//         if (selectedRef) {
		//             refSelect.val(selectedRef);
		//         }
		//     });
		// }

		// Re-init product select when reference changes
		$('#purchase_reference').on('change', function () {
			let purchaseNo = $(this).val();
			let supplierId = $('#return_supplier_id').val();

			if (!purchaseNo) {
				$('#productReturnSelect').html('<option value="">Search Product</option>');
				return;
			}

    		// If already initialized, destroy to avoid duplicate
    		if ($.fn.select2 && $('#productReturnSelect').hasClass("select2-hidden-accessible")) {
    			$('#productReturnSelect').select2('destroy');
    		}

    		// Initialize select2 with reference filter
    		$('#productReturnSelect').select2({
    			placeholder: "Search Product",
    			width: '100%',
    			dropdownParent: $('#add-sales-new'),
    			ajax: {
    				url: 'getData.php',
    				dataType: 'json',
    				delay: 250,
    				data: function (params) {
    					return {
    						type: "return-products",
    						purchase_no: purchaseNo,
    						supplier_id: supplierId,
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
    								stock: item.quantity,
    								already_returned: item.already_returned
    							};
    						})
    					};
    				},
    				cache: true
    			}
    		});
    	});

	    // Remove row when trash icon clicked
	    $(document).on('click', '.remove-row', function() {
	    	$(this).closest('tr').remove();
	    });

	    $('#productReturnSelect').on('select2:select', function (e) {
	    	let data = e.params.data;
	    	let productId = data.id;
	    	let productName = data.text;
	    	let price = parseFloat(data.price) || 0;
	    	let stock = parseInt(data.stock) || 0;
	    	//let stock = parseInt(data.purchased_qty) || 0;
	    	let alreadyReturned = parseInt(data.already_returned) || 0;
	    	let maxReturnable = stock - alreadyReturned;

	    	if (!productId) return;

	    	// 🚫 If no stock left for return
	    	if (maxReturnable <= 0) {
	    		alert("❌ Stock not available for return.");
		        // Reset dropdown
		        $('#productReturnSelect').val(null).trigger('change');
		        return;
		    }

		    let existingRow = $('#purchaseReturnTable tbody tr').filter(function () {
		    	return $(this).find('input[name="product_id[]"]').val() == productId;
		    });

		    if (existingRow.length > 0) {
		        // ✅ Already exists → increase qty
		        let qtyInput = existingRow.find('input[name="return_qty[]"]');
		        let currentQty = parseInt(qtyInput.val()) || 0;
		        let newQty = currentQty + 1;

		        if (newQty > stock) {
		        	alert("❌ Stock not available for return.");
		        	return;
		        }
		        qtyInput.val(newQty).trigger('input');
		    } else {
		        // ➕ New product
		        let qty = 1, taxPerc = 0;

		        let subtotal = qty * price;
		        let taxAmount = (subtotal * taxPerc) / 100;
		        let unitCost = subtotal / qty;
		        let totalCost = subtotal + taxAmount;

		        let newRow = `
		        <tr>
		        <td>${productName}
		        <input type="hidden" name="product_id[]" value="${productId}">
		        <input type="hidden" name="prod_qty[]" value="${stock}">
		        </td>
		        <td>
		        <div class="input-group qty-control d-flex align-items-center">
		        <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-plus">+</button>
		        <input type="text" name="return_qty[]" class="form-control text-center mx-1" 
		        value="${qty}" min="1" max="${maxReturnable}" style="width:40px;">
		        <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-minus">-</button>
		        </div>
		        </td>
		        <td><input name="purchase_price[]" class="form-control" value="${price}" readonly></td>
		        <td><input type="number" name="tax_percentage[]" class="form-control" value="${taxPerc}" readonly></td>
		        <td><input type="text" name="tax_amount[]" class="form-control" value="${taxAmount.toFixed(2)}" readonly></td>
		        <td><input type="text" name="unit_cost[]" class="form-control" value="${unitCost.toFixed(2)}" readonly></td>
		        <td><input type="text" name="total_cost[]" class="form-control" value="${totalCost.toFixed(2)}" readonly></td>
		        <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
		        </tr>`;
		        $('#purchaseReturnTable tbody').append(newRow);
		    }

		    // Reset dropdown
		    $('#productReturnSelect').val(null).trigger('change');
		});

		// ✅ Plus button
		$(document).on('click', '.qty-plus', function () {
			let input = $(this).closest('tr').find('input[name="return_qty[]"]');
			let maxAllowed = parseInt(input.attr('max')) || 0;
			let currentQty = parseInt(input.val()) || 0;
			if (currentQty + 1 > maxAllowed) {
				alert("❌ Cannot return more than available quantity (" + maxAllowed + ").");
				return;
			}

			input.val(currentQty + 1).trigger('input');
		});

		// ✅ Minus button
		$(document).on('click', '.qty-minus', function () {
			let input = $(this).closest('tr').find('input[name="return_qty[]"]');
			let currentQty = parseInt(input.val()) || 0;

			if (currentQty > 1) {
				input.val(currentQty - 1).trigger('input');
			}
		});

		// ✅ Manual input validation + cost recalculation
		$(document).on('input', 'input[name="return_qty[]"]', function () {
			let row = $(this).closest('tr');
			let qty = parseFloat(row.find('input[name="return_qty[]"]').val()) || 0;
			let price = parseFloat(row.find('input[name="purchase_price[]"]').val()) || 0;
			let taxPerc = parseFloat(row.find('input[name="tax_percentage[]"]').val()) || 0;

			let subtotal = qty * price;
			let taxAmount = (subtotal * taxPerc) / 100;
			let unitCost = subtotal / (qty || 1);
			let totalCost = subtotal + taxAmount;

			row.find('input[name="tax_amount[]"]').val(taxAmount.toFixed(2));
			row.find('input[name="unit_cost[]"]').val(unitCost.toFixed(2));
			row.find('input[name="total_cost[]"]').val(totalCost.toFixed(2));

			let maxStock = parseInt($(this).attr('max')) || 0;
			if (qty > maxStock) {
				alert("❌ Quantity cannot exceed available quantity (" + maxStock + ").");
				$(this).val(maxStock).trigger('input');
			} else if (qty < 1) {
				$(this).val(1).trigger('input');
			}
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
	    $(document).on('click', '.btn-edit-purchase', function () {
	    	let id = $(this).data('purchase-id');

	    	$.getJSON("getData.php", { type: "get-purchase-return", return_id: id }, function (response) {
	    		if (response.status === "success") {
	    			let purchase = response.purchase;
	    			let items = response.items;

            		// Fill form fields
            		$("#edit_return_purchase_id").val(purchase.id);
            		$("#return_edit_supplier_id").val(purchase.supplier_id);
            		$("#return_edit_supplier").val(purchase.supplier_name);
            		$("#return_edit_purchase_date").val(purchase.return_date);
            		$("#return_edit_reference_no").val(purchase.purchase_no);
            		$("#return_edit_reference_id").val(purchase.purchase_id);
            		$("#return_edit_order_tax").val(purchase.order_tax || 0);
            		$("#return_edit_order_discount").val(purchase.discount || 0);
            		$("#return_edit_shipping").val(purchase.shipping || 0);
            		$("#return_edit_status").val(purchase.status);
            		$("#return_edit_description").val(purchase.description);

            		// Summary
            		$("#return_edit_summary_order_tax").text(parseFloat(purchase.order_tax || 0).toFixed(2));
            		$("#return_edit_summary_discount").text(parseFloat(purchase.discount || 0).toFixed(2));
            		$("#return_edit_summary_shipping").text(parseFloat(purchase.shipping || 0).toFixed(2));
            		$("#return_edit_summary_grand_total").text(parseFloat(purchase.total_return_amount || 0).toFixed(2));

            		// Fill items table
            		let tbody = $("#editPurchaseReturnTable tbody");
            		tbody.empty();
            		items.forEach(item => {
            			let maxReturnable = Math.max(0, item.stock);
            			tbody.append(`
            				<tr data-already-returned="${item.already_returned}">
            				<td>${item.name}<input type="hidden" name="product_id[]" value="${item.product_id}"><input type="hidden" name="prod_qty[]" value="${item.purchased_qty}"></td>
            				<td>
            				<div class="input-group qty-control d-flex align-items-center">
            				<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-minus">-</button>
            				<input type="number" name="edit_return_qty[]" class="form-control text-center mx-1"
            				value="${item.return_qty}" min="1" max="${maxReturnable}" style="width:60px;" readonly>
            				<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-plus">+</button>
            				</div>
            				</td>
            				<td><input type="number" name="purchase_price[]" class="form-control" value="${item.purchase_price}" readonly></td>
            				<td><input type="number" name="tax_percentage[]" class="form-control" value="${item.tax_percentage}" readonly></td>
            				<td><input type="number" name="tax_amount[]" class="form-control" value="${item.tax_amount}" readonly></td>
            				<td><input type="number" name="unit_cost[]" class="form-control" value="${item.unit_cost}" readonly></td>
            				<td><input type="number" name="total_cost[]" class="form-control" value="${item.total_return}" readonly></td>
            				<td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
            				</tr>
            				`);
            		});

            		$("#edit-sales-new").modal("show");
            	} else {
            		alert(response.message || "❌ Failed to fetch purchase details.");
            	}
            });
	    });


	    $(document).on("click", "#editPurchaseReturnTable .edit-qty-plus", function () {
	    	let row = $(this).closest("tr");
	    	let input = row.find("input[name='edit_return_qty[]']");
	    	let current = parseInt(input.val()) || 0;

    		// Purchased qty of this product
    		let purchasedQty = parseInt(row.find("input[name='prod_qty[]']").val()) || 0;

    		// Already returned in other returns (we store it as data attr when loading)
    		let alreadyReturned = parseInt(row.data("already-returned")) || 0;

    		// ✅ Max returnable = purchased - alreadyReturned
    		let maxAllowed = purchasedQty - alreadyReturned;
    		if (current + 1 > maxAllowed) {
    			alert("❌ Quantity cannot exceed available quantity (" + maxAllowed + ")");
    			return;
    		}

    		input.val(current + 1).trigger("input");
    		recalcRow(row);
    		updateEditSummary();
    	});

	    $(document).on("click", "#editPurchaseReturnTable .edit-qty-minus", function () {
	    	let input = $(this).closest("tr").find("input[name='edit_return_qty[]']");
	    	let current = parseInt(input.val()) || 0;

	    	if (current > 1) {
	    		input.val(current - 1).trigger("input");
	    		recalcRow($(this).closest("tr"));
	    		updateEditSummary();
	    	}
	    });

		// === Remove Row ===
		$(document).on("click", "#editPurchaseReturnTable .remove-row", function () {
			$(this).closest("tr").remove();
			updateEditSummary();
		});

		// === Recalc Row ===
		function recalcRow(row) {
			let qty = parseFloat(row.find('input[name="edit_return_qty[]"]').val()) || 0;
			let price = parseFloat(row.find('input[name="purchase_price[]"]').val()) || 0;
			let taxPerc = parseFloat(row.find('input[name="tax_percentage[]"]').val()) || 0;

			let subtotal = qty * price;
			let taxAmount = (subtotal * taxPerc) / 100;
			let unitCost = subtotal / (qty || 1);
			let totalCost = subtotal + taxAmount;

			row.find('input[name="tax_amount[]"]').val(taxAmount.toFixed(2));
			row.find('input[name="unit_cost[]"]').val(unitCost.toFixed(2));
			row.find('input[name="total_cost[]"]').val(totalCost.toFixed(2));
		}

		// === Update Summary ===
		function updateEditSummary() {
			let subtotal = 0;
			$("#editPurchaseReturnTable tbody tr").each(function () {
				subtotal += parseFloat($(this).find('input[name="total_cost[]"]').val()) || 0;
			});

			let tax = parseFloat($("#return_edit_order_tax").val()) || 0;
			let discount = parseFloat($("#return_edit_order_discount").val()) || 0;
			let shipping = parseFloat($("#return_edit_shipping").val()) || 0;

			$("#return_edit_summary_order_tax").text(tax.toFixed(2));
			$("#return_edit_summary_discount").text(discount.toFixed(2));
			$("#return_edit_summary_shipping").text(shipping.toFixed(2));

			let grandTotal = subtotal + tax + shipping - discount;
			$("#return_edit_summary_grand_total").text(grandTotal.toFixed(2));
		}

		// Product select2 for edit
		$('#editProductReturnSelect').select2({
			placeholder: "Search Product",
			width: '100%',
			dropdownParent: $('#edit-sales-new'),
			ajax: {
				url: 'getData.php',
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						type: "return-products",
						purchase_no: $('#return_edit_reference_id').val(),
						supplier_id: $('#return_edit_supplier_id').val(),
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
								stock: item.quantity,
								already_returned: item.already_returned
							};
						})
					};
				},
				cache: true
			}
		});

		// On product select
		let prod = 0;
		$('#editProductReturnSelect').on('select2:select', function (e) {
			let data = e.params.data;
			let productId = data.id;
			let productName = data.text;
			let price = parseFloat(data.price) || 0;
			let stock = parseInt(data.stock) || 0;
			
			let alreadyReturned = parseInt(data.already_returned) || 0;
			let maxReturnable = stock - alreadyReturned - prod;
			if (!productId) return;
			if (maxReturnable <= 0) {
				alert("❌ Stock not available for return.");
				$(this).val(null).trigger('change');
				return;
			}

			let existingRow = $('#editPurchaseReturnTable tbody tr').filter(function () {
				return $(this).find('input[name="product_id[]"]').val() == productId;
			});

			if (existingRow.length > 0) {
				prod = prod + 1;
				if (prod > maxReturnable) {
					alert("Stock not available for return.");
					return;
				}
				let qtyInput = existingRow.find('input[name="edit_return_qty[]"]');
				let currentQty = parseInt(qtyInput.val()) || 0;
				let newQty = currentQty + prod;
				qtyInput.val(newQty).trigger('input');
			} else {
				let qty = 1, taxPerc = 0;
				let subtotal = qty * price;
				let taxAmount = (subtotal * taxPerc) / 100;
				let unitCost = subtotal / qty;
				let totalCost = subtotal + taxAmount;

				let newRow = `
				<tr data-already-returned="${alreadyReturned}">
				<td>${productName}
				<input type="hidden" name="product_id[]" value="${productId}">
				<input type="hidden" name="prod_qty[]" value="${stock}">
				</td>
				<td>
				<div class="input-group qty-control d-flex align-items-center">
				<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-minus">-</button>
				<input type="number" name="edit_return_qty[]" class="form-control text-center mx-1"
				value="${qty}" min="1" max="${maxReturnable}" style="width:60px;" readonly>
				<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-plus">+</button>
				</div>
				</td>
				<td><input name="purchase_price[]" class="form-control" value="${price}" readonly></td>
				<td><input type="number" name="tax_percentage[]" class="form-control" value="${taxPerc}" readonly></td>
				<td><input type="text" name="tax_amount[]" class="form-control" value="${taxAmount.toFixed(2)}" readonly></td>
				<td><input type="text" name="unit_cost[]" class="form-control" value="${unitCost.toFixed(2)}" readonly></td>
				<td><input type="text" name="total_cost[]" class="form-control" value="${totalCost.toFixed(2)}" readonly></td>
				<td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
				</tr>`;
				$('#editPurchaseReturnTable tbody').append(newRow);
			}
			$(this).val(null).trigger('change');
			updateEditSummary();
		});

		// Save changes
		$("#editPurchaseReturnForm").on("submit", function(e) {
			e.preventDefault();

			$.ajax({
				url: "purchase-returns-update.php",
				type: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function(res) {
					if (res.status === "success") {
						alert("✅ Purchase Return updated successfully!");
						$("#edit-sales-new").modal("hide");
						location.reload();
					} else {
						alert("❌ " + (res.message || "Error updating purchase"));
					}
				}
			});
		});

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