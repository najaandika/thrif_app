try {
    localStorage.removeItem('darkMode');
    document.documentElement.classList.remove('dark');
    document.documentElement.style.backgroundColor = 'rgb(249 250 251)';
} catch (e) {}

// Import dependencies
import './bootstrap';           // Axios setup and basic configurations

import './ripple-effect';       // Material Design ripple effects
import './pos';                 // POS page input formatting & Livewire helpers
import './swal';                // SweetAlert helpers (confirmDelete, etc)
import './products';            // Admin products delete helper (SweetAlert wrapper)
import { initHeader } from './landing/header';
import { initProducts } from './landing/products';
import { initLoginModal } from './landing/login-modal';
import { initScrollAnimations } from './scroll-animations';
import { checkoutFormData } from './checkout-form';  // Checkout form AlpineJS data
import { initCheckoutAlerts } from './checkout-alerts';  // Checkout success alerts
import './receipt-modal'; // Receipt Modal logic
import './currency-input'; // Shared Currency Input logic

// Make checkout form data globally available
window.checkoutFormData = checkoutFormData;

/**
 * Chart Re-rendering for Livewire Navigation
 * 
 * When Livewire navigates between pages (wire:navigate),
 * the DOM is updated but DOMContentLoaded doesn't fire again.
 * We need to re-render the chart after Livewire navigation.
 */
document.addEventListener('livewire:navigated', () => {
    initHeader();
    initProducts();
    initLoginModal();
    initScrollAnimations();
    initCheckoutAlerts();
});

// Initialize on first load as well
document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initProducts();
    initLoginModal();
    initScrollAnimations();
    initCheckoutAlerts();
});


