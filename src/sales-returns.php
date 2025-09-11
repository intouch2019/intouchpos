<?php ob_start();
require_once __DIR__ . '/../partials/config.php';

// Get filter parameters
$customer_filter = $_GET['customer'] ?? '';
$status_filter = $_GET['status'] ?? '';
$payment_filter = $_GET['payment'] ?? '';
$sort_by_filter = $_GET['sort_by'] ?? '';

// Build WHERE clause
$where_conditions = [];
$params = [];
$types = '';

if (!empty($customer_filter)) {
	$where_conditions[] = "c.name LIKE ?";
	$params[] = "%$customer_filter%";
	$types .= 's';
}

if (!empty($status_filter)) {
	$where_conditions[] = "s.status LIKE ?";
	$params[] = "%$status_filter%";
	$types .= 's';
}

if (!empty($payment_filter)) {
	if ($payment_filter == 'paid') {
		$where_conditions[] = "s.grand_total = 0";
	} elseif ($payment_filter == 'unpaid') {
		$where_conditions[] = "s.grand_total > 0";
	} elseif ($payment_filter == 'overdue') {
        // adjust if you have due_date column, otherwise just example
		$where_conditions[] = "s.grand_total > 0";
	}
}

// Sorting
$order_by = "s.created_at DESC"; // default
if (!empty($sort_by_filter)) {
	switch ($sort_by_filter) {
		case 'today':
		$where_conditions[] = "DATE(s.created_at) = CURDATE()";
		break;
		case 'last_7_days':
		$where_conditions[] = "s.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
		break;
		case 'last_month':
		$where_conditions[] = "s.created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
		break;
		case 'asc':
		$order_by = "s.created_at ASC";
		break;
		case 'desc':
		$order_by = "s.created_at DESC";
		break;
	}
}
// Get sales returns with filters
$sales_returns = [];
$sql_sales = "SELECT DISTINCT s.*, COALESCE(c.name, 'Walk in Customer') AS cust_name
FROM sales_returns s
LEFT JOIN customers c ON s.customer_id = c.id";

if (!empty($where_conditions)) {
	$sql_sales .= " WHERE " . implode(' AND ', $where_conditions);
}

$sql_sales .= " ORDER BY $order_by";

if (!empty($params)) {
	$stmt = mysqli_prepare($link, $sql_sales);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, $types, ...$params);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_assoc($result)) {
			$sales_returns[] = $row;
		}
		mysqli_stmt_close($stmt);
	}
} else {
	$result = mysqli_query($link, $sql_sales);
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$sales_returns[] = $row;
		}
	}
}

$payment = ['paid', 'unpaid', 'overdue'];
$status = ['Pending', 'Received'];

