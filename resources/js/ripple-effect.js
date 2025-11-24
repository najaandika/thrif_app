// Button ripple effect
document.addEventListener('DOMContentLoaded', () => {
    // Add ripple effect to buttons
    const rippleButtons = document.querySelectorAll('button, a[href], [data-ripple]');
    
    rippleButtons.forEach(button => {
        // Skip if already has ripple
        if (button.dataset.rippleInit) return;
        button.dataset.rippleInit = 'true';
        
        button.addEventListener('click', function(e) {
            // Skip if disabled
            if (this.disabled) return;
            
            // Create ripple element
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple-effect');
            
            // Add ripple to button
            const rippleContainer = this.querySelector('.ripple-container') || (() => {
                const container = document.createElement('span');
                container.classList.add('ripple-container');
                this.appendChild(container);
                return container;
            })();
            
            rippleContainer.appendChild(ripple);
            
            // Remove ripple after animation
            setTimeout(() => {
                ripple.remove();
                if (rippleContainer.children.length === 0) {
                    rippleContainer.remove();
                }
            }, 600);
        });
    });
});

// Add ripple CSS
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    .ripple-container {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        border-radius: inherit;
    }

    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }

    /* Ensure parent buttons have relative positioning */
    button, a[href], [data-ripple] {
        position: relative;
        overflow: hidden;
    }

    /* Dark mode support */
    .dark .ripple-effect {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Reduce motion for accessibility */
    @media (prefers-reduced-motion: reduce) {
        .ripple-effect {
            animation: none !important;
            display: none !important;
        }
    }
`;
document.head.appendChild(rippleStyle);
