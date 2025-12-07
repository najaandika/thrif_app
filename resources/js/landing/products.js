import { smoothScrollTo, formatRupiah } from '../utils.js';

let autoScrollInterval = null;

export function initProducts() {
    // Cleanup previous interval if exists
    if (autoScrollInterval) {
        clearInterval(autoScrollInterval);
        autoScrollInterval = null;
    }

    // Category filter functionality
    const filterButtons = document.querySelectorAll('.filter-category');
    const resetButton = document.getElementById('reset-filter');
    const filterLabel = document.getElementById('filter-label');
    const productCards = document.querySelectorAll('[data-product-card]');

    let activeCategory = null;

    const filterProducts = (category) => {
        activeCategory = category;
        let visibleCount = 0;

        productCards.forEach(card => {
            const cardCategory = card.getAttribute('data-product-category');
            if (!category || !cardCategory || cardCategory.toLowerCase().includes(category.toLowerCase())) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update UI
        if (filterLabel) {
            if (category) {
                filterLabel.textContent = `Kategori: ${category}`;
                resetButton?.classList.remove('hidden');
            } else {
                filterLabel.textContent = 'Produk highlight hari ini';
                resetButton?.classList.add('hidden');
            }
        }

        // Scroll to products section
        smoothScrollTo('produk');
    };

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.getAttribute('data-category');
            filterProducts(category);
        });
    });

    resetButton?.addEventListener('click', () => {
        filterProducts(null);
    });

    // Carousel Logic
    const carousel = document.querySelector('[data-carousel="product-highlight"]');
    if (carousel) {
        const container = carousel.querySelector('[data-carousel-container]');
        const prevBtn = carousel.querySelector('[data-carousel-prev]');
        const nextBtn = carousel.querySelector('[data-carousel-next]');

        if (container) {
            const getScrollAmount = () => {
                const item = container.querySelector('[data-carousel-item]');
                return item ? item.getBoundingClientRect().width + 12 : 260;
            };

            const scrollToNext = (fromAuto = false) => {
                const amount = getScrollAmount();
                const maxScroll = container.scrollWidth - container.clientWidth;
                if (fromAuto && container.scrollLeft + amount >= maxScroll) {
                    container.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    container.scrollBy({ left: amount, behavior: 'smooth' });
                }
            };

            const scrollToPrev = () => {
                container.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
            };

            prevBtn?.addEventListener('click', () => scrollToPrev());
            nextBtn?.addEventListener('click', () => scrollToNext());

            // Skeleton loading simulation
            const skeletonTemplate = document.getElementById('skeleton-template');

            function showSkeletons(count = 4) {
                if (!skeletonTemplate || !container) return;
                container.innerHTML = '';
                for (let i = 0; i < count; i++) {
                    const skeleton = skeletonTemplate.content.cloneNode(true);
                    container.appendChild(skeleton);
                }
            }

            // Show skeletons if no products initially
            const carouselProductCards = container.querySelectorAll('[data-product-card]');
            if (carouselProductCards && carouselProductCards.length === 0) {
                showSkeletons(4);
            }

            // Auto Scroll
            const startAutoScroll = () => {
                if (autoScrollInterval) return;
                autoScrollInterval = setInterval(() => {
                    scrollToNext(true);
                }, 5000);
            };

            const stopAutoScroll = () => {
                if (!autoScrollInterval) return;
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            };

            startAutoScroll();

            const pauseTargets = [carousel, container, prevBtn, nextBtn].filter(Boolean);
            pauseTargets.forEach((el) => {
                el.addEventListener('mouseenter', stopAutoScroll);
                el.addEventListener('focusin', stopAutoScroll);
                el.addEventListener('mouseleave', startAutoScroll);
                el.addEventListener('focusout', startAutoScroll);
                el.addEventListener('touchstart', stopAutoScroll, { passive: true });
                el.addEventListener('touchend', startAutoScroll, { passive: true });
            });
        }
    }

    // Product action modal logic
    const modal = document.getElementById('product-action-modal');
    const actionForm = document.getElementById('product-action-form');
    const qtyInput = document.getElementById('modal-quantity');
    const nameEl = modal?.querySelector('[data-modal-product-name]');
    const stockEl = modal?.querySelector('[data-modal-product-stock]');
    const priceEl = modal?.querySelector('[data-modal-product-price]');
    const closeButtons = modal?.querySelectorAll('[data-modal-close]') || [];

    const openModalForProduct = (button) => {
        if (!modal || !actionForm || !qtyInput) return;

        const id = button.getAttribute('data-product-id');
        const name = button.getAttribute('data-product-name') || '';
        const price = Number(button.getAttribute('data-product-price') || 0);
        const stock = Number(button.getAttribute('data-product-stock') || 0);

        actionForm.querySelector('input[name="product_id"]').value = id || '';
        qtyInput.value = '1';
        qtyInput.max = stock > 0 ? String(stock) : '';

        if (nameEl) nameEl.textContent = name;
        if (stockEl) stockEl.textContent = stock > 0 ? stock : '-';
        if (priceEl) priceEl.textContent = price ? formatRupiah(price) : '-';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        qtyInput.focus();
    };

    const closeModal = () => {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    document.querySelectorAll('[data-product-action]').forEach((btn) => {
        btn.addEventListener('click', () => openModalForProduct(btn));
    });

    closeButtons.forEach((btn) => {
        btn.addEventListener('click', closeModal);
    });

    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
}
