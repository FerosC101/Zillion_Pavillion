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
        <div class="small-label">WELCOME TO ZILLION PAVILLION</div>
        <h1 class="big-label">Experience Luxury and Comfort</h1>
        <p class="section-description">Your family home away from home</p>
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
            <button class="search-btn">Search</button>
        </div>
    </div>
</section>

<!-- Rooms Section -->
<section id="rooms">
    <div class="section-container">
        <div class="small-label">OUR ACCOMMODATIONS</div>
        <h2 class="big-label">Rooms and Rates</h2>
        <p class="section-description">Choose from our selection of rooms and check availability</p>
        
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
                <i class="fas fa-search"></i> Find Rooms
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
            <button class="book-now-btn">Find Available Rooms</button>
        </div>
    </div>
</section>

<!-- Amenities Section -->
<section id="amenities">
    <div class="section-container">
        <div class="small-label">FACILITIES</div>
        <h2 class="big-label">Hotel Amenities</h2>
        <p class="section-description">Enjoy facilities and services designed for your comfort and convenience</p>
        <div class="amenities-container">
            <!-- Row 1 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h3 class="amenity-name">Room Service</h3>
                <p class="amenity-description">Convenient in-room dining service available for your comfort.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h3 class="amenity-name">Car Rental</h3>
                <p class="amenity-description">Easy access to car rental services for your convenience.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-child"></i>
                </div>
                <h3 class="amenity-name">Children's Play Area</h3>
                <p class="amenity-description">Safe and fun play area for children to enjoy.</p>
            </div>
            
            <!-- Row 2 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="amenity-name">24 Hour Front Desk</h3>
                <p class="amenity-description">Our staff is available round the clock to assist you.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-tv"></i>
                </div>
                <h3 class="amenity-name">Cable/Satellite TV</h3>
                <p class="amenity-description">Entertainment options with cable and satellite channels.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-spray-can"></i>
                </div>
                <h3 class="amenity-name">Property Cleaned with Disinfectant</h3>
                <p class="amenity-description">Maintaining high standards of cleanliness and hygiene.</p>
            </div>
            
            <!-- Row 3 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3 class="amenity-name">Restaurant</h3>
                <p class="amenity-description">Exquisite culinary experiences at our on-site restaurant.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="amenity-name">Guest Safety Measures</h3>
                <p class="amenity-description">Property confirms they are implementing guest safety measures.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-bed"></i>
                </div>
                <h3 class="amenity-name">Clean Bed Sheets & Towels</h3>
                <p class="amenity-description">Bed sheets and towels washed at 60°C/140°F minimum.</p>
            </div>
            
            <!-- Row 4 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3 class="amenity-name">Concierge</h3>
                <p class="amenity-description">Professional concierge services for all your needs.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-temperature-high"></i>
                </div>
                <h3 class="amenity-name">Temperature Checks</h3>
                <p class="amenity-description">Temperature checks available to guests for safety.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-mask"></i>
                </div>
                <h3 class="amenity-name">Masks Available</h3>
                <p class="amenity-description">Masks are available to guests when needed.</p>
            </div>
            
            <!-- Row 5 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-hand-sparkles"></i>
                </div>
                <h3 class="amenity-name">Free Hand Sanitizer</h3>
                <p class="amenity-description">Guests are provided with free hand sanitizer.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-box"></i>
                </div>
                <h3 class="amenity-name">Individually-Wrapped Food</h3>
                <p class="amenity-description">Individually-wrapped food options are available.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-door-closed"></i>
                </div>
                <h3 class="amenity-name">In Room Safe</h3>
                <p class="amenity-description">Secure your valuables in the in-room safe.</p>
            </div>
            
            <!-- Row 6 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-people-arrows"></i>
                </div>
                <h3 class="amenity-name">Social Distancing Measures</h3>
                <p class="amenity-description">Social distancing measures are in place throughout the property.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3 class="amenity-name">Internet Access - Free Public Access</h3>
                <p class="amenity-description">Complimentary high-speed WiFi throughout the hotel.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="amenity-name">ATM Machine</h3>
                <p class="amenity-description">ATM machine available on premises for your convenience.</p>
            </div>
            
            <!-- Row 7 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <h3 class="amenity-name">Game Room</h3>
                <p class="amenity-description">Entertainment and recreation in our game room.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <h3 class="amenity-name">Acrylic Shield in Contact Areas</h3>
                <p class="amenity-description">Acrylic shield between guests and staff in main contact areas.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-fire"></i>
                </div>
                <h3 class="amenity-name">BBQ Grills</h3>
                <p class="amenity-description">Outdoor BBQ grills available for guest use.</p>
            </div>
            
            <!-- Row 8 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-soap"></i>
                </div>
                <h3 class="amenity-name">Laundry</h3>
                <p class="amenity-description">Convenient laundry services for extended stays.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-smoking-ban"></i>
                </div>
                <h3 class="amenity-name">Non-Smoking Facility</h3>
                <p class="amenity-description">A smoke-free environment for all guests' comfort.</p>
            </div>
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-paw"></i>
                </div>
                <h3 class="amenity-name">Pet Friendly</h3>
                <p class="amenity-description">Pets are welcome at our hotel with prior arrangement.</p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery">
    <div class="section-container">
        <div class="small-label">GALLERY</div>
        <h2 class="big-label">Experience Zillion Pavillion</h2>
        <p class="section-description">A glimpse of luxury and comfort</p>
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

