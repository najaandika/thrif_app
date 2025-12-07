import { smoothScrollTo, debounce } from '../utils.js';

let header;
let searchModal;
let searchInput;
let searchResults;
let searchNoResults;
let searchToggle;
let searchToggleMobile;

// Scroll handler
const handleScroll = () => {
    if (!header) return;

    const headerHeight = header.offsetHeight || 64;
    const currentScroll = window.pageYOffset;

    if (currentScroll > headerHeight) {
        header.classList.add('shadow-lg', 'shadow-gray-900/10', 'dark:shadow-gray-100/5');
    } else {
        header.classList.remove('shadow-lg', 'shadow-gray-900/10', 'dark:shadow-gray-100/5');
    }
};

export function initHeader() {
    // --- HEADER & SCROLL ---
    header = document.getElementById('main-header');
    handleScroll();
    window.removeEventListener('scroll', handleScroll);
    window.addEventListener('scroll', handleScroll, { passive: true });

    // --- SMOOTH SCROLL LINK ---
    document.querySelectorAll('.smooth-scroll, a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#') && href !== '#') {
                e.preventDefault();
                const targetId = href.substring(1);
                smoothScrollTo(targetId);
            }
        });
    });

    // --- MOBILE NAV (HAMBURGER) ---
    const mobileNavToggles = document.querySelectorAll('[data-toggle-mobile-nav]');
    const mobileNav = document.getElementById('mobile-nav');

    if (mobileNavToggles.length && mobileNav) {
        mobileNavToggles.forEach(toggle => {
            toggle.onclick = (e) => {
                e.preventDefault();
                e.stopPropagation();
                mobileNav.classList.toggle('hidden');
            };
        });
    }

    // --- SEARCH SETUP ---
    searchToggle = document.getElementById('search-toggle');
    searchToggleMobile = document.getElementById('search-toggle-mobile');
    searchModal = document.getElementById('search-modal');
    searchInput = document.getElementById('search-input');
    const searchClose = document.getElementById('search-close');
    searchResults = document.getElementById('search-results');
    const searchResultsContainer = document.getElementById('search-results-container');
    searchNoResults = document.getElementById('search-no-results');

    const openSearch = () => {
        if (!searchModal) return;
        searchModal.classList.remove('hidden');
        searchInput?.focus();
    };

    const closeSearch = () => {
        if (!searchModal) return;
        searchModal.classList.add('hidden');
        if (searchInput) searchInput.value = '';
        searchResults?.classList.add('hidden');
        searchNoResults?.classList.add('hidden');
    };

    // TOMBOL SEARCH DESKTOP & MOBILE
    searchToggle?.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        openSearch();
    });

    searchToggleMobile?.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        openSearch();
    });

    // CLOSE BUTTON
    searchClose?.addEventListener('click', (e) => {
        e.preventDefault();
        closeSearch();
    });

    // ESC untuk nutup
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSearch();
        }
    });

    // Klik luar modal = nutup
    document.addEventListener('click', (e) => {
        if (!searchModal || searchModal.classList.contains('hidden')) return;
        if (!searchModal.contains(e.target) &&
            !searchToggle?.contains(e.target) &&
            !searchToggleMobile?.contains(e.target)) {
            closeSearch();
        }
    });

    // --- SEARCH LOGIC ---
    const performSearch = (query) => {
        if (query.length === 0) {
            searchResults?.classList.add('hidden');
            searchNoResults?.classList.add('hidden');
            return;
        }

        const productCards = document.querySelectorAll('[data-product-card]');
        const results = [];

        productCards.forEach(card => {
            const name = card.querySelector('[data-product-name]')?.textContent.toLowerCase() || '';
            const category = card.getAttribute('data-product-category')?.toLowerCase() || '';
            const price = card.querySelector('[data-product-price]')?.textContent || '';

            if (name.includes(query) || category.includes(query)) {
                const image = card.querySelector('img')?.src || '';
                const link = card.getAttribute('data-product-link') || card.querySelector('a[href]')?.href || '#';

                results.push({
                    name: card.querySelector('[data-product-name]')?.textContent || '',
                    category: card.getAttribute('data-product-category') || '',
                    price,
                    image,
                    link,
                });
            }
        });

        if (results.length > 0 && searchResultsContainer) {
            searchResultsContainer.innerHTML = results.map(product => `
                <a href="${product.link}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    <img src="${product.image}" alt="${product.name}" class="w-14 h-14 object-cover rounded flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <h4 class="font-medium text-[15px] text-gray-900 dark:text-gray-100 truncate leading-tight">${product.name}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">${product.category}</p>
                    </div>
                    <p class="font-semibold text-[15px] text-emerald-600 dark:text-emerald-400 flex-shrink-0">${product.price}</p>
                </a>
            `).join('');
            searchResults?.classList.remove('hidden');
            searchNoResults?.classList.add('hidden');
        } else {
            searchResults?.classList.add('hidden');
            searchNoResults?.classList.remove('hidden');
        }
    };

    const debouncedSearch = debounce((query) => performSearch(query), 300);

    searchInput?.addEventListener('input', (e) => {
        const query = e.target.value.trim().toLowerCase();
        debouncedSearch(query);
    });

    // Enter = redirect
    searchInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            const query = searchInput.value.trim();
            if (query.length > 0) {
                window.location.href = `/landing/products?search=${encodeURIComponent(query)}`;
            }
        }
    });
}
