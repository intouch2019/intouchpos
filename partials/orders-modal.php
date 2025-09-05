<!-- Orders -->
<div class="modal fade pos-modal" id="orders" tabindex="-1"  aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
					<h5 class="modal-title" >Orders</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="tabs-sets">
					<ul class="nav nav-tabs" id="myTabs" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="onhold-tab" data-bs-toggle="tab" data-bs-target="#onhold" type="button"   aria-controls="onhold" aria-selected="true" role="tab">Onhold</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="unpaid-tab" data-bs-toggle="tab" data-bs-target="#unpaid" type="button"   aria-controls="unpaid" aria-selected="false" role="tab">Unpaid</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid" type="button"   aria-controls="paid" aria-selected="false" role="tab">Paid</button>
						</li>
						</ul>
						<div class="tab-content" >
						<div class="tab-pane fade show active" id="onhold" role="tabpanel" aria-labelledby="onhold-tab">
							<div class="input-icon-start pos-search position-relative mb-3">
								<span class="input-icon-addon">
									<i class="ti ti-search"></i>
								</span>
								<input type="text" class="form-control" placeholder="Search Orders">
							</div>
							<div class="order-body" id="hold-orders">
								<div class="text-center p-3">
									<p>Loading orders...</p>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="unpaid" role="tabpanel" >
							<div class="input-icon-start pos-search position-relative mb-3">
								<span class="input-icon-addon">
									<i class="ti ti-search"></i>
								</span>
								<input type="text" class="form-control" placeholder="Search Orders">
							</div>
							<div class="order-body" id="unpaid-orders">
								<div class="text-center p-3">
									<p>Loading orders...</p>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="paid" role="tabpanel" >
							<div class="input-icon-start pos-search position-relative mb-3">
								<span class="input-icon-addon">
									<i class="ti ti-search"></i>
								</span>
								<input type="text" class="form-control" placeholder="Search Orders">
							</div>
							<div class="order-body" id="paid-orders">
								<div class="text-center p-3">
									<p>Loading orders...</p>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>