// Get all sales_returns with product names for JavaScript filtering
$all_returns_sql = "SELECT DISTINCT s.*, COALESCE(c.name, 'Walk in Customer') AS cust_name 
FROM sales_returns s
LEFT JOIN customers c ON s.customer_id = c.id
ORDER BY s.created_at DESC";
$all_return_result = mysqli_query($link, $all_returns_sql);
$all_sales_return = [];
if ($all_return_result) {
    while ($row = mysqli_fetch_assoc($all_return_result)) {
        $all_sales_return[] = $row;
    }
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
					<h4>Sales Return</h4>
					<h6>Manage your returns</h6>
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
				<a href="javascript:void(0);" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add-sales-return-new"><i class="ti ti-circle-plus me-1"></i>Add Sales Return</a>
			</div>
		</div>

		<div class="card">
			<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
				<div class="search-set">
					<div class="search-input">
						<span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
					</div>
				</div>
				<div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
					<div class="dropdown me-2">
						<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="customer-filter-btn">
							Customer
						</a>
						<ul class="dropdown-menu dropdown-menu-end p-3">
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('customer', '')">All Customers</a></li>
							<?php 
							$custRes = mysqli_query($link, "SELECT id, name FROM customers ORDER BY name ASC");
							while($cust = mysqli_fetch_assoc($custRes)): ?>
								<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('customer', '<?= htmlspecialchars($cust['name']) ?>')"><?= htmlspecialchars($cust['name']) ?></a></li>
							<?php endwhile; ?>
						</ul>
						
					</div>
					<div class="dropdown me-2">
						<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="status-filter-btn">
							Status
						</a>
						<ul class="dropdown-menu dropdown-menu-end p-3">
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('status', '')">All</a></li>
							<?php foreach($status as $sts): ?>
								<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('status', '<?=$sts ?>')"><?= ucfirst($sts) ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="dropdown me-2">
						<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="payment-filter-btn">
							Payment Status
						</a>
						<ul class="dropdown-menu dropdown-menu-end p-3">
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('payment', '')">All</a></li>
							<?php foreach($payment as $pt): ?>
								<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('payment', '<?= $pt ?>')"><?= ucfirst($pt) ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown" id="sort_by-filter-btn">
							Sort By
						</a>
						<ul class="dropdown-menu dropdown-menu-end p-3">
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('sort_by', '')">All</a></li>
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('sort_by', 'today')">Recently Added</a></li>
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('sort_by', 'asc')">Ascending</a></li>
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('sort_by', 'desc')">Descending</a></li>
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('sort_by', 'last_7_days')">Last 7 Days</a>
							</li>
							<li><a href="javascript:void(0);" class="dropdown-item rounded-1" onclick="applyFilter('sort_by', 'last_month')">Last Month</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table datatable">
						<thead class="thead-light">
							<tr>
								<th class="no-sort">
									<label class="checkboxs">
										<input type="checkbox" id="select-all">
										<span class="checkmarks"></span>
									</label>
								</th>
								<th>Order No</th>
								<th>Date</th>
								<th>Customer</th>
								<th>Status</th>
								<th>Total</th>
								<th>Paid</th>
								<th>Due</th>
								<th>Payment Status</th>
								<th class="no-sort">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($sales_returns)): ?>
								<?php foreach ($sales_returns as $sr): ?>
									<tr>
										<td>
											<label class="checkboxs">
												<input type="checkbox" name="selected[]" value="<?= $sr['id'] ?>">
												<span class="checkmarks"></span>
											</label>
										</td>
										<td><?= htmlspecialchars($sr['order_no']) ?></td>
										<td><?= date("d M Y", strtotime($sr['return_date'])) ?></td>
										<td>
											<?= htmlspecialchars($sr['cust_name']) ?>
										</td>
										<td>
											<?php if ($sr['status'] == 'Received'): ?>
												<span class="badge badge-success shadow-none">Received</span>
												<?php 
											else: 
												?>
												<span class="badge badge-warning shadow-none"><?= htmlspecialchars($sr['status']) ?></span>
											<?php endif; ?>
										</td>
										<td><?= number_format($sr['grand_total'], 2) ?></td>
										<td>0.00</td>
										<td><?= number_format(($sr['grand_total']), 2) ?></td>
										<td>
											<?php
											$due = $sr['grand_total'] - (0);
											if ($due <= 0) {
												echo '<span class="badge badge-soft-success badge-xs shadow-none">Paid</span>';
											} else {
												echo '<span class="badge badge-soft-danger badge-xs shadow-none">Unpaid</span>';
											}
											?>
										</td>
										<td class="dflex">
											<div class="edit-delete-action d-flex align-items-center">
												<a class="me-2 p-2 btn-edit-sales-return" data-return-id="<?php echo $sr['id']; ?>" data-bs-toggle="modal" data-bs-target="#edit-sales-return-new">
													<i data-feather="edit" class="feather-edit"></i>
												</a>
												<a class="p-2 d-flex align-items-center border rounded btn-delete-sales" data-del-return-id="<?php echo $sr['id']; ?>">
													<i data-feather="trash-2" class="feather-trash-2"></i>
												</a>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
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

		// 🔹 Search on input
		$("#customerSearch").on("input", function () {
			let search = $(this).val().trim();

			if (search.length === 0) {
				$("#customerName").hide();
				return;
			}

			$.ajax({
				url: "getData.php",
				method: "GET",
				data: {
	                type: "customers",  // ask PHP for customers
	                search: search
	            },
	            dataType: "json",
	            success: function (response) {
	            	let suggestionBox = $("#customerName");
	                suggestionBox.empty(); // clear old suggestions

	                if (response.length > 0) {
	                	response.forEach(function (item) {
	                		let label = item.name + " (" + item.phone + ")";
	                		suggestionBox.append(
	                			`<div class="suggestion-item p-2 border-bottom" 
	                			data-id="${item.id}" 
	                			data-name="${item.name}">
	                			${label}
	                			</div>`
	                			);
	                	});
	                	suggestionBox.show();
	                } else {
	                	suggestionBox.hide();
	                }
	            }
	        });
		});

	    // 🔹 Click on suggestion
	    $(document).on("click", ".suggestion-item", function () {
	    	let id = $(this).data("id");
	    	let name = $(this).data("name");

	    	$("#customerSearch").val(name);
	        $("#sales_return_customer").val(id); // hidden input with ID
	        $("#customerName").hide();

	        // Trigger change event so dependent dropdowns reset
	        $("#sales_return_customer").trigger("change");
	    });

	    // 🔹 Hide suggestions if clicked outside
	    $(document).on("click", function (e) {
	    	if (!$(e.target).closest("#customerSearch, #customerName").length) {
	    		$("#customerName").hide();
	    	}
	    });

	    // 🔹 When customer is selected, reset order no & product table
	    $('#sales_return_customer').on('change', function () {
	    	let custId = $(this).val();

	        // Reset purchase_reference & product select
	        $('#sales_return_order_no').empty().trigger('change');

	        if ($.fn.select2 && $('#salesReturnProductSelect').hasClass("select2-hidden-accessible")) {
	        	$('#salesReturnProductSelect').select2('destroy');
	        	$('#salesReturnProductSelect').empty();
	        }

	        // Empty product table + reset total
	        $('#salesReturnTable tbody').empty();
	        $("#grandTotal").text("0.00");

	        if (!custId) return;

	        // Initialize searchable purchase_reference dropdown
	        $('#sales_return_order_no').select2({
	        	placeholder: "Search Order No",
	        	width: '100%',
	        	dropdownParent: $('#add-sales-return-new'),
	        	allowClear: true,
	        	ajax: {
	        		url: 'getData.php',
	        		dataType: 'json',
	        		delay: 250,
	        		data: function (params) {
	        			return {
	        				type: "order_references",
	        				cust_id: custId,
	        				search: params.term || ''
	        			};
	        		},
	        		processResults: function (data) {
	        			return {
	        				results: $.map(data, function (ref) {
	        					return {
	        						id: ref.id,
	        						text: ref.order_number
	        					};
	        				})
	        			};
	        		},
	        		cache: true
	        	}
	        });
	    });

		// Re-init product select when reference changes
		$('#sales_return_order_no').on('change', function () {
			let orderId = $(this).val();
			let custId = $('#sales_return_customer').val();

			// 🔹 Empty product table when order changes
			$('#salesReturnTable tbody').empty();
			$("#grandTotal").text("0.00");

			if (!orderId) {
				$('#salesReturnProductSelect').html('<option value="">Search Product</option>');
				return;
			}

			// If already initialized, destroy to avoid duplicate
			if ($.fn.select2 && $('#salesReturnProductSelect').hasClass("select2-hidden-accessible")) {
				$('#salesReturnProductSelect').select2('destroy');
			}

			// Initialize select2 with reference filter
			$('#salesReturnProductSelect').select2({
				placeholder: "Search Product",
				width: '100%',
				dropdownParent: $('#add-sales-return-new'),
				ajax: {
					url: 'getData.php',
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							type: "sales-return-products",
							order_id: orderId,
							cust_id: custId,
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
									price: item.unit_price,
									stock: item.ordered_qty,
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
		$(document).on('click', '.remove-row', function () {
			$(this).closest('tr').remove();
			updateGrandTotal();
		});

		// ---------- COMMON CONTROLS ----------
		$(document).on('click', '.qty-plus', function () {
			let input = $(this).siblings('input[name="quantity[]"]');
			let max = parseInt(input.attr('max')) || 9999;
			let current = parseInt(input.val()) || 0;
			if (current < max) {
				input.val(current + 1).trigger('input');
			} else {
				alert("⚠️ Quantity cannot exceed available stock!");
			}
		});

		$(document).on('click', '.qty-minus', function () {
			let input = $(this).siblings('input[name="quantity[]"]');
			let min = parseInt(input.attr('min')) || 1;
			let current = parseInt(input.val()) || 0;
			if (current > min) input.val(current - 1).trigger('input');
			updateRowSubtotal($(this).closest('tr'));
		});

		// Update subtotal when qty, discount, or tax changes
		$(document).on('input', 'input[name="quantity[]"], input[name="discount[]"], input[name="tax_percentage[]"]', function () {
			updateRowSubtotal($(this).closest('tr'));
		});

		// Function to update row subtotal
		function updateRowSubtotal(row) {
			let qty = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
			let price = parseFloat(row.find('input[name="unit_price[]"]').val()) || 0;
			let discount = parseFloat(row.find('input[name="discount[]"]').val()) || 0;
			let taxPerc = parseFloat(row.find('input[name="tax_percentage[]"]').val()) || 0;

			let subtotal = (qty * price) - discount;
			let taxAmount = subtotal * (taxPerc / 100);
			let total = subtotal + taxAmount;

			row.find('input[name="subtotal[]"]').val(total.toFixed(2));

			updateGrandTotal();
		}

		// Function to update Grand Total section
		function updateGrandTotal() {
			let grandTotal = 0;
			$('#salesReturnTable tbody tr').each(function () {
				let subtotal = parseFloat($(this).find('input[name="subtotal[]"]').val()) || 0;
				grandTotal += subtotal;
			});
			$("#grandTotal").text(grandTotal.toFixed(2));
		}


		// Add row when product is selected
		$('#salesReturnProductSelect').on('select2:select', function (e) {
			let data = e.params.data;
			let productId = data.id;
			let productName = data.text;
			let price = parseFloat(data.price) || 0;
			let stock = parseInt(data.stock) || 0;
			let qty = 1, discount = 0, taxPerc = 0;
			let subtotal = qty * price;

		    // If exists → increase qty
		    let existingRow = $('#salesReturnTable tbody tr').filter(function () {
		    	return $(this).find('input[name="product_id[]"]').val() == productId;
		    });

		    if (existingRow.length > 0) {
		    	let qtyInput = existingRow.find('input[name="quantity[]"]');
		    	let currentQty = parseInt(qtyInput.val()) || 0;

		    	if (currentQty < stock) {
		    		qtyInput.val(currentQty + 1).trigger('input');
		    		alert("ℹ️ Product already added, quantity increased!");
		    	} else {
		    		alert("⚠️ Cannot add more, stock limit reached!");
		    	}
		    } else {
		    	let newRow = `
		    	<tr>
		    	<td>${productName}<input type="hidden" name="product_id[]" value="${productId}"></td>
		    	<td><input type="text" name="unit_price[]" value="${price}" class="form-control" readonly></td>
		    	<td>${stock}</td>
		    	<td>
		    	<div class="input-group qty-control d-flex align-items-center">
		    	<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-plus">+</button>
		    	<input type="text" name="quantity[]" class="form-control text-center mx-1" value="${qty}" min="1" max="${stock}" style="width:60px;">
		    	<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle qty-minus">-</button>
		    	</div>
		    	</td>
		    	<td><input type="number" name="discount[]" value="${discount}" class="form-control"></td>
		    	<td><input type="number" name="tax_percentage[]" value="${taxPerc}" class="form-control"></td>
		    	<td><input type="text" name="subtotal[]" value="${subtotal.toFixed(2)}" class="form-control" readonly></td>
		    	<td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
		    	</tr>`;
		    	$('#salesReturnTable tbody').append(newRow);
		    }

		    updateGrandTotal();
		    $('#salesReturnProductSelect').val(null).trigger('change');
		});
	}); 

	$(document).ready(function () { //

	    // Product select2 for edit
	    $('#editSalesReturnProductSelect').select2({
	    	placeholder: "Search Product",
	    	width: '100%',
	    	dropdownParent: $('#edit-sales-return-new'),
	    	ajax: {
	    		url: 'getData.php',
	    		dataType: 'json',
	    		delay: 250,
	    		data: function (params) {
	    			return {
	    				type: "sales-return-products",
	    				order_id: $('#return_edit_order_id').val(),
	    				customer_id: $('#return_edit_customer_id').val(),
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
	    						price: item.unit_price,
	    						stock: item.ordered_qty,
	    						already_returned: item.already_returned
	    					};
	    				})
	    			};
	    		},
	    		cache: true
	    	}
	    });

	    // Add product to table
	    let prod = 0;
	    $('#editSalesReturnProductSelect').on('select2:select', function (e) {
	    	let data = e.params.data;
	    	let productId = data.id,
	    	productName = data.text,
	    	price = parseFloat(data.price),
	    	stock = parseInt(data.stock),
	    	qty = 1,
	    	discount = 0,
	    	taxPerc = 0;
	    	let alreadyReturned = parseInt(data.already_returned) || 0;
	    	let subtotal = qty * price;
	    	let maxReturnable = stock - alreadyReturned - prod;

	    	if (maxReturnable <= 0) {
	    		alert("❌ Stock not available for return.");
	    		$(this).val(null).trigger('change');
	    		return;
	    	}

	    	let existingRow = $('#editSalesReturnTable tbody tr').filter(function () {
	    		return $(this).find('input[name="product_id[]"]').val() == productId;
	    	});

	    	if (existingRow.length) {
	    		prod = prod + 1;
	    		if (prod <= maxReturnable) {
	    			let qtyInput = existingRow.find('input[name="quantity[]"]');
	    			let currentQty = parseInt(qtyInput.val());
	    			qtyInput.val(currentQty + 1).trigger('input');
	    			alert("ℹ️ Product already added, quantity increased!");
	    		} else {
	    			alert("⚠️ Cannot add more, stock limit reached!");
	    		}
	    	} else {
	    		let newRow = `
	    		<tr data-already-returned="${alreadyReturned}">
	    		<td>${productName}<input type="hidden" name="product_id[]" value="${productId}"></td>
	    		<td><input type="text" name="unit_price[]" value="${price}" class="form-control" readonly></td>
	    		<td>${stock}<input type="hidden" name="prod_qty[]" value="${stock}"></td>
	    		<td>
	    		<div class="input-group qty-control d-flex align-items-center">
	    		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-plus">+</button>
	    		<input type="text" name="quantity[]" class="form-control text-center mx-1" value="${qty}" min="1" max="${stock}" style="width:60px;">
	    		<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-minus">-</button>
	    		</div>
	    		</td>
	    		<td><input type="number" name="discount[]" value="${discount}" class="form-control"></td>
	    		<td><input type="number" name="tax_percentage[]" value="${taxPerc}" class="form-control"></td>
	    		<td><input type="text" name="subtotal[]" value="${subtotal.toFixed(2)}" class="form-control" readonly></td>
	    		<td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
	    		</tr>`;
	    		$('#editSalesReturnTable tbody').append(newRow);
	    	}

	    	updateEditGrandTotal();
	    	$('#editSalesReturnProductSelect').val(null).trigger('change');
	    });

	    // Quantity plus
	    $(document).on("click", ".edit-qty-plus", function () {
	    	let row = $(this).closest("tr");
	    	let input = row.find("input[name='quantity[]']");
	    	let current = parseInt(input.val()) || 0;

    		// Purchased qty of this product
    		let orderedQty = parseInt(row.find("input[name='prod_qty[]']").val()) || 0;

    		// Already returned in other returns (we store it as data attr when loading)
    		let alreadyReturned = parseInt(row.data("already-returned")) || 0;

    		// ✅ Max returnable = purchased - alreadyReturned
    		let maxAllowed = orderedQty - alreadyReturned;
    		//alert(current);alert(orderedQty);alert(alreadyReturned);alert(maxAllowed);
    		if (current + 1 > maxAllowed) {
    			alert("⚠️ Cannot add more, stock limit reached!");
    			return;
    		}

    		input.val(current + 1).trigger("input");
    	});

	    // Quantity minus
	    $(document).on('click', '.edit-qty-minus', function () {
	    	let input = $(this).siblings('input[name="quantity[]"]');
	    	let min = parseInt(input.attr('min')) || 1;
	    	let current = parseInt(input.val()) || 0;
	    	if (current > min) input.val(current - 1).trigger('input');
	    });

	    // Remove row
	    $(document).on('click', '#editSalesReturnTable .remove-row', function () {
	    	$(this).closest('tr').remove();
	    	updateEditGrandTotal();
	    });

	    // Update subtotal on change
	    $(document).on('input', '#editSalesReturnTable input[name="quantity[]"], #editSalesReturnTable input[name="discount[]"], #editSalesReturnTable input[name="tax_percentage[]"]', function () {
	    	let row = $(this).closest('tr');
	    	let qty = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
	    	let price = parseFloat(row.find('input[name="unit_price[]"]').val()) || 0;
	    	let discount = parseFloat(row.find('input[name="discount[]"]').val()) || 0;
	    	let taxPerc = parseFloat(row.find('input[name="tax_percentage[]"]').val()) || 0;

	    	let subtotal = (qty * price - discount) * (1 + taxPerc / 100);
	    	row.find('input[name="subtotal[]"]').val(subtotal.toFixed(2));

	    	updateEditGrandTotal();
	    });

	    function updateEditGrandTotal() {
	    	let grandTotal = 0;
	    	$('#editSalesReturnTable tbody tr').each(function () {
	    		let subtotal = parseFloat($(this).find('input[name="subtotal[]"]').val()) || 0;
	    		grandTotal += subtotal;
	    	});
	    	$("#editGrandTotal").text(grandTotal.toFixed(2));
	    }

	    // Load sales return details in modal
	    $(document).on('click', '.btn-edit-sales-return', function () {
	    	let id = $(this).data('return-id');

	    	$.getJSON("getData.php", { type: "get-sales-return", return_id: id }, function (res) {
	    		if (res.status === "success") {
	    			let salesReturn = res.sales;
	    			let items = res.items;

	    			$("#edit_sales_return_id").val(salesReturn.id);
	    			$("#return_edit_customer_id").val(salesReturn.customer_id);
	    			$("#return_edit_customer").val(salesReturn.cust_name);
	    			$("#return_edit_order_no").val(salesReturn.order_no);
	    			$("#return_edit_order_id").val(salesReturn.order_id);
	    			$("#edit_sales_return_date").val(salesReturn.return_date);
	    			$("#edit_order_tax_input").val(salesReturn.order_tax);
	    			$("#edit_order_discount_input").val(salesReturn.discount);
	    			$("#edit_order_shipping_input").val(salesReturn.shipping);
	    			$("#edit_sales_return_status").val(salesReturn.status);

	                // Summary
	                $("#editOrderTax").text(parseFloat(salesReturn.order_tax || 0).toFixed(2));
	                $("#editOrderDiscount").text(parseFloat(salesReturn.discount || 0).toFixed(2));
	                $("#editOrderShipping").text(parseFloat(salesReturn.shipping || 0).toFixed(2));
	                $("#editGrandTotal").text(parseFloat(salesReturn.grand_total || 0).toFixed(2));

	                let tbody = $("#editSalesReturnTable tbody");
	                tbody.empty();
	                items.forEach(item => {
	                	let subtotal = (item.return_qty * item.unit_price - item.discount) * (1 + item.tax_percentage / 100);
	                	let row = `<tr data-already-returned="${item.already_returned}">
	                	<td>${item.product_name}<input type="hidden" name="product_id[]" value="${item.product_id}"></td>
	                	<td><input type="text" name="unit_price[]" value="${item.unit_price}" class="form-control" readonly></td>
	                	<td>${item.prod_qty}<input type="hidden" name="prod_qty[]" value="${item.prod_qty}"></td>
	                	<td>
	                	<div class="input-group qty-control d-flex align-items-center">
	                	<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-plus">+</button>
	                	<input type="text" name="quantity[]" class="form-control text-center mx-1" value="${item.return_qty}" min="1" max="${item.stock}" style="width:60px;">
	                	<button type="button" class="btn btn-outline-secondary btn-sm rounded-circle edit-qty-minus">-</button>
	                	</div>
	                	</td>
	                	<td><input type="number" name="discount[]" value="${item.discount}" class="form-control"></td>
	                	<td><input type="number" name="tax_percentage[]" value="${item.tax_percentage}" class="form-control"></td>
	                	<td><input type="text" name="subtotal[]" value="${subtotal.toFixed(2)}" class="form-control" readonly></td>
	                	<td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
	                	</tr>`;
	                	tbody.append(row);
	                });

	                updateEditGrandTotal();
	                $("#edit-sales-return-new").modal("show");
	            } else {
	            	alert(res.message || "❌ Failed to fetch sales return details.");
	            }
	        });
	    });

	    // Handle update form submission
	    $("#editSalesReturnForm").on("submit", function(e) {
	    	e.preventDefault();

	    	$.ajax({
	    		url: "sales-returns-update.php",
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

	    $(document).on('click', '.btn-delete-sales', function() {
	    	let salesId = $(this).data('del-return-id');
	    	$("#delete_sales_return_id").val(salesId);
	    	$("#delete-sales-return").modal("show");
	    });

	    $('#confirmDeletePurchaseReturn').on('click', function() {
	    	let salesId = $("#delete_sales_return_id").val();
	    	if (!salesId) {
	    		alert("Invalid sales return ID");
	    		return;
	    	}

	    	$.ajax({
	    		url: "sales-returns-delete.php",
	    		type: "POST",
	    		data: { sales_id: salesId },
	    		dataType: "json",
	    		success: function(res) {
	    			if (res.status === "success") {
	    				$("#delete-sales-return").modal("hide");
	    				alert("Sales Return deleted successfully!");
		                location.reload(); // refresh table/list
		            } else {
		            	alert(res.message || "Error deleting sales.");
		            }
		        }
		    });
	    });

		// Save customer dynamically
		$('#customerForm').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: 'getData.php',
				type: 'POST',
		        data: $(this).serialize() + "&type=save_customer", // add type
		        dataType: 'json',
		        success: function(response) {
		        	if (response.success) {
		        		alert("Customer saved successfully!");
		                $('#customerForm')[0].reset(); // clear form
		                // if you use select2, reload dropdown
		                $('#customer_id').append(new Option(response.name, response.id, true, true)).trigger('change');
		            } else {
		            	alert("Error: " + response.message);
		            }
		        }
		    });
		});
	});

