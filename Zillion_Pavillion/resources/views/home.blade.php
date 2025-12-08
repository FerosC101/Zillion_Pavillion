@extends('layouts.app')

@section('title', 'Zillion Pavillion - Luxury Hotel')

@section('content')
<!-- Home Section -->
<section id="home">
    <div class="slideshow">
        <div class="slide active" style="background-image: url('{{ asset('images/header1.png') }}');"></div>
        <div class="slide" style="background-image: url('{{ asset('images/header2.png') }}');"></div>
        <div class="slide" style="background-image: url('{{ asset('images/header3.png') }}');"></div>
    </div>
    <div class="home-content">
        <div class="small-label">WELCOME TO ZILLION PAVILION</div>
        <h1 class="big-label">Experience Luxury and Comfort</h1>
        <p class="section-description">Your Family & Business Hotel</p>
        <div class="booking-box">
            <div class="booking-field">
                <label for="checkin">Check In</label>
                <input type="date" id="checkin">
            </div>
            <div class="booking-field">
                <label for="checkout">Check Out</label>
                <input type="date" id="checkout">
            </div>
            <div class="booking-field">
                <label for="guests">Guests</label>
                <select id="guests">
                    <option value="1">1 Guest</option>
                    <option value="2">2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                    <option value="5+">5+ Guests</option>
                </select>
            </div>
            @auth('web')
                <button class="search-btn" onclick="window.location.href='{{ route('client.booking.create') }}'">
                    <i class="fas fa-search"></i> Search Rooms
                </button>
            @else
                <button class="search-btn" onclick="window.location.href='{{ route('login') }}'">
                    <i class="fas fa-sign-in-alt"></i> Login to Book
                </button>
            @endauth
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about">
    <div class="section-container">
        <div class="small-label">ABOUT US</div>
        <h2 class="big-label">Welcome to Zillion Pavilion</h2>
        <p class="section-description">Your trusted partner for comfort and hospitality in Lipa City</p>
        
        <div class="about-container">
            <div class="about-content">
                <p>Zillion Pavilion has been serving guests in Lipa City with pride and dedication. Located in the heart of Batangas, we offer a perfect blend of comfort, convenience, and affordability for both leisure and business travelers.</p>
                
                <div class="about-stats">
                    <div class="stat-box">
                        <i class="fas fa-bed"></i>
                        <h4>50+</h4>
                        <p>Rooms</p>
                    </div>
                    <div class="stat-box">
                        <i class="fas fa-star"></i>
                        <h4>4.5/5</h4>
                        <p>Rating</p>
                    </div>
                    <div class="stat-box">
                        <i class="fas fa-clock"></i>
                        <h4>24/7</h4>
                        <p>Service</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rooms Section -->
