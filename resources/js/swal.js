// resources/js/swal.js
import Swal from 'sweetalert2';

// Expose Swal globally so other scripts (like checkout-alerts.js) can use it without importing
window.Swal = Swal;

const swalConfig = {
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal',
    width: '320px',
    padding: '1rem',
    customClass: {
        popup: 'swal-compact',
        title: 'swal-title-compact',
        htmlContainer: 'swal-text-compact',
        confirmButton: 'swal-btn-compact',
        cancelButton: 'swal-btn-compact'
    }
};

window.showDeleteConfirmation = function (id, title, eventName) {
    Swal.fire({
        ...swalConfig,
        title: title,
        text: 'Data yang dihapus tidak bisa dikembalikan!'
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
