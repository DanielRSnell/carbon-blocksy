// Pricing Card Component JavaScript
// Interactive animations and hover effects

(function() {
    'use strict';
    
    // Get component element
    const pricingElement = document.querySelector('#{{ component_id }}');
    if (!pricingElement) return;
    
    // Add intersection observer for entrance animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('pricing-visible');
                
                // Animate features sequentially
                const features = entry.target.querySelectorAll('.feature-item');
                features.forEach((feature, index) => {
                    setTimeout(() => {
                        feature.style.opacity = '1';
                        feature.style.transform = 'translateX(0)';
                    }, 300 + (index * 100));
                });
            }
        });
    }, observerOptions);
    
    observer.observe(pricingElement);
    
    // Add button interaction effects
    const button = pricingElement.querySelector('.pricing-button');
    if (button) {
        button.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.2)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.boxShadow = 'none';
        });
        
        button.addEventListener('mousedown', function() {
            this.style.transform = 'translateY(-2px) scale(0.98)';
        });
        
        button.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(-2px) scale(1)';
        });
    }
    
    // Add price animation on hover
    const priceElement = pricingElement.querySelector('.plan-price');
    if (priceElement) {
        pricingElement.addEventListener('mouseenter', function() {
            priceElement.style.transform = 'scale(1.05)';
        });
        
        pricingElement.addEventListener('mouseleave', function() {
            priceElement.style.transform = 'scale(1)';
        });
    }
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        #{{ component_id }} {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        #{{ component_id }}.pricing-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        #{{ component_id }} .feature-item {
            opacity: 0;
            transform: translateX(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        
        #{{ component_id }} .plan-price {
            transition: transform 0.3s ease;
        }
        
        #{{ component_id }} .pricing-button {
            transition: all 0.3s ease, box-shadow 0.3s ease;
        }
        
        #{{ component_id }} .pricing-badge {
            animation: badge-pulse 2s infinite;
        }
        
        @keyframes badge-pulse {
            0%, 100% {
                transform: translateX(-50%) scale(1);
            }
            50% {
                transform: translateX(-50%) scale(1.05);
            }
        }
    `;
    
    document.head.appendChild(style);
    
})();