<section id="rooms">
    <div class="section-container">
        <div class="small-label">OUR ACCOMMODATIONS</div>
        <h2 class="big-label">Rooms & Rates</h2>
        <p class="section-description">Discover comfortable accommodations designed for your perfect stay</p>
        
        <!-- Booking Search Box -->
        <div class="room-search-box">
            <div class="search-field">
                <label for="room-checkin">Check-in</label>
                <input type="date" id="room-checkin" class="room-date-input">
            </div>
            <div class="search-field">
                <label for="room-checkout">Check-out</label>
                <input type="date" id="room-checkout" class="room-date-input">
            </div>
            <div class="search-field">
                <label for="room-rooms">Rooms</label>
                <select id="room-rooms" class="room-select-input">
                    <option value="1">1 Room</option>
                    <option value="2">2 Rooms</option>
                    <option value="3">3 Rooms</option>
                    <option value="4">4 Rooms</option>
                </select>
            </div>
            <div class="search-field">
                <label for="room-adults">Adults</label>
                <select id="room-adults" class="room-select-input">
                    <option value="1">1 Adult</option>
                    <option value="2" selected>2 Adults</option>
                    <option value="3">3 Adults</option>
                    <option value="4">4 Adults</option>
                    <option value="5">5 Adults</option>
                </select>
            </div>
            <div class="search-field">
                <label for="room-kids">Kids</label>
                <select id="room-kids" class="room-select-input">
                    <option value="0" selected>0 Kids</option>
                    <option value="1">1 Kid</option>
                    <option value="2">2 Kids</option>
                    <option value="3">3 Kids</option>
                    <option value="4">4 Kids</option>
                </select>
            </div>
            <button class="find-rooms-btn" onclick="checkRates()">
                <i class="fas fa-search"></i> Check Availability
            </button>
        </div>

        <div class="rooms-container">
            <!-- Room 1: Budget -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/superiorking.jpg') }}');"></div>
                <div class="price-tag">From ₱1,474/night</div>
                <div class="room-details">
                    <h3 class="room-name">Budget</h3>
                    <p class="room-type">Well-kept Fans</p>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-wifi"></i>
                            <span>Free Internet</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-parking"></i>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Check Rates</button>
                </div>
            </div>
            
            <!-- Room 2: Deluxe 1 Queen Bed -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/superiortwin.jpg') }}');"></div>
                <div class="price-tag">From ₱1,673/night</div>
                <div class="room-details">
                    <h3 class="room-name">Deluxe 1 Queen Bed</h3>
                    <p class="room-type">Well-kept Fans</p>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-wifi"></i>
                            <span>Free Internet</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-parking"></i>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Check Rates</button>
                </div>
            </div>
            
            <!-- Room 3: Superior 1 Queen Bed -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/superiorking.jpg') }}');"></div>
                <div class="price-tag">From ₱1,872/night</div>
                <div class="room-details">
                    <h3 class="room-name">Superior 1 Queen Bed</h3>
                    <p class="room-type">Well-kept Fans</p>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-wifi"></i>
                            <span>Free Internet</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-parking"></i>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Check Rates</button>
                </div>
            </div>
            
            <!-- Room 4: Deluxe -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/superiortwin.jpg') }}');"></div>
                <div class="price-tag">From ₱1,971/night</div>
                <div class="room-details">
                    <h3 class="room-name">Deluxe</h3>
                    <p class="room-type">Well-kept Fans</p>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-wifi"></i>
                            <span>Free Internet</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-parking"></i>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Check Rates</button>
                </div>
            </div>
            
            <!-- Room 5: Family Studio -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/familyroom.jpg') }}');"></div>
                <div class="price-tag">From ₱3,185/night</div>
                <div class="room-details">
                    <h3 class="room-name">Family Studio</h3>
                    <p class="room-type">Well-kept Fans</p>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-wifi"></i>
                            <span>Free Internet</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-parking"></i>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Check Rates</button>
                </div>
            </div>
            
            <!-- Room 6: Deluxe Family -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/familyroom.jpg') }}');"></div>
                <div class="price-tag">From ₱4,262/night</div>
                <div class="room-details">
                    <h3 class="room-name">Deluxe Family</h3>
                    <p class="room-type">Well-kept Fans</p>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-wifi"></i>
                            <span>Free Internet</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-parking"></i>
                            <span>Free Parking</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Check Rates</button>
                </div>
            </div>
        </div>
        
        <div class="view-more-rooms">
            <p class="rooms-note">All rates are subject to availability. Contact us for special requests and long-term stays.</p>
        </div>
    </div>
</section>

