<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zillion Pavillion - Luxury Hotel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Zillion Pavillion" class="logo-img">
            </div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#rooms">Rooms</a></li>
                    <li><a href="#amenities">Amenities</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <li><a href="#location">Location</a></li>
                </ul>
            </nav>
            <div class="header-buttons">
                <button class="login-btn" onclick="window.location.href='/login'">
                    <i class="fas fa-user"></i> Staff Login
                </button>
                <button class="book-now-btn">Book Now</button>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <div class="footer-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Zillion Pavillion" class="footer-logo-img">
                </div>
                <p>Experience unparalleled luxury and comfort at our premier hotel destination. Your home away from home in the heart of the city.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#rooms">Rooms & Suites</a></li>
                    <li><a href="#amenities">Amenities</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#location">Location</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> A. Tanco Road, Balintawak, Lipa City</li>
                    <li><i class="fas fa-phone"></i> +63 9056568481</li>
                    <li><i class="fas fa-envelope"></i> thepavilion@zillionbuilders.com</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 Zillion Pavillion. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Slideshow functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const slideCount = slides.length;

        function showSlide(index) {
            // Remove active class from all slides
            slides.forEach(slide => slide.classList.remove('active'));
            
            // Add active class to current slide
            slides[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slideCount;
            showSlide(currentSlide);
        }

        //Slideshow
        setInterval(nextSlide, 5000); 

        // Smooth scrolling for navigation links
        document.querySelectorAll('nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                window.scrollTo({
                    top: targetSection.offsetTop - 80,
                    behavior: 'smooth'
                });
            });
        });

        // Header background change on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
                header.style.backdropFilter = 'blur(10px)';
            } else {
                header.style.backgroundColor = 'white';
                header.style.backdropFilter = 'none';
            }
        });

        // Set minimum date for check-in to today
        const today = new Date().toISOString().split('T')[0];
        const checkinInput = document.getElementById('checkin');
        const roomCheckinInput = document.getElementById('room-checkin');
        
        if (checkinInput) {
            checkinInput.min = today;
        }
        if (roomCheckinInput) {
            roomCheckinInput.min = today;
        }
        
        // Set minimum date for check-out to check-in date
        if (checkinInput) {
            checkinInput.addEventListener('change', function() {
                const checkoutInput = document.getElementById('checkout');
                if (checkoutInput) {
                    checkoutInput.min = this.value;
                }
            });
        }
        
        if (roomCheckinInput) {
            roomCheckinInput.addEventListener('change', function() {
                const roomCheckoutInput = document.getElementById('room-checkout');
                if (roomCheckoutInput) {
                    roomCheckoutInput.min = this.value;
                }
            });
        }
        
        // Check rates function
        function checkRates() {
            const checkin = document.getElementById('room-checkin').value;
            const checkout = document.getElementById('room-checkout').value;
            const rooms = document.getElementById('room-rooms').value;
            const adults = document.getElementById('room-adults').value;
            const kids = document.getElementById('room-kids').value;
            
            if (!checkin || !checkout) {
                alert('Please select check-in and check-out dates');
                return;
            }
            
            alert(`Searching for ${rooms} room(s) for ${adults} adult(s) and ${kids} kid(s) from ${checkin} to ${checkout}`);
            // TODO: Implement actual rate checking logic
        }
        
        // Toggle amenities function
        function toggleAmenities() {
            const moreAmenities = document.getElementById('moreAmenities');
            const btn = document.getElementById('viewMoreBtn');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');
            
            if (moreAmenities.style.display === 'none') {
                moreAmenities.style.display = 'grid';
                btnText.textContent = 'Show Less';
                btn.classList.add('active');
            } else {
                moreAmenities.style.display = 'none';
                btnText.textContent = 'View All Amenities';
                btn.classList.remove('active');
            }
        }

        // Book Now buttons functionality
        document.querySelectorAll('.book-now-btn, .room-book-btn').forEach(button => {
            button.addEventListener('click', function() {
                alert('Thank you for your interest! Our booking system will open in a new window.');
                //Redirect to a booking page
            });
        });

        // Review helpful functionality
        document.querySelectorAll('.review-helpful').forEach(item => {
            item.addEventListener('click', function() {
                const countElement = this.querySelector('span');
                let count = parseInt(countElement.textContent);
                count++;
                countElement.textContent = count + ' helpful';
                
                this.querySelector('i').className = 'fas fa-thumbs-up';
                this.style.color = '#ff3b30';
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
