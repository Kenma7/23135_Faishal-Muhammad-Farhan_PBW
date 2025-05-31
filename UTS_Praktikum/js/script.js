document.addEventListener('DOMContentLoaded', function() {
    // FAQ toggle functionality
    document.querySelectorAll('.faq-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            content.classList.toggle('hidden');
            const icon = button.querySelector('span:last-child');
            icon.textContent = icon.textContent === '+' ? '-' : '+';
        });
    });

    // Carousel Functionality
    const carouselTrack = document.getElementById('carouselTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dotsContainer = document.getElementById('carouselDots');
    
    if (carouselTrack && prevBtn && nextBtn) {
        const cardWidth = 288; // 72rem (288px) + gap (24px) = 312px per card
        const gap = 24;
        const scrollAmount = cardWidth + gap;
        
        // Initialize dots if container exists
        if (dotsContainer) {
            const totalCards = document.querySelectorAll('.anime-card').length;
            const visibleCards = Math.floor(carouselTrack.clientWidth / (cardWidth + gap));
            
            for (let i = 0; i < totalCards - visibleCards + 1; i++) {
                const dot = document.createElement('button');
                dot.className = `w-3 h-3 rounded-full ${i === 0 ? 'bg-pink-600' : 'bg-gray-300'}`;
                dot.addEventListener('click', () => {
                    carouselTrack.scrollTo({
                        left: i * scrollAmount,
                        behavior: 'smooth'
                    });
                });
                dotsContainer.appendChild(dot);
            }
        }

        // Button event listeners
        nextBtn.addEventListener('click', () => {
            carouselTrack.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        prevBtn.addEventListener('click', () => {
            carouselTrack.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        // Update dots on scroll
        carouselTrack.addEventListener('scroll', () => {
            if (dotsContainer) {
                const scrollPos = carouselTrack.scrollLeft;
                const activeDot = Math.round(scrollPos / scrollAmount);
                const dots = dotsContainer.querySelectorAll('button');
                
                dots.forEach((dot, index) => {
                    dot.className = `w-3 h-3 rounded-full ${index === activeDot ? 'bg-pink-600' : 'bg-gray-300'}`;
                });
            }
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});

// Wallet Connection Logic
document.addEventListener('DOMContentLoaded', function() {
    // ... (existing code remains the same until the end)

    // Wallet Connection Modal
    const walletModal = document.getElementById('walletModal');
    const purchaseModal = document.getElementById('purchaseModal');
    const connectWalletBtn = document.querySelector('.anime-btn.fa-wallet, .anime-btn:has(.fa-wallet)');
    const buyNowButtons = document.querySelectorAll('.anime-card button.anime-btn');
    const closeModalBtns = document.querySelectorAll('#closeModal, #closePurchaseModal');

    // Open wallet modal from Connect Wallet button
    if (connectWalletBtn) {
        connectWalletBtn.addEventListener('click', (e) => {
            e.preventDefault();
            walletModal.classList.remove('hidden');
        });
    }

    // Open wallet modal from Buy Now buttons
    buyNowButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const card = button.closest('.anime-card');
            const title = card.querySelector('h3').textContent;
            const price = card.querySelector('.text-lg').textContent;
            
            document.getElementById('purchaseContent').innerHTML = `
                <p class="text-gray-700 mb-4">You're about to purchase:</p>
                <h4 class="text-xl font-bold text-pink-600 mb-2">${title}</h4>
                <p class="text-gray-600">${price}</p>
                <div class="my-6 p-4 bg-gray-100 rounded-lg">
                    <p class="font-medium">Please connect your wallet to continue</p>
                </div>
            `;
            
            purchaseModal.classList.remove('hidden');
        });
    });

    // Close modals
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            walletModal.classList.add('hidden');
            purchaseModal.classList.add('hidden');
        });
    });

    // Close when clicking outside modal
    [walletModal, purchaseModal].forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });

    // Wallet selection
    document.querySelectorAll('.wallet-option').forEach(option => {
        option.addEventListener('click', () => {
            const walletName = option.querySelector('span').textContent;
            alert(`Connecting to ${walletName}...`);
            walletModal.classList.add('hidden');
            
            // Simulate successful connection
            if (connectWalletBtn) {
                connectWalletBtn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Connected';
                connectWalletBtn.classList.add('bg-green-500', 'hover:bg-green-600');
                connectWalletBtn.classList.remove('bg-gradient-to-r', 'from-pink-500', 'to-purple-600');
            }
        });
    });

    // Confirm purchase
    document.getElementById('confirmPurchase')?.addEventListener('click', () => {
        alert('Purchase completed successfully!');
        purchaseModal.classList.add('hidden');
    });
});