// Import dependencies
import './bootstrap';           // Axios setup and basic configurations
import './scroll-animations';   // Custom scroll animation utilities
import './ripple-effect';       // Material Design ripple effects
import Chart from 'chart.js/auto';  // Chart.js for data visualization

/**
 * Dark Mode Management
 * 
 * IMPORTANT: This uses Livewire's bundled Alpine.js
 * - Livewire 3 includes Alpine.js automatically via @livewireScripts
 * - We listen to 'livewire:init' event (NOT 'alpine:init')
 * - Alpine is available as window.Alpine after Livewire initializes
 * 
 * The dark mode store provides:
 * - Persistent dark mode state (localStorage)
 * - System preference detection
 * - Toggle functionality for UI buttons
 */
document.addEventListener('livewire:init', () => {
    // Ensure Alpine is available before creating store
    if (window.Alpine) {
        window.Alpine.store('darkMode', {
            // Initialize from localStorage or system preference
            on: localStorage.getItem('darkMode') === 'true' ||
                (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),

            /**
             * Initialize dark mode on page load
             */
            init() {
                this.updateClass();
            },

            /**
             * Toggle dark mode on/off
             * Called by theme toggle buttons in navigation
             */
            toggle() {
                this.on = !this.on;
                localStorage.setItem('darkMode', this.on);
                this.updateClass();
            },

            /**
             * Apply/remove 'dark' class to <html> element
             * Tailwind CSS uses this class for dark mode styles
             */
            updateClass() {
                if (this.on) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        });

        // Initialize dark mode immediately
        window.Alpine.store('darkMode').init();
    }
});

/**
 * Dashboard Chart Rendering
 * 
 * Renders a donut chart showing Available vs Sold products
 * Uses Chart.js library for visualization
 */
function renderStatusChart() {
    const canvas = document.getElementById('statusChart');
    if (!canvas) return; // Exit if chart canvas not found on page

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

    // Re-apply dark mode after navigation to prevent flicker
    if (window.Alpine?.store('darkMode')) {
        window.Alpine.store('darkMode').updateClass();
    }
});
