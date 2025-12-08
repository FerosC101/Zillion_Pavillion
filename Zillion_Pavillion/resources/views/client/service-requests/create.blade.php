@extends('client.layout')

@section('title', 'New Service Request')
@section('page-title', 'New Service Request')
@section('page-subtitle', 'Request assistance from our staff')

@push('styles')
<style>
    .service-type-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .service-type-option {
        background: #fff;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .service-type-option:hover {
        border-color: var(--primary-color);
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(255, 59, 48, 0.2);
    }

    .service-type-option input[type="radio"] {
        display: none;
    }

    .service-type-option input[type="radio"]:checked + label {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: #fff;
        border-radius: 8px;
        padding: 10px;
    }

    .service-type-option label {
        cursor: pointer;
        margin: 0;
        transition: all 0.3s;
    }

    .service-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
        color: var(--primary-color);
    }

    .service-type-option input[type="radio"]:checked ~ .service-icon {
        color: #fff;
    }

    .priority-options {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .priority-option {
        flex: 1;
        min-width: 120px;
    }

    .priority-option input[type="radio"] {
        display: none;
    }

    .priority-option label {
        display: block;
        padding: 12px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }

    .priority-option input[type="radio"]:checked + label {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <span><i class="fas fa-concierge-bell"></i> Request Service</span>
        <a href="{{ route('client.service-requests.index') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('client.service-requests.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Service Type <span style="color: red;">*</span></label>
            <div class="service-type-grid">
                <div class="service-type-option">
                    <input type="radio" name="service_type" value="housekeeping" id="housekeeping" required>
                    <label for="housekeeping">
                        <div class="service-icon"><i class="fas fa-broom"></i></div>
                        <div>Housekeeping</div>
                    </label>
                </div>

                <div class="service-type-option">
                    <input type="radio" name="service_type" value="room_service" id="room_service" required>
                    <label for="room_service">
                        <div class="service-icon"><i class="fas fa-concierge-bell"></i></div>
                        <div>Room Service</div>
                    </label>
                </div>

                <div class="service-type-option">
                    <input type="radio" name="service_type" value="laundry" id="laundry" required>
                    <label for="laundry">
                        <div class="service-icon"><i class="fas fa-tshirt"></i></div>
                        <div>Laundry</div>
                    </label>
                </div>

                <div class="service-type-option">
                    <input type="radio" name="service_type" value="maintenance" id="maintenance" required>
                    <label for="maintenance">
                        <div class="service-icon"><i class="fas fa-tools"></i></div>
                        <div>Maintenance</div>
                    </label>
                </div>

                <div class="service-type-option">
                    <input type="radio" name="service_type" value="delivery" id="delivery" required>
                    <label for="delivery">
                        <div class="service-icon"><i class="fas fa-box"></i></div>
                        <div>Delivery</div>
                    </label>
                </div>

                <div class="service-type-option">
                    <input type="radio" name="service_type" value="other" id="other" required>
                    <label for="other">
                        <div class="service-icon"><i class="fas fa-ellipsis-h"></i></div>
                        <div>Other</div>
                    </label>
                </div>
            </div>
            @error('service_type')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="booking_id">Related Booking (Optional)</label>
            <select name="booking_id" id="booking_id" class="form-control">
                <option value="">-- Select a booking --</option>
                @foreach($bookings as $booking)
                    <option value="{{ $booking->id }}">
                        Booking #{{ $booking->id }} - {{ $booking->room_type }} 
                        ({{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d') }} - 
                        {{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }})
                    </option>
                @endforeach
            </select>
            @error('booking_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="room_number">Room Number (Optional)</label>
            <input type="text" name="room_number" id="room_number" class="form-control" 
                value="{{ old('room_number') }}" placeholder="e.g., 201, 305">
            @error('room_number')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Priority <span style="color: red;">*</span></label>
            <div class="priority-options">
                <div class="priority-option">
                    <input type="radio" name="priority" value="low" id="priority_low">
                    <label for="priority_low">Low</label>
                </div>
                <div class="priority-option">
                    <input type="radio" name="priority" value="normal" id="priority_normal" checked>
                    <label for="priority_normal">Normal</label>
                </div>
                <div class="priority-option">
                    <input type="radio" name="priority" value="high" id="priority_high">
                    <label for="priority_high">High</label>
                </div>
                <div class="priority-option">
                    <input type="radio" name="priority" value="urgent" id="priority_urgent">
                    <label for="priority_urgent">Urgent</label>
                </div>
            </div>
            @error('priority')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description <span style="color: red;">*</span></label>
            <textarea name="description" id="description" class="form-control" rows="5" 
                required placeholder="Please describe your request in detail...">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Submit Request
            </button>
            <a href="{{ route('client.service-requests.index') }}" class="btn btn-outline">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
