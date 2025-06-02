// Hero-2 Component JavaScript
// Interactive functionality for split layout hero

(function() {
    'use strict';
    
    // Get component element
    const heroElement = document.querySelector('#{{ component_id }}');
    if (!heroElement) return;
    
    // Add intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('hero-visible');
            }
        });
    }, observerOptions);
    
    // Observe hero elements
    const heroText = heroElement.querySelector('.hero-text');
    const heroImage = heroElement.querySelector('.hero-image');
    
    if (heroText) observer.observe(heroText);
    if (heroImage) observer.observe(heroImage);
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        #{{ component_id }} .hero-text,
        #{{ component_id }} .hero-image {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        #{{ component_id }} .hero-text.hero-visible,
        #{{ component_id }} .hero-image.hero-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        #{{ component_id }} .hero-image.hero-visible {
            transition-delay: 0.2s;
        }
    `;
    
    document.head.appendChild(style);
    
})();