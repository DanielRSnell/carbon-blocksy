// Hero-1 Component JavaScript for {{ component_id }}
(function() {
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHero);
    } else {
        initHero();
    }
    
    function initHero() {
        const hero = document.getElementById('{{ component_id }}');
        if (!hero) return;
        
        // Parallax effect for background
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset;
            const rate = scrollTop * -0.5;
            const background = hero.querySelector('.hero-background');
            if (background) {
                background.style.transform = `translate3d(0, ${rate}px, 0)`;
            }
        });
        
        // Button interactions
        const button = hero.querySelector('.umbral-button');
        if (button) {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        }
        
        // Fade in animation
        hero.style.opacity = '0';
        hero.style.transition = 'opacity 1s ease-in-out';
        
        setTimeout(function() {
            hero.style.opacity = '1';
        }, 100);
    }
})();