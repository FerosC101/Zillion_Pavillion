@extends('client.layout')

@section('title', 'Book Your Stay')
@section('page-title', 'Book Your Stay')
@section('page-subtitle', 'Reserve your perfect accommodation with us')

@push('styles')
<style>
    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        padding: 2rem;
    }
    .room-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border: 3px solid transparent;
    }

    .room-card.selected {
        border-color: var(--primary-color);
        position: relative;
    }
    
    .room-card.selected::before {
        content: '✓ Selected';
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary-color);
        color: #fff;
        padding: 8px 16px;
        border-radius: 5px;
        font-weight: 600;
        font-size: 0.85rem;
        z-index: 10;
    }

    .room-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }

    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-type-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(255, 59, 48, 0.95);
        color: #fff;
        padding: 8px 16px;
        border-radius: 5px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .room-price {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 10px 16px;
        border-radius: 5px;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .room-details {
        padding: 1.5rem;
    }

    .room-details h3 {
        margin: 0 0 0.5rem 0;
        color: #2c3e50;
        font-size: 1.4rem;
    }

    .room-description {
        color: #7f8c8d;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .room-specs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin: 1rem 0;
    }

    .spec-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #2c3e50;
        font-size: 0.9rem;
    }

    .spec-item i {
        color: var(--primary-color);
        width: 20px;
    }

    .room-amenities {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin: 1rem 0;
    }

    .amenity-tag {
        background: #f8f9fa;
        padding: 5px 12px;
        border-radius: 5px;
        font-size: 0.8rem;
        color: #2c3e50;
    }

    .amenity-tag i {
        color: var(--primary-color);
        font-size: 0.7rem;
    }

    .btn-select-room {
        width: 100%;
        padding: 12px;
        background: var(--primary-color);
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        margin-top: 1rem;
    }

    .btn-select-room:hover {
        background: var(--primary-dark);
    }

    .selected-room-info {
        background: var(--primary-color);
        color: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .selected-room-info h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .selected-room-info p {
        margin: 0;
        opacity: 0.95;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2c3e50;
        font-weight: 500;
    }

    .form-group label span {
        color: #ff3b30;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 59, 48, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }

    .service-card {
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        cursor: pointer;
        position: relative;
        background: #fff;
    }

    .service-card.selected {
        border-color: var(--primary-color);
        background: rgba(255, 59, 48, 0.05);
    }
    
    .service-card.selected::after {
        content: '✓';
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .service-card input[type="checkbox"] {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .service-card h4 {
        margin: 0 0 10px 0;
        color: #2c3e50;
        font-size: 1.15rem;
        font-weight: 600;
    }

    .service-card p {
        margin: 5px 0 15px 0;
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .service-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-top: 10px;
        display: inline-block;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .total-preview {
        background: var(--primary-color);
        color: #fff;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        margin: 30px 0;
    }

    .total-preview h3 {
        margin: 0 0 15px 0;
        font-size: 1.3rem;
        font-weight: 600;
        opacity: 0.95;
    }

    .total-preview .amount {
        font-size: 3rem;
        font-weight: 700;
    }

    .btn-group {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        Select Your Room
    </div>

    <div class="rooms-grid" id="roomsGrid">
        @foreach($rooms as $room)
            <div class="room-card" data-room-id="{{ $room->id }}" data-room-type="{{ $room->type }}" data-price="{{ $room->price_per_night }}">
                <div class="room-image">
                    <img src="{{ asset('images/' . $room->images[0]) }}" alt="{{ $room->name }}" onerror="this.src='{{ asset('images/placeholder-room.jpg') }}'">
                    <div class="room-type-badge">{{ $room->type }}</div>
                    <div class="room-price">₱{{ number_format($room->price_per_night, 0) }}/night</div>
                </div>
                <div class="room-details">
                    <h3>{{ $room->name }}</h3>
                    <p class="room-description">{{ $room->description }}</p>
                    
                    <div class="room-specs">
                        <div class="spec-item">
                            <i class="fas fa-users"></i>
                            <span>Up to {{ $room->max_occupancy }} guests</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-bed"></i>
                            <span>{{ $room->bed_count }} {{ $room->bed_type }} bed(s)</span>
                        </div>
                        <div class="spec-item">
                            <i class="fas fa-ruler-combined"></i>
                            <span>{{ $room->size_sqm }}m²</span>
                        </div>
                        @if($room->view_type)
                        <div class="spec-item">
                            <i class="fas fa-eye"></i>
                            <span>{{ $room->view_type }} view</span>
                        </div>
                        @endif
                    </div>

                    <div class="room-amenities">
                        @foreach(array_slice($room->amenities, 0, 5) as $amenity)
                            <span class="amenity-tag"><i class="fas fa-check"></i> {{ $amenity }}</span>
                        @endforeach
                        @if(count($room->amenities) > 5)
                            <span class="amenity-tag">+{{ count($room->amenities) - 5 }} more</span>
                        @endif
                    </div>

                    <button type="button" class="btn-select-room" onclick="selectRoom({{ $room->id }}, '{{ $room->name }}', {{ $room->price_per_night }})">
                        <i class="fas fa-check-circle"></i> Select This Room
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="card" id="bookingForm" style="display: none; margin-top: 2rem;">
    <div class="card-header">
        Complete Your Reservation
    </div>

    <form action="{{ route('client.booking.store') }}" method="POST" id="reservationForm">
        @csrf
        <input type="hidden" name="room_id" id="selected_room_id">
        <input type="hidden" name="room_type" id="selected_room_type">

        <div class="selected-room-info" id="selectedRoomInfo">
            <!-- Will be filled by JavaScript -->
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="check_in_date">Check-In Date <span>*</span></label>
                <input type="date" name="check_in_date" id="check_in_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('check_in_date') }}" required>
            </div>

            <div class="form-group">
                <label for="check_out_date">Check-Out Date <span>*</span></label>
                <input type="date" name="check_out_date" id="check_out_date" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('check_out_date') }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="number_of_rooms">Number of Rooms <span>*</span></label>
                <select name="number_of_rooms" id="number_of_rooms" class="form-control" required>
                    <option value="">Select number of rooms</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('number_of_rooms') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'Room' : 'Rooms' }}</option>
                    @endfor
                    <option value="6" {{ old('number_of_rooms') == '6' ? 'selected' : '' }}>5+ Rooms (Contact us)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="room_type">Room Type <span>*</span></label>
                <select name="room_type" id="room_type" class="form-control" required>
                    <option value="">Select room type</option>
                    <option value="Standard" {{ old('room_type') == 'Standard' ? 'selected' : '' }}>Standard Room</option>
                    <option value="Deluxe" {{ old('room_type') == 'Deluxe' ? 'selected' : '' }}>Deluxe Room</option>
                    <option value="Suite" {{ old('room_type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                    <option value="Family" {{ old('room_type') == 'Family' ? 'selected' : '' }}>Family Room</option>
                    <option value="Executive" {{ old('room_type') == 'Executive' ? 'selected' : '' }}>Executive Suite</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="adults">Number of Adults <span>*</span></label>
                <input type="number" name="adults" id="adults" class="form-control" min="1" max="20" value="{{ old('adults', 1) }}" required>
            </div>

            <div class="form-group">
                <label for="children">Number of Children</label>
                <input type="number" name="children" id="children" class="form-control" min="0" max="10" value="{{ old('children', 0) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="special_requests">Special Requests</label>
            <textarea name="special_requests" id="special_requests" class="form-control" placeholder="Any special requirements (e.g., late check-in, extra bed, dietary restrictions)...">{{ old('special_requests') }}</textarea>
        </div>

        <div class="form-group">
            <label>Additional Services</label>
            <div class="services-grid">
                @foreach($services as $service)
                    <div class="service-card" onclick="toggleService(this, {{ $service->id }})">
                        <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" 
                            {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                            onclick="event.stopPropagation(); updateTotal();">
                        <h4>{{ $service->name }}</h4>
                        <p>{{ $service->description }}</p>
                        <div class="service-price" data-price="{{ $service->price }}">₱{{ number_format($service->price, 2) }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="total-preview">
            <h3>Estimated Total</h3>
            <div class="amount">₱<span id="totalAmount">0.00</span></div>
            <p style="margin-top: 10px; font-size: 0.9rem; opacity: 0.9;">*Final price may vary based on room rates and length of stay</p>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i> Confirm Booking
            </button>
            <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
let selectedRoomPrice = 0;

function selectRoom(roomId, roomName, roomPrice) {
    // Update hidden fields
    document.getElementById('selected_room_id').value = roomId;
    document.getElementById('selected_room_type').value = roomName;
    selectedRoomPrice = roomPrice;
    
    // Update selected room info
    document.getElementById('selectedRoomInfo').innerHTML = `
        <h4><i class="fas fa-bed"></i> ${roomName}</h4>
        <p>₱${roomPrice.toLocaleString()}/night</p>
    `;
    
    // Mark room as selected
    document.querySelectorAll('.room-card').forEach(card => {
        card.classList.remove('selected');
    });
    event.target.closest('.room-card').classList.add('selected');
    
    // Show booking form and scroll to it
    document.getElementById('bookingForm').style.display = 'block';
    document.getElementById('bookingForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
    
    // Update total
    updateTotal();
}

function toggleService(card, serviceId) {
    const checkbox = card.querySelector('input[type="checkbox"]');
    checkbox.checked = !checkbox.checked;
    
    if (checkbox.checked) {
        card.classList.add('selected');
    } else {
        card.classList.remove('selected');
    }
    
    updateTotal();
}

function updateTotal() {
    let servicesTotal = 0;
    const checkboxes = document.querySelectorAll('input[name="services[]"]:checked');
    
    checkboxes.forEach(checkbox => {
        const card = checkbox.closest('.service-card');
        const price = parseFloat(card.querySelector('.service-price').dataset.price);
        servicesTotal += price;
        
        if (checkbox.checked) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    // Calculate nights
    const checkIn = document.getElementById('check_in_date').value;
    const checkOut = document.getElementById('check_out_date').value;
    let nights = 0;
    
    if (checkIn && checkOut) {
        const checkInDate = new Date(checkIn);
        const checkOutDate = new Date(checkOut);
        nights = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));
    }
    
    const roomTotal = selectedRoomPrice * nights;
    const grandTotal = roomTotal + servicesTotal;
    
    document.getElementById('totalAmount').textContent = grandTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
    
    // Set minimum dates
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    const checkInInput = document.getElementById('check_in_date');
    const checkOutInput = document.getElementById('check_out_date');
    
    if (checkInInput) {
        checkInInput.setAttribute('min', today.toISOString().split('T')[0]);
        
        // Update check-out min date when check-in changes
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const minCheckOut = new Date(checkInDate);
            minCheckOut.setDate(minCheckOut.getDate() + 1);
            if (checkOutInput) {
                checkOutInput.setAttribute('min', minCheckOut.toISOString().split('T')[0]);
                
                // Reset check-out if it's before new minimum
                if (checkOutInput.value && new Date(checkOutInput.value) <= checkInDate) {
                    checkOutInput.value = '';
                }
            }
            updateTotal();
        });
    }
    
    if (checkOutInput) {
        checkOutInput.setAttribute('min', tomorrow.toISOString().split('T')[0]);
        checkOutInput.addEventListener('change', updateTotal);
    }
});
</script>
@endpush