let allSalesReturn = <?= json_encode($all_sales_return) ?>;
let currentFilters = {
	customer: '',
	status: '',
	payment: '',
	sort_by: ''
};

function updateTable(orders) {
    // Destroy existing DataTable if it exists
    if ($.fn.DataTable.isDataTable('.datatable')) {
    	$('.datatable').DataTable().destroy();
    }

    const tbody = document.querySelector('.datatable tbody');
    tbody.innerHTML = '';

    orders.forEach(order => {
    	const due = order.grand_total - (order.paid_amount ?? 0);
    	const paymentStatus = due <= 0 
    	? '<span class="badge badge-soft-success badge-xs shadow-none">Paid</span>'
    	: '<span class="badge badge-soft-danger badge-xs shadow-none">Unpaid</span>';

    	const row = `
    	<tr>
    	<td>
    	<label class="checkboxs">
    	<input type="checkbox" name="selected[]" value="${order.id}">
    	<span class="checkmarks"></span>
    	</label>
    	</td>
    	<td>${order.order_no}</td>
    	<td>${order.return_date ? new Date(order.return_date).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) : ''}</td>
    	<td>${order.cust_name}</td>
    	<td>
    	${order.status === 'Received' 
    	? '<span class="badge badge-success shadow-none">Received</span>'
    	: `<span class="badge badge-warning shadow-none">${order.status}</span>`
    }
    </td>
    <td>${parseFloat(order.grand_total).toFixed(2)}</td>
    <td>${(order.paid_amount ?? 0).toFixed(2)}</td>
    <td>${due.toFixed(2)}</td>
    <td>${paymentStatus}</td>
    <td class="dflex">
    <div class="edit-delete-action d-flex align-items-center">
    <a class="me-2 p-2 btn-edit-sales-return" 
    data-return-id="${order.id}" 
    data-bs-toggle="modal" 
    data-bs-target="#edit-sales-return-new">
    <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="p-2 d-flex align-items-center border rounded btn-delete-sales" 
    data-del-return-id="${order.id}">
    <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
    </div>
    </td>
    </tr>
    `;
    tbody.innerHTML += row;
});

    // Reinitialize DataTable with new data
    $('.datatable').DataTable({
    	paging: true,
    	searching: false,
    	info: true,
    	lengthChange: false,
    	pageLength: 10
    });

    // Reinitialize feather icons
    if (typeof feather !== 'undefined') {
    	feather.replace();
    }
}