<!-- Amenities Section -->
<section id="amenities">
    <div class="section-container">
        <div class="small-label">FACILITIES</div>
        <h2 class="big-label">Hotel Amenities</h2>
        <p class="section-description">Key facilities for your comfort</p>
        <div class="amenities-container">
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-wifi"></i></div>
                <h3 class="amenity-name">Free WiFi</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-parking"></i></div>
                <h3 class="amenity-name">Free Parking</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-clock"></i></div>
                <h3 class="amenity-name">24/7 Front Desk</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-utensils"></i></div>
                <h3 class="amenity-name">Restaurant</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-child"></i></div>
                <h3 class="amenity-name">Play Area</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-tv"></i></div>
                <h3 class="amenity-name">Cable TV</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-shield-alt"></i></div>
                <h3 class="amenity-name">Safety Measures</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-broom"></i></div>
                <h3 class="amenity-name">Housekeeping</h3>
            </div>
        </div>
        
        <div class="amenities-container hidden-amenities" id="moreAmenities" style="display: none;">
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-concierge-bell"></i></div>
                <h3 class="amenity-name">Room Service</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-car"></i></div>
                <h3 class="amenity-name">Car Rental</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-hands-helping"></i></div>
                <h3 class="amenity-name">Concierge</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-temperature-high"></i></div>
                <h3 class="amenity-name">Temperature Checks</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-hand-sparkles"></i></div>
                <h3 class="amenity-name">Hand Sanitizer</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-door-closed"></i></div>
                <h3 class="amenity-name">In Room Safe</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-wifi"></i></div>
                <h3 class="amenity-name">Free Internet</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-money-bill-wave"></i></div>
                <h3 class="amenity-name">ATM Machine</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-gamepad"></i></div>
                <h3 class="amenity-name">Game Room</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-fire"></i></div>
                <h3 class="amenity-name">BBQ Grills</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-soap"></i></div>
                <h3 class="amenity-name">Laundry</h3>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon"><i class="fas fa-smoking-ban"></i></div>
                <h3 class="amenity-name">Non-Smoking</h3>
            </div>
        </div>
        
        <div class="view-more-amenities">
            <button class="view-more-btn" id="viewMoreBtn" onclick="toggleAmenities()">
                <span id="btnText">View All Amenities</span>
                <i class="fas fa-chevron-down" id="btnIcon"></i>
            </button>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services">
    <div class="section-container">
        <div class="small-label">OUR SERVICES</div>
        <h2 class="big-label">Hotel Services</h2>
        <p class="section-description">Comprehensive services for your convenience</p>
        
        <div class="services-container">
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-concierge-bell"></i></div>
                <h3>Room Service</h3>
            </div>
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-tshirt"></i></div>
                <h3>Laundry Service</h3>
            </div>
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-user-tie"></i></div>
                <h3>Concierge</h3>
            </div>
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-shuttle-van"></i></div>
                <h3>Airport Transfer</h3>
            </div>
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-broom"></i></div>
                <h3>Housekeeping</h3>
            </div>
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-luggage-cart"></i></div>
                <h3>Luggage Storage</h3>
            </div>
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-coffee"></i></div>
                <h3>Breakfast</h3>
            </div>
            <div class="service-box">
                <div class="service-icon"><i class="fas fa-phone-volume"></i></div>
                <h3>Wake-up Call</h3>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery">
    <div class="section-container">
        <div class="small-label">GALLERY</div>
        <h2 class="big-label">Our Hotel</h2>
        <div class="gallery-container">
            <div class="gallery-image">
                <img src="{{ asset('images/gallery1.jpg') }}" alt="Hotel Interior">
            </div>
            <div class="gallery-image">
                <img src="{{ asset('images/gallery2.jpg') }}" alt="Hotel Facilities">
            </div>
            <div class="gallery-image">
                <img src="{{ asset('images/gallery3.jpg') }}" alt="Hotel Services">
            </div>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section id="offers">
    <div class="section-container">
        <div class="small-label">SPECIAL OFFERS</div>
        <h2 class="big-label">Current Promotions</h2>
        
        <div class="offers-container">
            <div class="offer-box">
                <div class="offer-badge">Popular</div>
                <div class="offer-icon"><i class="fas fa-calendar-check"></i></div>
                <h3>Extended Stay</h3>
                <p class="offer-discount">Save 20%</p>
                <p>Book 3+ nights and enjoy special rates.</p>
                <button class="offer-btn">Book Now</button>
            </div>
            <div class="offer-box">
                <div class="offer-badge">New</div>
                <div class="offer-icon"><i class="fas fa-users"></i></div>
                <h3>Family Package</h3>
                <p class="offer-discount">Save 15%</p>
                <p>Kids under 12 stay free with parents.</p>
                <button class="offer-btn">Book Now</button>
            </div>
            <div class="offer-box">
                <div class="offer-badge">Limited</div>
                <div class="offer-icon"><i class="fas fa-briefcase"></i></div>
                <h3>Business Deal</h3>
                <p class="offer-discount">Save 10%</p>
                <p>Exclusive rates for corporate guests.</p>
                <button class="offer-btn">Book Now</button>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section id="reviews">
    <div class="section-container">
        <div class="small-label">GUEST REVIEWS</div>
        <h2 class="big-label">What Our Guests Say</h2>
        
        <div class="review-summary">
            <div class="average-rating">4.5</div>
            <div class="rating-details">
                <div class="rating-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="rating-count">Based on 150+ reviews</div>
            </div>
        </div>
        
        <div class="reviews-container">
            <div class="review-box">
                <div class="review-header">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">November 2024</div>
                </div>
                <p class="review-text">"Excellent service and clean rooms. The staff was very accommodating and the location is perfect."</p>
            </div>
            <div class="review-box">
                <div class="review-header">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <div class="review-date">October 2024</div>
                </div>
                <p class="review-text">"Great value for money. Perfect for families and business travelers alike."</p>
            </div>
            <div class="review-box">
                <div class="review-header">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">December 2024</div>
                </div>
                <p class="review-text">"Clean, comfortable, and affordable. Highly recommended for anyone visiting Lipa City."</p>
            </div>
        </div>
    </div>
