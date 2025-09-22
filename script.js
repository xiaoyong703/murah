document.addEventListener('DOMContentLoaded', function() {
    let cartCount = 0;
    const cartCountElem = document.getElementById('cart-count');
    const floatCartCount = document.getElementById('float-cart-count');
    const buyButtons = document.querySelectorAll('.buy-btn');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');
    const faqItems = document.querySelectorAll('.faq-item');
    const socialProof = document.getElementById('social-proof');
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    // Dark/Light Mode Toggle
    let isDarkMode = localStorage.getItem('darkMode') === 'true';
    
    function updateTheme() {
        if (isDarkMode) {
            document.body.classList.add('dark-mode');
            themeIcon.className = 'fas fa-sun text-white';
            document.body.style.background = 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)';
        } else {
            document.body.classList.remove('dark-mode');
            themeIcon.className = 'fas fa-moon text-white';
            document.body.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
        }
        localStorage.setItem('darkMode', isDarkMode);
    }
    
    themeToggle.addEventListener('click', function() {
        isDarkMode = !isDarkMode;
        updateTheme();
    });
    
    // Initialize theme
    updateTheme();

    // Countdown Timer
    function startCountdown() {
        const countdownElem = document.getElementById('countdown');
        let timeLeft = 24 * 60 * 60 - 1; // 23:59:59

        setInterval(() => {
            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = timeLeft % 60;
            
            countdownElem.textContent = 
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            timeLeft--;
            if (timeLeft < 0) timeLeft = 24 * 60 * 60 - 1;
        }, 1000);
    }

    // Buy Button Functionality
    buyButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            cartCount++;
            cartCountElem.textContent = cartCount;
            floatCartCount.textContent = cartCount;
            
            const service = btn.getAttribute('data-service');
            btn.textContent = '✓ Added to Cart';
            btn.style.background = '#27ae60';
            btn.disabled = true;
            
            setTimeout(() => {
                btn.textContent = 'Buy Now';
                btn.style.background = '';
                btn.disabled = false;
            }, 2000);

            // Show social proof
            showSocialProof(service);
        });
    });

    // Product Filtering
    filterButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            btn.classList.add('active');
            
            const filter = btn.getAttribute('data-filter');
            
            productCards.forEach(function(card) {
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // FAQ Accordion
    faqItems.forEach(function(item) {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', function() {
            const isActive = item.classList.contains('active');
            
            // Close all FAQ items
            faqItems.forEach(faq => faq.classList.remove('active'));
            
            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // Social Proof Popup
    const proofMessages = [
        "Sarah from New York just purchased Spotify Premium",
        "John from Singapore just purchased CapCut Premium",
        "Maria from London just purchased Netflix Premium",
        "Alex from Tokyo just purchased YouTube Premium",
        "Emma from Paris just purchased Canva Pro"
    ];

    function showSocialProof(service = null) {
        const message = service ? 
            `Someone just purchased ${service}` : 
            proofMessages[Math.floor(Math.random() * proofMessages.length)];
        
        document.getElementById('proof-text').textContent = message;
        socialProof.classList.add('show');
        
        setTimeout(() => {
            socialProof.classList.remove('show');
        }, 4000);
    }

    // Show social proof periodically
    setInterval(() => {
        if (!socialProof.classList.contains('show')) {
            showSocialProof();
        }
    }, 15000);

    // Newsletter Subscription
    const newsletterBtn = document.querySelector('.newsletter-form button');
    const newsletterInput = document.querySelector('.newsletter-form input');
    
    newsletterBtn.addEventListener('click', function() {
        const email = newsletterInput.value;
        if (email && email.includes('@')) {
            newsletterBtn.textContent = '✓ Subscribed!';
            newsletterBtn.style.background = '#27ae60';
            newsletterInput.value = '';
            
            setTimeout(() => {
                newsletterBtn.textContent = 'Subscribe';
                newsletterBtn.style.background = '';
            }, 3000);
        } else {
            alert('Please enter a valid email address');
        }
    });

    // Floating Cart Click
    document.getElementById('floating-cart').addEventListener('click', function() {
        if (cartCount > 0) {
            alert(`You have ${cartCount} items in your cart!\nProceeding to checkout...`);
        } else {
            alert('Your cart is empty. Add some premium services!');
        }
    });

    // CTA Button Scroll
    document.querySelector('.cta-btn').addEventListener('click', function() {
        document.querySelector('.products-section').scrollIntoView({
            behavior: 'smooth'
        });
    });

    // Smooth scrolling for navigation
    document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Add CSS for fade in animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);

    // Start countdown timer
    startCountdown();

    // Show initial social proof after 3 seconds
    setTimeout(() => {
        showSocialProof();
    }, 3000);
});