function filterSalesReturn() {
	let filtered = allSalesReturn.filter(sales_return => {

		if (currentFilters.customer) {
			if (!sales_return.cust_name || !sales_return.cust_name.includes(currentFilters.customer)) {
				return false;
			}
		}

		if (currentFilters.status) {
			if (!sales_return.status || sales_return.status !== currentFilters.status) {
				return false;
			}
		}

		if (currentFilters.payment) {
			let gt = parseFloat(sales_return.grand_total || 0);

			if (currentFilters.payment === 'paid' && gt <= 0) {
				return false;
			}
			if (currentFilters.payment === 'unpaid' && gt > 0) {
				return false;
			}
			if (currentFilters.payment === 'overdue') {
				let createdDate = new Date(sales_return.created_at);
				let thirtyDaysAgo = new Date();
				thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);

				if (!(gt > 0 && createdDate < thirtyDaysAgo)) {
					return false;
				}
			}
		}

		if (currentFilters.sort_by) {
			const orderDate = new Date(sales_return.created_at);
			const now = new Date();

			switch (currentFilters.sort_by) {
				case 'today':
				if (orderDate.toDateString() !== now.toDateString()) return false;
				break;
				case 'last_7_days':
				const sevenDaysAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
				if (orderDate < sevenDaysAgo) return false;
				break;
				case 'last_month':
				const oneMonthAgo = new Date(now.getFullYear(), now.getMonth() - 1, now.getDate());
				if (orderDate < oneMonthAgo) return false;
				break;
			}
		}

		return true;
	});

	updateTable(filtered);
}

function getDateText(value) {
	switch(value) {
		case 'recent': return 'Recently Added';
		case 'asc': return 'Ascending';
		case 'desc': return 'Descending';
		case 'last_7_days': return 'Last 7 Days';
		case 'last_month': return 'Last Month';
		default: return 'All';
	}
}

function applyFilter(type, value) {
	currentFilters[type] = value;

	const btnTexts = {
		customer: value || 'Customer',
		status: value || 'Status',
		payment: value ? value.charAt(0).toUpperCase() + value.slice(1) : 'Payment Status',
		sort_by: getDateText(value)
	};

	if (type === 'payment') {
		if (value === 'paid') btnTexts.payment = 'Paid';
		else if (value === 'unpaid') btnTexts.payment = 'Unpaid';
		else if (value === 'overdue') btnTexts.payment = 'Overdue';
	}

	if (btnTexts[type]) {
		document.getElementById(type + '-filter-btn').textContent = btnTexts[type];
	}
	filterSalesReturn();
}
</script>