</section>

<!-- Nearby Attractions Section -->
<section id="attractions">
    <div class="section-container">
        <div class="small-label">EXPLORE LIPA CITY</div>
        <h2 class="big-label">Nearby Attractions</h2>
        
        <div class="attractions-container">
            <div class="attraction-box">
                <div class="attraction-icon"><i class="fas fa-shopping-bag"></i></div>
                <h3>SM City Lipa</h3>
                <p class="attraction-distance">3.5 km away</p>
            </div>
            <div class="attraction-box">
                <div class="attraction-icon"><i class="fas fa-church"></i></div>
                <h3>Lipa Cathedral</h3>
                <p class="attraction-distance">2.8 km away</p>
            </div>
            <div class="attraction-box">
                <div class="attraction-icon"><i class="fas fa-tree"></i></div>
                <h3>Mt. Malarayat</h3>
                <p class="attraction-distance">15 km away</p>
            </div>
            <div class="attraction-box">
                <div class="attraction-icon"><i class="fas fa-utensils"></i></div>
                <h3>Restaurants</h3>
                <p class="attraction-distance">Walking distance</p>
            </div>
            <div class="attraction-box">
                <div class="attraction-icon"><i class="fas fa-coffee"></i></div>
                <h3>Coffee Shops</h3>
                <p class="attraction-distance">1 km away</p>
            </div>
            <div class="attraction-box">
                <div class="attraction-icon"><i class="fas fa-building"></i></div>
                <h3>Business District</h3>
                <p class="attraction-distance">2 km away</p>
            </div>
        </div>
    </div>
</section>

