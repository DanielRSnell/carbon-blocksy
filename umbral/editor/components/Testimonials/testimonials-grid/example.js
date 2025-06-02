// Testimonial Card Component JavaScript
// Interactive animations and effects

(function() {
    'use strict';
    
    // Get component element
    const testimonialElement = document.querySelector('#{{ component_id }}');
    if (!testimonialElement) return;
    
    // Add intersection observer for entrance animation
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('testimonial-visible');
                
                // Animate stars sequentially
                const stars = entry.target.querySelectorAll('.star.filled');
                stars.forEach((star, index) => {
                    setTimeout(() => {
                        star.style.transform = 'scale(1.2)';
                        setTimeout(() => {
                            star.style.transform = 'scale(1)';
                        }, 150);
                    }, index * 100);
                });
            }
        });
    }, observerOptions);
    
    observer.observe(testimonialElement);
    
    // Add hover effects for featured style
    if (testimonialElement.classList.contains('style-featured')) {
        testimonialElement.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.2)';
        });
        
        testimonialElement.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
        });
    }
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        #{{ component_id }} {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease, box-shadow 0.3s ease;
        }
        
        #{{ component_id }}.testimonial-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        #{{ component_id }} .star {
            transition: transform 0.15s ease, opacity 0.2s ease;
        }
        
        #{{ component_id }} .author-avatar img {
            transition: transform 0.3s ease;
        }
        
        #{{ component_id }}:hover .author-avatar img {
            transform: scale(1.05);
        }
        
        #{{ component_id }} .testimonial-quote {
            transition: transform 0.3s ease;
        }
        
        #{{ component_id }}:hover .testimonial-quote {
            transform: translateY(-2px);
        }
    `;
    
    document.head.appendChild(style);
    
})();