export function initScrollAnimations() {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const elements = document.querySelectorAll('[data-section], [data-reveal]');

    if (reduceMotion || !('IntersectionObserver' in window)) {
        elements.forEach(element => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, {
        root: null,
        rootMargin: '0px 0px -12% 0px',
        threshold: 0.16,
    });

    elements.forEach((element, index) => {
        element.classList.add('landing-reveal');
        element.style.setProperty('--reveal-delay', `${Math.min(index * 70, 240)}ms`);
        observer.observe(element);
    });
}