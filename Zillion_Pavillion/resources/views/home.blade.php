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
        <h2 class="big-label">Rooms and Suites</h2>
        <p class="section-description">Choose from our selection of rooms and suites</p>
        <div class="rooms-container">
            <!-- Room 1 -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/superiorking.jpg') }}');"></div>
                <div class="price-tag">P9,999/night</div>
                <div class="room-details">
                    <h3 class="room-name">Superior King</h3>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-bed"></i>
                            <span>King Bed</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-users"></i>
                            <span>2 Guests</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-expand"></i>
                            <span>35 sqm</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Book Now</button>
                </div>
            </div>
            <!-- Room 2 -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/superiortwin.jpg') }}');"></div>
                <div class="price-tag">P9,999/night</div>
                <div class="room-details">
                    <h3 class="room-name">Superior Twin</h3>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-bed"></i>
                            <span>Twin Beds</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-users"></i>
                            <span>2 Guests</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-expand"></i>
                            <span>35 sqm</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Book Now</button>
                </div>
            </div>
            <!-- Room 3 -->
            <div class="room-box">
                <div class="room-image" style="background-image: url('{{ asset('images/familyroom.jpg') }}');"></div>
                <div class="price-tag">P9,999/night</div>
                <div class="room-details">
                    <h3 class="room-name">Family Room</h3>
                    <div class="room-features">
                        <div class="feature">
                            <i class="fas fa-bed"></i>
                            <span>Multiple Beds</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-users"></i>
                            <span>4+ Guests</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-expand"></i>
                            <span>50 sqm</span>
                        </div>
                    </div>
                    <button class="room-book-btn">Book Now</button>
                </div>
            </div>
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
            <!-- Amenity 1 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-swimming-pool"></i>
                </div>
                <h3 class="amenity-name">Swimming Pool</h3>
                <p class="amenity-description">Relax in our temperature-controlled infinity pool with panoramic views.</p>
            </div>
            <!-- Amenity 2 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-spa"></i>
                </div>
                <h3 class="amenity-name">Spa & Wellness</h3>
                <p class="amenity-description">Rejuvenate with our range of therapeutic treatments and massages.</p>
            </div>
            <!-- Amenity 3 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <h3 class="amenity-name">Fitness Center</h3>
                <p class="amenity-description">State-of-the-art gym equipment for your workout routine.</p>
            </div>
            <!-- Amenity 4 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3 class="amenity-name">Fine Dining</h3>
                <p class="amenity-description">Exquisite culinary experiences at our award-winning restaurants.</p>
            </div>
            <!-- Amenity 5 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3 class="amenity-name">High-Speed WiFi</h3>
                <p class="amenity-description">Complimentary high-speed internet access throughout the hotel.</p>
            </div>
            <!-- Amenity 6 -->
            <div class="amenity-box">
                <div class="amenity-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h3 class="amenity-name">24/7 Concierge</h3>
                <p class="amenity-description">Our dedicated staff is available round the clock to assist you.</p>
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
