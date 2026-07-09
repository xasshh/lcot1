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

// Hero background slideshow (sliding left-right)
// Slides are pre-rendered server-side by Blade with correct {{ asset() }} URLs
// (relative image paths would 404 on Laravel routes). This handler only manages
// animation: clones the first slide for seamless looping, then translates the
// strip on a timer or arrow click.
document.addEventListener('DOMContentLoaded', () => {
    const heroSlidesContainer = document.querySelector('.hero-slides');
    const prevBtn = document.getElementById('heroPrev');
    const nextBtn = document.getElementById('heroNext');

    if (!heroSlidesContainer) return;

    // Count real slides already in the DOM (rendered by Blade)
    const totalSlides = heroSlidesContainer.querySelectorAll('.hero-slide').length;
    if (totalSlides === 0) return;

    // Clone first slide and append to end for seamless forward loop
    const firstSlide = heroSlidesContainer.querySelector('.hero-slide');
    const firstClone = firstSlide.cloneNode(true);
    heroSlidesContainer.appendChild(firstClone);

    const totalWithClone = totalSlides + 1; // includes clone at end
    let currentHeroIndex = 0;
    const SLIDE_INTERVAL_MS = 5000; // 5 seconds

    function updateHeroSlidePosition(noTransition = false) {
        if (noTransition) {
            heroSlidesContainer.style.transition = 'none';
        }
        const offsetPercent = currentHeroIndex * -100;
        heroSlidesContainer.style.transform = `translateX(${offsetPercent}%)`;
        if (noTransition) {
            heroSlidesContainer.offsetHeight; // force reflow
            heroSlidesContainer.style.transition = '';
        }
    }

    function showNextHeroSlide() {
        currentHeroIndex += 1;
        if (currentHeroIndex >= totalWithClone) {
            currentHeroIndex = 0;
        }
        updateHeroSlidePosition();
        // When we land on the clone, reset to first slide seamlessly after transition
        if (currentHeroIndex === totalSlides) {
            heroSlidesContainer.addEventListener('transitionend', function onReset() {
                heroSlidesContainer.removeEventListener('transitionend', onReset);
                currentHeroIndex = 0;
                updateHeroSlidePosition(true);
            }, { once: true });
        }
    }

    function showPrevHeroSlide() {
        currentHeroIndex -= 1;
        if (currentHeroIndex < 0) {
            currentHeroIndex = totalSlides - 1;
        }
        updateHeroSlidePosition();
    }

    // Initialize position
    updateHeroSlidePosition();

    let heroTimer = setInterval(showNextHeroSlide, SLIDE_INTERVAL_MS);

    function resetHeroTimer() {
        clearInterval(heroTimer);
        heroTimer = setInterval(showNextHeroSlide, SLIDE_INTERVAL_MS);
    }

    prevBtn?.addEventListener('click', () => {
        showPrevHeroSlide();
        resetHeroTimer();
    });

    nextBtn?.addEventListener('click', () => {
        showNextHeroSlide();
        resetHeroTimer();
    });
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
        if (menuOverlay) menuOverlay.classList.add('active');
        // Add class to nav to hide hamburger
        const nav = document.querySelector('nav');
        if (nav) nav.classList.add('menu-open');
        // Also add class to body for additional selector support
        document.body.classList.add('menu-open');
        // Use CSS classes instead of inline styles for better control
        if (showMenuBtn) {
            showMenuBtn.style.display = 'none';
            showMenuBtn.classList.add('hidden');
        }
        if (closeMenuBtn) {
            closeMenuBtn.style.display = 'block';
            closeMenuBtn.classList.remove('hidden');
        }
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    // Function to close menu
    function closeMenu() {
        navLinks.classList.remove('active');
        if (menuOverlay) menuOverlay.classList.remove('active');
        // Remove class from nav to show hamburger
        const nav = document.querySelector('nav');
        if (nav) nav.classList.remove('menu-open');
        document.body.classList.remove('menu-open');
        // Use CSS classes instead of inline styles for better control
        if (showMenuBtn) {
            showMenuBtn.style.display = 'block';
            showMenuBtn.classList.remove('hidden');
        }
        if (closeMenuBtn) {
            closeMenuBtn.style.display = 'none';
            closeMenuBtn.classList.add('hidden');
        }
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

    // Handle nested programme groups in registration menu (touch / mobile)
    document.querySelectorAll('.registration-menu .programmes-group-toggle').forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            const group = toggle.closest('.programmes-group');
            const isOpen = group.classList.contains('is-open');

            document.querySelectorAll('.registration-menu .programmes-group').forEach(item => {
                item.classList.remove('is-open');
            });

            if (!isOpen) {
                group.classList.add('is-open');
            }
        });
    });

    document.querySelectorAll('.registration-menu').forEach(menu => {
        menu.addEventListener('mouseleave', () => {
            menu.querySelectorAll('.programmes-group').forEach(group => {
                group.classList.remove('is-open');
            });
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

    // Size each gallery frame to its image so photos fill the frame without cropping
    document.querySelectorAll('.gallery-item img').forEach(img => {
        const fitGalleryFrame = () => {
            const { naturalWidth, naturalHeight } = img;
            if (!naturalWidth || !naturalHeight) return;

            const frame = img.closest('.gallery-item');
            if (frame) {
                frame.style.setProperty('--aspect-ratio', `${naturalWidth} / ${naturalHeight}`);
            }
        };

        if (img.complete) {
            fitGalleryFrame();
        } else {
            img.addEventListener('load', fitGalleryFrame, { once: true });
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

// Slide-in-from-right animation for Rector's Desk heading
document.addEventListener('DOMContentLoaded', () => {
    const rectorHeading = document.querySelector('.rectors-desk h1');
    if (!rectorHeading) return;

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                rectorHeading.classList.add('slide-in-right-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.4,
        rootMargin: '0px'
    });

    observer.observe(rectorHeading);
});

// NOTE: The register form's behaviour (matric prefix, programme select) is
// handled by inline scripts in the Blade views (resources/views/auth/*).
// Do not add register-form JS here — a previous version of this file rewrote
// the #programTaken options on centre change and broke live registration.

// Account Registration

document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Reset error messages
    document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
    
    // Get form values
    const fullName = document.getElementById('fullName')?.value;
    const email = document.getElementById('email')?.value;
    const programCenter = document.getElementById('programCenter')?.value;
    const programTaken = document.getElementById('programTaken')?.value;
    const yearAdmitted = document.getElementById('yearAdmitted')?.value;
    const matricNumber = document.getElementById('matricNumber')?.value;
    const password = document.getElementById('password')?.value;
    const confirmPassword = document.getElementById('confirmPassword')?.value;
    
    // Validation
    let isValid = true;
    
    if (!fullName) {
        document.getElementById('nameError').style.display = 'block';
        isValid = false;
    }
    
    if (!email || !email.includes('@')) {
        document.getElementById('emailError').style.display = 'block';
        isValid = false;
    }
    
    if (!programCenter) {
        document.getElementById('programCenterError').style.display = 'block';
        isValid = false;
    }
    
    if (!programTaken) {
        document.getElementById('programTakenError').style.display = 'block';
        isValid = false;
    }
    
    if (!yearAdmitted) {
        document.getElementById('yearAdmittedError').style.display = 'block';
        isValid = false;
    }
    
    if (!matricNumber || matricNumber.trim() === '') {
        document.getElementById('matricError').style.display = 'block';
        isValid = false;
    }
    
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById('passwordError').style.display = 'block';
        isValid = false;
    }
    
    if (password !== confirmPassword) {
        document.getElementById('confirmPasswordError').style.display = 'block';
        isValid = false;
    }
    
    if (isValid) {
        // Here you would typically send the data to your server
        alert('Registration successful! Please check your email for verification.');
        window.location.href = 'login.html';
    }
});


