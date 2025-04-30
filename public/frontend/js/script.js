const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('a');
    
    link.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Close other dropdowns
        dropdowns.forEach(other => {
            if (other !== dropdown) {
                other.classList.remove('active');
                const content = other.querySelector('.dropdown-content');
                if (content) {
                    content.style.display = 'none';
                }
            }
        });
        
        // Toggle current dropdown
        dropdown.classList.toggle('active');
        const dropdownContent = dropdown.querySelector('.dropdown-content');
        if (dropdownContent) {
            dropdownContent.style.display = 
                dropdownContent.style.display === 'block' ? 'none' : 'block';
        }
    });
});



// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown')) {
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
            const content = dropdown.querySelector('.dropdown-content');
            if (content) {
                content.style.display = 'none';
            }
        });
    }
});



// Counter Animation
const counters = document.querySelectorAll('.counter');
let hasAnimated = false;

function animateCounter(counter) {
    const target = parseInt(counter.getAttribute('data-target'));
    let current = 0;
    const increment = target / 50; // Adjust this value to change animation speed

    const updateCounter = () => {
        if (current < target) {
            current += increment;
            counter.textContent = `${Math.floor(current)}`; // Add plus sign to final number
            requestAnimationFrame(updateCounter);
        } else {
            counter.textContent = `${target}`; // Add plus sign to final number
        }
    };

    updateCounter();
}

// Use Intersection Observer to trigger animation when counters are visible
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !hasAnimated) {
            const counter = entry.target;
            animateCounter(counter);
            if (entry.target === counters[counters.length - 1]) {
                hasAnimated = true;
            }
        }
    });
}, observerOptions);

counters.forEach(counter => observer.observe(counter));


document.addEventListener('DOMContentLoaded', () => {
    // Intersection Observer for fade-up animations
    const observerOptions = {
        threshold: 0.2,
        rootMargin: "0px"
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add appear class to section title and description
                if (entry.target.classList.contains('executive-staff')) {
                    entry.target.querySelector('h2').classList.add('appear');
                    entry.target.querySelector('p').classList.add('appear');
                }
                
                // Add appear class to all staff cards
                entry.target.querySelectorAll('.staff-card').forEach(card => {
                    card.classList.add('appear');
                });
                
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe the executive staff section
    const staffSection = document.querySelector('.executive-staff');
    if (staffSection) {
        // Add fade-up class to title and description
        staffSection.querySelector('h2').classList.add('fade-up');
        staffSection.querySelector('p').classList.add('fade-up');
        
        observer.observe(staffSection);
    }
});

// Events Slider
const eventsSlider = document.getElementById('eventsSlider');
const prevBtn = document.getElementById('prevEvent');
const nextBtn = document.getElementById('nextEvent');

if (eventsSlider && prevBtn && nextBtn) {
    let slideIndex = 0;

    nextBtn.addEventListener('click', () => {
        slideIndex++;
        updateSliderPosition();
    });

    prevBtn.addEventListener('click', () => {
        slideIndex--;
        updateSliderPosition();
    });

    function updateSliderPosition() {
        const slides = eventsSlider.children;
        if (slideIndex >= slides.length) slideIndex = 0;
        if (slideIndex < 0) slideIndex = slides.length - 1;

        eventsSlider.style.transform = `translateX(-${slideIndex * 100}%)`;
    }
}

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Add active class to current navigation item
const currentLocation = location.href;
const menuItems = document.querySelectorAll('.nav-links ul li a');
menuItems.forEach(link => {
    if (link.href === currentLocation) {
        link.classList.add('active');
    }
});

// Image slideshow functionality
function initializeSlideshow() {
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    function showNextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // Change slide every 4 seconds
    setInterval(showNextSlide, 4000);
}

// Add this to your existing window.onload or document.addEventListener
document.addEventListener('DOMContentLoaded', initializeSlideshow);

document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling for the Explore Programs button
    document.querySelector('a[href="#programs"]').addEventListener('click', function(e) {
        e.preventDefault();
        
        document.querySelector('#programs').scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Update event date to current date
    const currentDate = new Date();
    const day = currentDate.getDate();
    const month = currentDate.toLocaleString('default', { month: 'short' }).toUpperCase();
    
    document.querySelector('.event-date .day').textContent = day;
    document.querySelector('.event-date .month').textContent = month;
});

document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.2,
        rootMargin: "0px"
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('programs')) {
                    // Add appear class to section title and description
                    entry.target.querySelector('h2').classList.add('appear');
                    entry.target.querySelector('.section-description').classList.add('appear');
                    
                    // Add appear class to all program cards
                    entry.target.querySelectorAll('.program-card').forEach(card => {
                        card.classList.add('appear');
                    });
                    
                    // Stop observing after animation
                    observer.unobserve(entry.target);
                }
            }
        });
    }, observerOptions);

    // Initialize programs section animation
    const programsSection = document.querySelector('.programs');
    if (programsSection) {
        // Add fade-up class to title and description
        programsSection.querySelector('h2').classList.add('fade-up');
        programsSection.querySelector('.section-description').classList.add('fade-up');
        
        // Start observing the section
        observer.observe(programsSection);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopButton = document.getElementById('scrollToTop');

    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) { // Show button after 300px of scrolling
            scrollToTopButton.classList.add('visible');
        } else {
            scrollToTopButton.classList.remove('visible');
        }
    });

    // Scroll to top when button is clicked
    scrollToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelector('.nav-links');
    const showMenuBtn = document.getElementById('showMenu');
    const closeMenuBtn = document.getElementById('closeMenu');
    const menuOverlay = document.querySelector('.menu-overlay');
    const dropdowns = document.querySelectorAll('.dropdown');

    // Function to open menu
    function openMenu() {
        navLinks.classList.add('active');
        menuOverlay.classList.add('active');
        showMenuBtn.style.display = 'none';
        closeMenuBtn.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    // Function to close menu
    function closeMenu() {
        navLinks.classList.remove('active');
        menuOverlay.classList.remove('active');
        showMenuBtn.style.display = 'block';
        closeMenuBtn.style.display = 'none';
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Show mobile menu
    showMenuBtn?.addEventListener('click', openMenu);

    // Hide mobile menu
    closeMenuBtn?.addEventListener('click', closeMenu);

    // Close menu when clicking overlay
    menuOverlay?.addEventListener('click', closeMenu);

    // Handle dropdowns on mobile
    dropdowns.forEach(dropdown => {
        const link = dropdown.querySelector('a');
        link.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024) {
                e.preventDefault();
                dropdown.classList.toggle('active');
            }
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 1024 && 
            !navLinks.contains(e.target) && 
            !showMenuBtn.contains(e.target)) {
            closeMenu();
        }
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            closeMenu();
            dropdowns.forEach(dropdown => dropdown.classList.remove('active'));
        }
    });

    // Handle escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMenu();
        }
    });
});



document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.checkout-form');
    const payNowButton = document.getElementById('payNow');
    const inputs = form.querySelectorAll('input');

    function checkFormCompletion() {
        let allFilled = true;
        inputs.forEach(input => {
            if (input.value.trim() === '') {
                allFilled = false;
            }
        });
        payNowButton.disabled = !allFilled;
    }

    inputs.forEach(input => {
        input.addEventListener('input', checkFormCompletion);
    });

    checkFormCompletion(); // Initial check
});

