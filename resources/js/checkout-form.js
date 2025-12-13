// Checkout Form AlpineJS Data
export function checkoutFormData(prefill = {}) {
    return {
        deliveryMethod: 'shipping',
        buyerName: prefill.buyer_name || '',
        buyerContact: prefill.buyer_contact || '',
        shippingAddress: prefill.shipping_address || '',
        paymentMethod: 'cash',
        notes: prefill.notes || ''
    };
}
