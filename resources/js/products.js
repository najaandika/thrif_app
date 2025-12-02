export function confirmDeleteProduct(id) {
    if (typeof window.showDeleteConfirmation !== 'function') {
        console.error('showDeleteConfirmation helper not found');
        return;
    }

    window.showDeleteConfirmation(id, 'Yakin hapus data ini?', 'deleteProduct');
}

if (typeof window !== 'undefined') {
    window.confirmDeleteProduct = confirmDeleteProduct;
}
