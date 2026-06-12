document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });
});

// Language toggle function
function toggleLanguage() {
    const html = document.documentElement;
    const currentLang = html.getAttribute('lang');
    const newLang = currentLang === 'ja' ? 'en' : 'ja';
    
    html.setAttribute('lang', newLang);
    
    // Toggle visibility of language-specific elements
    document.querySelectorAll('[data-lang]').forEach(element => {
        if (element.getAttribute('data-lang') === newLang) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    });
}

// Mobile menu toggle function
function toggleMobileMenu() {
    const mobileMenu = document.querySelector('.mobile-menu');
    const body = document.body;
    
    if (mobileMenu.classList.contains('active')) {
        mobileMenu.classList.remove('active');
        body.style.overflow = '';
    } else {
        mobileMenu.classList.add('active');
        body.style.overflow = 'hidden';
    }
} 