<!-- Business & Events Section -->
<section id="business">
    <div class="section-container">
        <div class="small-label">BUSINESS & EVENTS</div>
        <h2 class="big-label">Meetings & Conferences</h2>
        
        <div class="business-container">
            <div class="business-content">
                <p>Host your meetings and events in our well-equipped facilities with modern amenities, catering services, and professional support.</p>
                
                <div class="business-features">
                    <div class="business-feature">
                        <i class="fas fa-users"></i>
                        <div>
                            <h4>Conference Room</h4>
                            <p>30-50 capacity</p>
                        </div>
                    </div>
                    <div class="business-feature">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <div>
                            <h4>Meeting Rooms</h4>
                            <p>Small to medium</p>
                        </div>
                    </div>
                    <div class="business-feature">
                        <i class="fas fa-laptop"></i>
                        <div>
                            <h4>AV Equipment</h4>
                            <p>Full setup</p>
                        </div>
                    </div>
                    <div class="business-feature">
                        <i class="fas fa-wifi"></i>
                        <div>
                            <h4>High-Speed WiFi</h4>
                            <p>Reliable connection</p>
                        </div>
                    </div>
                    <div class="business-feature">
                        <i class="fas fa-utensils"></i>
                        <div>
                            <h4>Catering</h4>
                            <p>Food & beverage</p>
                        </div>
                    </div>
                    <div class="business-feature">
                        <i class="fas fa-glass-cheers"></i>
                        <div>
                            <h4>Event Hall</h4>
                            <p>Celebrations</p>
                        </div>
                    </div>
                </div>
                
                <button class="book-now-btn"><i class="fas fa-calendar-alt"></i> Inquire About Events</button>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq">
    <div class="section-container">
        <div class="small-label">FAQ</div>
        <h2 class="big-label">Frequently Asked Questions</h2>
        
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-clock"></i><h3>Check-in and check-out times?</h3></div>
                <p class="faq-answer">Check-in: 2:00 PM | Check-out: 12:00 PM</p>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-parking"></i><h3>Is parking available?</h3></div>
                <p class="faq-answer">Yes, complimentary secure parking for all guests.</p>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-wifi"></i><h3>Is WiFi free?</h3></div>
                <p class="faq-answer">Yes! High-speed WiFi is complimentary throughout the hotel.</p>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-utensils"></i><h3>Is breakfast included?</h3></div>
                <p class="faq-answer">Depends on your room rate. Some packages include breakfast.</p>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-ban"></i><h3>Cancellation policy?</h3></div>
                <p class="faq-answer">Free cancellation up to 48 hours before arrival.</p>
            </div>
            <div class="faq-item">
                <div class="faq-question"><i class="fas fa-paw"></i><h3>Are pets allowed?</h3></div>
                <p class="faq-answer">Please contact us directly for our pet policy.</p>
            </div>
        </div>
    </div>
</section>

