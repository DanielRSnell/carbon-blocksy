// Blog Posts Component JavaScript
// Interactive functionality for blog posts display

(function() {
    'use strict';
    
    // Get component element
    const blogElement = document.querySelector('#{{ component_id }}');
    if (!blogElement) return;
    
    // Add intersection observer for entrance animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('blog-visible');
                
                // Animate post cards sequentially
                const posts = entry.target.querySelectorAll('.post-card');
                posts.forEach((post, index) => {
                    setTimeout(() => {
                        post.style.opacity = '1';
                        post.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            }
        });
    }, observerOptions);
    
    observer.observe(blogElement);
    
    // Enhanced carousel functionality if layout is carousel
    if (blogElement.classList.contains('layout-carousel')) {
        const container = blogElement.querySelector('.posts-container');
        if (container) {
            let isScrolling = false;
            
            // Add smooth scroll behavior
            container.addEventListener('scroll', () => {
                if (!isScrolling) {
                    window.requestAnimationFrame(() => {
                        // Add any scroll-based effects here
                        isScrolling = false;
                    });
                    isScrolling = true;
                }
            });
            
            // Add keyboard navigation
            container.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                    e.preventDefault();
                    const cardWidth = container.querySelector('.post-card').offsetWidth + 24; // includes gap
                    const scrollAmount = e.key === 'ArrowLeft' ? -cardWidth : cardWidth;
                    container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            });
            
            // Make container focusable for keyboard navigation
            container.setAttribute('tabindex', '0');
        }
    }
    
    // Enhanced masonry layout if supported
    if (blogElement.classList.contains('layout-masonry')) {
        // Check if CSS Grid masonry is supported, fallback to JavaScript if needed
        if (!CSS.supports('grid-template-rows', 'masonry')) {
            // Simple JavaScript masonry fallback could be implemented here
            console.log('CSS Grid masonry not supported, using CSS columns fallback');
        }
    }
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        #{{ component_id }} {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        #{{ component_id }}.blog-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        #{{ component_id }} .post-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }
        
        #{{ component_id }} .post-image img {
            transition: transform 0.3s ease;
        }
        
        #{{ component_id }} .post-card:hover .post-image img {
            transform: scale(1.05);
        }
        
        /* Carousel scroll indicators */
        #{{ component_id }}.layout-carousel .posts-container {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f7fafc;
        }
        
        #{{ component_id }}.layout-carousel .posts-container::-webkit-scrollbar {
            height: 8px;
        }
        
        #{{ component_id }}.layout-carousel .posts-container::-webkit-scrollbar-track {
            background: #f7fafc;
            border-radius: 4px;
        }
        
        #{{ component_id }}.layout-carousel .posts-container::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }
        
        #{{ component_id }}.layout-carousel .posts-container::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    `;
    
    document.head.appendChild(style);
    
})();