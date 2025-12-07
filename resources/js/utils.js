/**
 * Common utility functions for the application
 */

/**
 * Smooth scroll to element with offset for fixed header
 * @param {string} targetId - ID of target element (without #)
 * @param {number} headerOffset - Height of fixed header (default: 64px)
 */
export function smoothScrollTo(targetId, headerOffset = 64) {
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
}

/**
 * Format number as Indonesian Rupiah currency
 * @param {number} value - Number to format
 * @returns {string} Formatted currency string
 */
export function formatRupiah(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(value).replace('Rp', 'Rp ');
}

/**
 * Debounce function to limit function execution rate
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @returns {Function} Debounced function
 */
export function debounce(func, wait = 300) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Toggle element visibility
 * @param {HTMLElement} element - Element to toggle
 * @param {boolean} show - Force show/hide (optional)
 */
export function toggleVisibility(element, show) {
    if (!element) return;

    if (show === undefined) {
        element.classList.toggle('hidden');
    } else {
        element.classList.toggle('hidden', !show);
    }
}

/**
 * Get element safely with optional chaining
 * @param {string} selector - CSS selector
 * @param {HTMLElement} parent - Parent element (optional)
 * @returns {HTMLElement|null}
 */
export function getElement(selector, parent = document) {
    return parent.querySelector(selector);
}

/**
 * Get all elements safely
 * @param {string} selector - CSS selector
 * @param {HTMLElement} parent - Parent element (optional)
 * @returns {NodeList}
 */
export function getAllElements(selector, parent = document) {
    return parent.querySelectorAll(selector);
}

/**
 * Add event listener with optional delegation
 * @param {HTMLElement|string} target - Target element or selector
 * @param {string} event - Event name
 * @param {Function} handler - Event handler
 * @param {Object} options - Event listener options
 */
export function on(target, event, handler, options = {}) {
    const element = typeof target === 'string' ? getElement(target) : target;
    element?.addEventListener(event, handler, options);
}
