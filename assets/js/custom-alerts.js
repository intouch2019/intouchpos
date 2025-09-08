// Custom Alert System for Professional Modals
class CustomAlert {
    constructor() {
        this.createAlertModal();
        this.createConfirmModal();
    }

    // Create alert modal structure
    createAlertModal() {
        const alertModal = `
            <div class="modal fade" id="customAlertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title" id="alertModalTitle">Alert</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="alert-icon mb-3">
                                    <i class="ti ti-info-circle text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <p id="alertModalMessage" class="mb-0"></p>
                            </div>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', alertModal);
    }

    // Create confirm modal structure
    createConfirmModal() {
        const confirmModal = `
            <div class="modal fade" id="customConfirmModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title" id="confirmModalTitle">Confirm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="confirm-icon mb-3">
                                    <i class="ti ti-help-circle text-warning" style="font-size: 3rem;"></i>
                                </div>
                                <p id="confirmModalMessage" class="mb-0"></p>
                            </div>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" id="confirmYesBtn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', confirmModal);
    }

    // Show alert modal
    showAlert(message, title = 'Alert', icon = 'info') {
        const modal = document.getElementById('customAlertModal');
        const titleEl = document.getElementById('alertModalTitle');
        const messageEl = document.getElementById('alertModalMessage');
        const iconEl = modal.querySelector('.alert-icon i');

        titleEl.textContent = title;
        messageEl.textContent = message;

        // Set icon based on type
        iconEl.className = this.getIconClass(icon);

        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    // Show confirm modal
    showConfirm(message, title = 'Confirm', icon = 'question') {
        return new Promise((resolve) => {
            const modal = document.getElementById('customConfirmModal');
            const titleEl = document.getElementById('confirmModalTitle');
            const messageEl = document.getElementById('confirmModalMessage');
            const iconEl = modal.querySelector('.confirm-icon i');
            const yesBtn = document.getElementById('confirmYesBtn');

            titleEl.textContent = title;
            messageEl.textContent = message;
            iconEl.className = this.getIconClass(icon);

            const bsModal = new bootstrap.Modal(modal);
            
            // Handle Yes button click
            const handleYes = () => {
                bsModal.hide();
                yesBtn.removeEventListener('click', handleYes);
                resolve(true);
            };

            // Handle modal close (No button or X button)
            const handleClose = () => {
                modal.removeEventListener('hidden.bs.modal', handleClose);
                yesBtn.removeEventListener('click', handleYes);
                resolve(false);
            };

            yesBtn.addEventListener('click', handleYes);
            modal.addEventListener('hidden.bs.modal', handleClose);

            bsModal.show();
        });
    }

    // Get icon class based on type
    getIconClass(type) {
        const iconMap = {
            'info': 'ti ti-info-circle text-primary',
            'success': 'ti ti-check-circle text-success',
            'warning': 'ti ti-alert-triangle text-warning',
            'error': 'ti ti-x-circle text-danger',
            'question': 'ti ti-help-circle text-warning'
        };
        return iconMap[type] || iconMap['info'];
    }
}

// Initialize custom alert system
const customAlert = new CustomAlert();

// Override default alert and confirm functions
window.showAlert = function(message, title = 'Alert', type = 'info') {
    customAlert.showAlert(message, title, type);
};

window.showConfirm = function(message, title = 'Confirm', type = 'question') {
    return customAlert.showConfirm(message, title, type);
};

// Success alert shorthand
window.showSuccess = function(message, title = 'Success') {
    customAlert.showAlert(message, title, 'success');
};

// Error alert shorthand
window.showError = function(message, title = 'Error') {
    customAlert.showAlert(message, title, 'error');
};

// Warning alert shorthand
window.showWarning = function(message, title = 'Warning') {
    customAlert.showAlert(message, title, 'warning');
};