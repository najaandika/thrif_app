import { smoothScrollTo, debounce } from '../utils.js';

let header;
let headerToolbar;
let searchModal;
let searchInput;
let searchResults;
let searchNoResults;
let searchIdle;
let searchToggle;
let searchToggleMobile;

const handleScroll = () => {
    if (!header) return;

    const headerHeight = header.offsetHeight || 64;
    const currentScroll = window.pageYOffset;

    if (currentScroll > headerHeight) {
        headerToolbar?.classList.add('md:bg-white/95', 'dark:md:bg-gray-950/95', 'md:border-gray-300/80', 'dark:md:border-gray-700');
    } else {
        headerToolbar?.classList.remove('md:bg-white/95', 'dark:md:bg-gray-950/95', 'md:border-gray-300/80', 'dark:md:border-gray-700');
    }
};

const renderSearchResult = (product) => [
    '<a href="' + product.link + '" class="group flex items-center gap-3 rounded-2xl border border-gray-200 bg-white p-2.5 transition hover:border-gray-300 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-950 dark:hover:border-gray-700 dark:hover:bg-gray-900">',
        '<img src="' + product.image + '" alt="' + product.name + '" class="h-16 w-14 flex-shrink-0 rounded-xl bg-gray-100 object-cover dark:bg-gray-800">',
        '<div class="min-w-0 flex-1">',
            '<h4 class="truncate text-sm font-semibold leading-tight text-gray-950 group-hover:text-gray-700 dark:text-gray-100 dark:group-hover:text-gray-300">' + product.name + '</h4>',
            '<p class="mt-1 truncate text-[11px] font-semibold uppercase tracking-[0.12em] text-gray-400 dark:text-gray-500">' + (product.category || 'Produk') + '</p>',
        '</div>',
        '<p class="flex-shrink-0 text-right text-sm font-bold text-gray-950 dark:text-gray-100">' + product.price + '</p>',
    '</a>',
].join('');

export function initHeader() {
    header = document.getElementById('main-header');
    headerToolbar = document.getElementById('header-toolbar');
    handleScroll();
    window.removeEventListener('scroll', handleScroll);
    window.addEventListener('scroll', handleScroll, { passive: true });

    document.querySelectorAll('.smooth-scroll, a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#') && href !== '#') {
                e.preventDefault();
                smoothScrollTo(href.substring(1));
            }
        });
    });

    searchToggle = document.getElementById('search-toggle');
    searchToggleMobile = document.getElementById('search-toggle-mobile');
    searchModal = document.getElementById('search-modal');
    searchInput = document.getElementById('search-input');
    const searchClose = document.getElementById('search-close');
    searchResults = document.getElementById('search-results');
    const searchResultsContainer = document.getElementById('search-results-container');
    searchNoResults = document.getElementById('search-no-results');
    searchIdle = document.getElementById('search-idle');

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
        searchIdle?.classList.remove('hidden');
    };

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

    searchClose?.addEventListener('click', (e) => {
        e.preventDefault();
        closeSearch();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSearch();
        }
    });

    document.addEventListener('click', (e) => {
        if (!searchModal || searchModal.classList.contains('hidden')) return;
        if (!searchModal.contains(e.target) &&
            !searchToggle?.contains(e.target) &&
            !searchToggleMobile?.contains(e.target)) {
            closeSearch();
        }
    });

    const performSearch = (query) => {
        if (query.length === 0) {
            searchResults?.classList.add('hidden');
            searchNoResults?.classList.add('hidden');
            searchIdle?.classList.remove('hidden');
            return;
        }

        const results = [];
        document.querySelectorAll('[data-product-card]').forEach(card => {
            const name = card.querySelector('[data-product-name]')?.textContent.toLowerCase() || '';
            const category = card.getAttribute('data-product-category')?.toLowerCase() || '';
            const price = card.querySelector('[data-product-price]')?.textContent || '';

            if (name.includes(query) || category.includes(query)) {
                results.push({
                    name: card.querySelector('[data-product-name]')?.textContent || '',
                    category: card.getAttribute('data-product-category') || '',
                    price,
                    image: card.querySelector('img')?.src || '',
                    link: card.getAttribute('data-product-link') || card.querySelector('a[href]')?.href || '#',
                });
            }
        });

        if (results.length > 0 && searchResultsContainer) {
            searchResultsContainer.innerHTML = results.map(renderSearchResult).join('');
            searchResults?.classList.remove('hidden');
            searchNoResults?.classList.add('hidden');
            searchIdle?.classList.add('hidden');
        } else {
            searchResults?.classList.add('hidden');
            searchNoResults?.classList.remove('hidden');
            searchIdle?.classList.add('hidden');
        }
    };

    const debouncedSearch = debounce((query) => performSearch(query), 300);

    searchInput?.addEventListener('input', (e) => {
        debouncedSearch(e.target.value.trim().toLowerCase());
    });

    searchInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            const query = searchInput.value.trim();
            if (query.length > 0) {
                window.location.href = '/landing/products?search=' + encodeURIComponent(query);
            }
        }
    });
}