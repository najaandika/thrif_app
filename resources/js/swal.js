// resources/js/swal.js
import Swal from 'sweetalert2';

// Expose Swal globally so other scripts (like checkout-alerts.js) can use it without importing
window.Swal = Swal;

const swalConfig = {
    iconHtml: '<span class="swal-delete-mark">!</span>',
    showCancelButton: true,
    reverseButtons: true,
    focusCancel: true,
    buttonsStyling: false,
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
    customClass: {
        popup: 'swal-admin-popup',
        icon: 'swal-admin-icon',
        title: 'swal-admin-title',
        htmlContainer: 'swal-admin-html',
        actions: 'swal-admin-actions',
        confirmButton: 'swal-admin-confirm-danger',
        cancelButton: 'swal-admin-cancel',
    }
};

window.showDeleteConfirmation = function (id, title, eventName) {
    Swal.fire({
        ...swalConfig,
        title: title,
        html: '<p class="swal-delete-copy">Data akan dihapus permanen dan tidak bisa dikembalikan.</p>'
    }).then((result) => {
        if (result.isConfirmed) {
            window.Livewire.dispatch(eventName, [id]);
        }
    });
};

window.confirmDelete = function (id) {
    window.showDeleteConfirmation(id, 'Yakin hapus data ini?', 'delete');
};

window.confirmDeleteTransaction = function (id) {
    window.showDeleteConfirmation(id, 'Yakin hapus transaksi ini?', 'deleteTransaction');
};
