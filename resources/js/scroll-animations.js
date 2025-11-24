// Fade-in scroll animations using Intersection Observer
document.addEventListener('DOMContentLoaded', () => {
    // Create Intersection Observer
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                entry.target.classList.remove('opacity-0', 'translate-y-8');
                // Optionally unobserve after animation
                // observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Select elements to animate
    const animatedElements = document.querySelectorAll(
        '[data-animate], .product-card, section > div, article, .hero-section > *'
    );

    animatedElements.forEach((element, index) => {
        // Add initial hidden state
        element.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700', 'ease-out');
        
        // Add staggered delay
        element.style.transitionDelay = `${index * 50}ms`;
        
        // Observe element
        observer.observe(element);
    });

    // Specific animations for different sections
    const sections = {
        hero: document.querySelector('[data-section="hero"]'),
        products: document.querySelector('[data-section="products"]'),
        about: document.querySelector('[data-section="about"]'),
        contact: document.querySelector('[data-section="contact"]')
    };

    Object.entries(sections).forEach(([key, section]) => {
        if (section) {
            observer.observe(section);
        }
    });
});

// Add CSS classes dynamically
const style = document.createElement('style');
style.textContent = `
    .animate-fade-in {
        animation: fadeInUp 0.7s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(2rem);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Reduce motion for accessibility */
    @media (prefers-reduced-motion: reduce) {
        .animate-fade-in,
        [data-animate] {
            animation: none !important;
            transition: none !important;
            opacity: 1 !important;
            transform: none !important;
        }
    }
`;
document.head.appendChild(style);