<!-- Hotel Policies Section -->
<section id="policies">
    <div class="section-container">
        <div class="small-label">POLICIES</div>
        <h2 class="big-label">Hotel Policies</h2>
        
        <div class="policies-container">
            <div class="policy-box">
                <h3><i class="fas fa-sign-in-alt"></i> Check-In / Check-Out</h3>
                <ul>
                    <li>Check-in: 2:00 PM</li>
                    <li>Check-out: 12:00 PM</li>
                    <li>Valid ID required</li>
                </ul>
            </div>
            <div class="policy-box">
                <h3><i class="fas fa-credit-card"></i> Payment</h3>
                <ul>
                    <li>Cash & credit cards accepted</li>
                    <li>Deposit may be required</li>
                    <li>Rates in Philippine Peso</li>
                </ul>
            </div>
            <div class="policy-box">
                <h3><i class="fas fa-times-circle"></i> Cancellation</h3>
                <ul>
                    <li>Free cancellation 48hrs before</li>
                    <li>Late cancellations charged</li>
                    <li>No-shows charged one night</li>
                </ul>
            </div>
            <div class="policy-box">
                <h3><i class="fas fa-child"></i> Children</h3>
                <ul>
                    <li>Under 12 stay free</li>
                    <li>Extra bed charges may apply</li>
                    <li>Cribs available</li>
                </ul>
            </div>
            <div class="policy-box">
                <h3><i class="fas fa-smoking-ban"></i> House Rules</h3>
                <ul>
                    <li>No smoking in rooms</li>
                    <li>Quiet hours: 10PM - 7AM</li>
                    <li>Respect other guests</li>
                </ul>
            </div>
            <div class="policy-box">
                <h3><i class="fas fa-shield-alt"></i> Security</h3>
                <ul>
                    <li>24/7 security personnel</li>
                    <li>CCTV monitoring</li>
                    <li>Safe deposit boxes</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section id="contact">
    <div class="section-container">
        <div class="small-label">GET IN TOUCH</div>
        <h2 class="big-label">Contact Us</h2>
        
        <div class="contact-container">
            <div class="contact-form-wrapper">
                <form class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name">Name *</label>
                            <input type="text" id="contact-name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email *</label>
                            <input type="email" id="contact-email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-phone">Phone</label>
                            <input type="tel" id="contact-phone">
                        </div>
                        <div class="form-group">
                            <label for="contact-subject">Subject *</label>
                            <select id="contact-subject" required>
                                <option value="">Select</option>
                                <option value="reservation">Reservation</option>
                                <option value="event">Event</option>
                                <option value="general">General</option>
                                <option value="feedback">Feedback</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-message">Message *</label>
                        <textarea id="contact-message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Send</button>
                </form>
            </div>
            
            <div class="contact-info-wrapper">
                <h3>Contact Information</h3>
                <div class="contact-detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <h4>Address</h4>
                        <p>A. Tanco Road, Balintawak, Lipa City</p>
                    </div>
                </div>
                <div class="contact-detail">
                    <i class="fas fa-phone"></i>
                    <div>
                        <h4>Phone</h4>
                        <p>+63 9056568481</p>
                    </div>
                </div>
                <div class="contact-detail">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <h4>Email</h4>
                        <p>thepavilion@zillionbuilders.com</p>
                    </div>
                </div>
                <div class="contact-detail">
                    <i class="fas fa-clock"></i>
                    <div>
                        <h4>Front Desk</h4>
                        <p>Open 24/7</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<section id="location">
    <div class="section-container">
        <div class="small-label">LOCATION</div>
        <h2 class="big-label">Find Us</h2>
        <p class="section-description">Visit us at our convenient location</p>
        <div class="location-container">
            <div class="location-info">
                <h3>Zillion Pavilion</h3>
                <p>Conveniently located in Lipa City, Batangas. Easy access to SM City Lipa, business districts, restaurants, and major attractions.</p>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Address</h4>
                            <p>A. Tanco Road, Balintawak, Lipa City</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>+63 9056568481</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>thepavilion@zillionbuilders.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Front Desk Hours</h4>
                            <p>24/7 Available</p>
                        </div>
                    </div>
                </div>
                
                <div class="latest-news">
                    <h4>Why Choose Us?</h4>
                    <ul>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Free WiFi & Parking</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>24/7 Front Desk Service</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Family & Business Friendly</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="location-map">
                <iframe src="https://www.google.com/maps/embed?pb=!3m1!4b1!4m9!3m8!1s0x33bd6c9aa6056cdb:0xea4f93cad3f2e88a!5m2!4m1!1i2!8m2!3d13.9545156!4d121.1601751!16s%2Fg%2F11b5ph_lnd?entry=ttu&g_ep=EgoyMDI1MTEyMy4xIKXMDSoASAFQAw%3D%3D" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

<script>
// Set minimum dates for home booking box
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowStr = tomorrow.toISOString().split('T')[0];
    
    const checkinHome = document.getElementById('checkin');
    const checkoutHome = document.getElementById('checkout');
    
    if (checkinHome) {
        checkinHome.setAttribute('min', today);
        checkinHome.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const nextDay = new Date(selectedDate);
            nextDay.setDate(nextDay.getDate() + 1);
            if (checkoutHome) {
                checkoutHome.setAttribute('min', nextDay.toISOString().split('T')[0]);
            }
        });
    }
    
    if (checkoutHome) {
        checkoutHome.setAttribute('min', tomorrowStr);
    }
});
</script>
@endsection
