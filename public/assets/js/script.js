/* Custom JavaScript for the Real Estate Website
*/
document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Search form functionality
    const searchForm = document.querySelector('.search-form');
    const searchButton = searchForm.querySelector('.btn-primary');
    
    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Get form values
        const location = searchForm.querySelector('select').value;
        const propertyType = searchForm.querySelectorAll('select')[1].value;
        const priceRange = searchForm.querySelectorAll('select')[2].value;
        
        // Add loading state
        this.classList.add('loading');
        this.disabled = true;
        
        // Simulate search (replace with actual search logic)
        setTimeout(() => {
            this.classList.remove('loading');
            this.disabled = false;
            
            // Show results message
            showNotification('تم البحث عن العقارات في ' + (location || 'جميع المدن'), 'success');
            
            // Scroll to properties section
            document.getElementById('properties').scrollIntoView({
                behavior: 'smooth'
            });
        }, 1500);
    });

    // Property card interactions
    const propertyCards = document.querySelectorAll('.property-card');
    propertyCards.forEach(card => {
        const detailsBtn = card.querySelector('.btn-primary');
        
        detailsBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const propertyTitle = card.querySelector('h5').textContent;
            showNotification('عرض تفاصيل: ' + propertyTitle, 'info');
        });
    });

    // Contact form functionality (if exists)
    const contactForms = document.querySelectorAll('form');
    contactForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            showNotification('تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.', 'success');
        });
    });

    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.feature-card, .property-card, .service-card, .stat-card');
    animateElements.forEach(element => {
        observer.observe(element);
    });

    // Counter animation for stats
    const statNumbers = document.querySelectorAll('.stat-icon .h3');
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    statNumbers.forEach(stat => {
        statsObserver.observe(stat);
    });

    // Phone number formatting
    const phoneNumbers = document.querySelectorAll('[href^="tel:"]');
    phoneNumbers.forEach(phone => {
        phone.addEventListener('click', function(e) {
            showNotification('جاري الاتصال...', 'info');
        });
    });

    // Social media links
    const socialLinks = document.querySelectorAll('.fab');
    socialLinks.forEach(link => {
        link.closest('a').addEventListener('click', function(e) {
            e.preventDefault();
            const platform = this.querySelector('i').classList[1].replace('fa-', '');
            showNotification('سيتم توجيهك إلى ' + platform, 'info');
        });
    });
});

// Utility functions
function animateCounter(element) {
    const target = parseInt(element.textContent.replace(/\D/g, ''));
    const suffix = element.textContent.replace(/\d/g, '');
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current) + suffix;
    }, 20);
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Add to document
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('header');
    if (window.scrollY > 100) {
        navbar.classList.add('shadow-lg');
    } else {
        navbar.classList.remove('shadow-lg');
    }
});

// Search suggestions (placeholder for future enhancement)
function initSearchSuggestions() {
    const locationSelect = document.querySelector('.search-form select');
    const suggestions = [
        'الرياض - حي العليا',
        'الرياض - حي الملز',
        'جدة - حي الروضة',
        'جدة - حي الزهراء',
        'الدمام - الكورنيش',
        'الدمام - حي الشاطئ'
    ];
    
    // This could be enhanced with a proper autocomplete library
    console.log('Search suggestions ready:', suggestions);
}

// Property comparison (placeholder for future enhancement)
function compareProperties(propertyIds) {
    console.log('Comparing properties:', propertyIds);
    showNotification('ميزة المقارنة قادمة قريباً', 'info');
}

// Favorites system (placeholder for future enhancement)
function toggleFavorite(propertyId) {
    console.log('Toggling favorite for property:', propertyId);
    showNotification('تم إضافة العقار إلى المفضلة', 'success');
}

// Initialize search suggestions
initSearchSuggestions();