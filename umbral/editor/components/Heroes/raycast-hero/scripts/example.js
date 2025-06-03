// Raycast Hero Component JavaScript

document.addEventListener('DOMContentLoaded', function() {
    const raycastHero = document.querySelector('.umbral-raycast-hero');
    
    if (!raycastHero) return;
    
    // Add interactive behaviors
    initializeSearchInput();
    initializeShortcuts();
    initializeFloatingElements();
    
    function initializeSearchInput() {
        const searchInput = raycastHero.querySelector('.search-input');
        const searchContainer = raycastHero.querySelector('.search-container');
        
        if (!searchInput || !searchContainer) return;
        
        // Focus effect
        searchInput.addEventListener('focus', function() {
            searchContainer.style.background = 'rgba(255, 255, 255, 0.15)';
            searchContainer.style.borderColor = 'rgba(255, 255, 255, 0.4)';
        });
        
        searchInput.addEventListener('blur', function() {
            searchContainer.style.background = 'rgba(255, 255, 255, 0.1)';
            searchContainer.style.borderColor = 'rgba(255, 255, 255, 0.2)';
        });
        
        // Simulate command palette opening (for demo)
        searchInput.addEventListener('click', function() {
            // This would typically open a command palette
            console.log('Command palette would open here');
        });
    }
    
    function initializeShortcuts() {
        const shortcutItems = raycastHero.querySelectorAll('.shortcut-item');
        
        shortcutItems.forEach(function(item, index) {
            // Add hover sound effect (visual feedback)
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(4px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
            
            // Click behavior
            item.addEventListener('click', function() {
                console.log('Shortcut clicked:', this.querySelector('.shortcut-text').textContent);
                
                // Add click animation
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'translateX(4px)';
                }, 100);
            });
        });
    }
    
    function initializeFloatingElements() {
        const floatingElements = raycastHero.querySelectorAll('.floating-element');
        
        // Add random movement to floating elements
        floatingElements.forEach(function(element, index) {
            const randomDelay = Math.random() * 2000;
            const randomDuration = 4000 + (Math.random() * 4000);
            
            setTimeout(() => {
                element.style.animationDuration = randomDuration + 'ms';
            }, randomDelay);
        });
        
        // Add parallax effect on mouse move
        raycastHero.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = (e.clientY - rect.top) / rect.height;
            
            floatingElements.forEach(function(element, index) {
                const intensity = (index + 1) * 0.5;
                const moveX = (x - 0.5) * intensity;
                const moveY = (y - 0.5) * intensity;
                
                element.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
        });
        
        // Reset on mouse leave
        raycastHero.addEventListener('mouseleave', function() {
            floatingElements.forEach(function(element) {
                element.style.transform = '';
            });
        });
    }
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // ⌘K or Ctrl+K to focus search
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = raycastHero.querySelector('.search-input');
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
    });
    
    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, {
            threshold: 0.1
        });
        
        // Observe feature cards for animation
        const featureCards = raycastHero.querySelectorAll('.feature-card');
        featureCards.forEach(function(card) {
            observer.observe(card);
        });
    }
});

// Example data structure (for reference/testing)
const exampleData = {
    title: "Your work, supercharged",
    subtitle: "A collection of powerful shortcuts, commands, and tools to streamline your workflow.",
    search_placeholder: "Search for anything...",
    shortcuts: [
        {
            icon: "⌘",
            text: "Quick Actions",
            keystroke: "⌘K"
        },
        {
            icon: "🔍",
            text: "Search Files",
            keystroke: "⌘F"
        },
        {
            icon: "📁",
            text: "Browse Folders",
            keystroke: "⌘B"
        }
    ],
    feature_cards: [
        {
            icon: "⚡",
            title: "Lightning Fast",
            description: "Execute commands in milliseconds"
        },
        {
            icon: "🎯",
            title: "Precise Control",
            description: "Find exactly what you need"
        },
        {
            icon: "🚀",
            title: "Boost Productivity",
            description: "Save hours every week"
        },
        {
            icon: "🛡️",
            title: "Secure & Private",
            description: "Enterprise-grade security"
        }
    ],
    cta_text: "Get Started",
    cta_url: "#"
};