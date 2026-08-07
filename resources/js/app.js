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
 * Dashboard Chart Rendering
 * 
 * Renders a donut chart showing Available vs Sold products
 * Uses Chart.js library for visualization
 */
async function renderStatusChart() {
    const canvas = document.getElementById('statusChart');
    if (!canvas) return; // Exit if chart canvas not found on page

    // Dynamically import Chart.js ONLY when needed (saves ~200kb on landing page)
    const { default: Chart } = await import('chart.js/auto');

    // Get data from canvas data attributes (set by Blade template)
    const available = Number(canvas.dataset.available || 0);
    const sold = Number(canvas.dataset.sold || 0);

    const ctx = canvas.getContext('2d');

    // Destroy existing chart instance to prevent memory leaks
    if (canvas._chartInstance) {
        canvas._chartInstance.destroy();
    }

    // Create new donut chart
    canvas._chartInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Sold'],
            datasets: [{
                data: [available, sold],
                backgroundColor: ['#22c55e', '#f97373'], // Green for available, Red for sold
                borderWidth: 0, // No borders for cleaner look
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%', // Creates donut hole (70% of radius)
            plugins: {
                legend: { display: false }, // Hide legend (we show it manually in HTML)
                tooltip: { enabled: true }, // Show tooltips on hover
            },
        },
    });
}

/**
 * Chart Initialization
 * 
 * Render chart on initial page load
 */
document.addEventListener('DOMContentLoaded', renderStatusChart);

/**
 * Chart Re-rendering for Livewire Navigation
 * 
 * When Livewire navigates between pages (wire:navigate),
 * the DOM is updated but DOMContentLoaded doesn't fire again.
 * We need to re-render the chart after Livewire navigation.
 */
document.addEventListener('livewire:navigated', () => {
    renderStatusChart();
    initHeader();
    initProducts();
    initLoginModal();
    initScrollAnimations();
    initCheckoutAlerts();
});

// Initialize on first load as well
document.addEventListener('DOMContentLoaded', () => {
    renderStatusChart();
    initHeader();
    initProducts();
    initLoginModal();
    initScrollAnimations();
    initCheckoutAlerts();
});