<!-- Reviews Section -->
<section id="reviews">
    <div class="section-container">
        <div class="small-label">GUEST REVIEWS</div>
        <h2 class="big-label">What Our Guests Say</h2>
        <p class="section-description">Real feedback from guests</p>
        
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
                <div class="rating-count">Based on 4 reviews</div>
            </div>
        </div>
        
        <div class="reviews-container">
            <!-- Review 1 -->
            <div class="review-box">
                <div class="review-header">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">October 15, 2023</div>
                </div>
                <p class="review-text">"Absolutely stunning hotel with exceptional service. The staff went above and beyond to make our stay memorable. The room was spacious and beautifully appointed."</p>
                <div class="review-footer">
                    <div class="reviewer">Anonymous</div>
                    <div class="review-helpful">
                        <i class="far fa-thumbs-up"></i>
                        <span>12 helpful</span>
                    </div>
                </div>
            </div>
            <!-- Review 2 -->
            <div class="review-box">
                <div class="review-header">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <div class="review-date">October 8, 2023</div>
                </div>
                <p class="review-text">"We had the most wonderful family vacation at Zillion Pavillion. The kids loved the pool, and we appreciated the attention to detail in every aspect of our stay."</p>
                <div class="review-footer">
                    <div class="reviewer">Anonymous</div>
                    <div class="review-helpful">
                        <i class="far fa-thumbs-up"></i>
                        <span>8 helpful</span>
                    </div>
                </div>
            </div>
            <!-- Review 3 -->
            <div class="review-box">
                <div class="review-header">
                    <div class="review-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="review-date">September 22, 2023</div>
                </div>
                <p class="review-text">"The presidential suite exceeded all expectations. The views were breathtaking, and the amenities were top-notch. This is now our go-to hotel in the city."</p>
                <div class="review-footer">
                    <div class="reviewer">Anonymous</div>
                    <div class="review-helpful">
                        <i class="far fa-thumbs-up"></i>
                        <span>15 helpful</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="review-write">
            <button class="book-now-btn">Write a Review</button>
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
                <h3>Zillion Pavillion</h3>
                <p>Experience luxury at our prime location with easy access to business districts, shopping centers, and cultural attractions.</p>
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
                    <h4>Latest News</h4>
                    <ul>
                        <li>
                            <i class="fas fa-newspaper"></i>
                            <span>New spa packages now available</span>
                        </li>
                        <li>
                            <i class="fas fa-newspaper"></i>
                            <span>Special holiday promotions starting soon</span>
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
@endsection
