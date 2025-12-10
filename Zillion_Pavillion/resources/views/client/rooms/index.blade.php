@extends('client.layout')

@section('title', 'Available Rooms')
@section('page-title', 'Our Rooms')
@section('page-subtitle', 'Explore our beautiful rooms and book your stay')

@section('content')
<div class="rooms-grid">
    @forelse($rooms as $room)
    <div class="room-card">
        <div class="room-image">
            @if($room->images && count($room->images) > 0)
                <img src="{{ $room->images[0] }}" alt="{{ $room->name }}" class="img-fluid">
            @else
                <div class="placeholder-image">
                    <i class="fas fa-door-open"></i>
                </div>
            @endif
            <span class="room-badge">{{ $room->type }}</span>
        </div>
        <div class="room-details">
            <h5>{{ $room->name }}</h5>
            <p class="room-number">Room #{{ $room->room_number }}</p>
            
            <div class="room-features">
                <span class="feature"><i class="fas fa-users"></i> {{ $room->max_occupancy }} Guests</span>
                <span class="feature"><i class="fas fa-bed"></i> {{ $room->bed_count }} {{ $room->bed_type }}</span>
                <span class="feature"><i class="fas fa-ruler"></i> {{ $room->size_sqm }}m²</span>
            </div>

            <p class="room-description">{{ Str::limit($room->description, 80) }}</p>

            <div class="room-pricing">
                @if($room->currentRate)
                    <div class="price">
                        <span class="currency">{{ $room->currentRate->currency }}</span>
                        <span class="amount">{{ number_format($room->currentRate->price, 2) }}</span>
                        <span class="period">/ night</span>
                    </div>
                @else
                    <div class="price text-muted">Price upon inquiry</div>
                @endif
            </div>

            <a href="{{ route('client.rooms.show', $room->id) }}" class="btn btn-primary w-100 mt-3">
                <i class="fas fa-search-plus"></i> View & Book
            </a>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <i class="fas fa-door-open" style="font-size: 3rem; opacity: 0.3;"></i>
        <p class="mt-3">No rooms available at the moment</p>
    </div>
    @endforelse
</div>

{{ $rooms->links() }}

<style>
.rooms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.room-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s;
}

.room-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.12);
}

.room-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.room-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: rgba(0,0,0,0.2);
}

.room-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: var(--primary-color);
    color: #fff;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.room-details {
    padding: 20px;
}

.room-details h5 {
    font-weight: 700;
    margin-bottom: 4px;
    color: #2c3e50;
}

.room-number {
    font-size: 0.9rem;
    color: #95a5a6;
    margin-bottom: 12px;
}

.room-features {
    display: flex;
    gap: 12px;
    margin: 12px 0;
    flex-wrap: wrap;
}

.feature {
    font-size: 0.85rem;
    color: #7f8c8d;
    display: flex;
    align-items: center;
    gap: 4px;
}

.room-description {
    font-size: 0.9rem;
    color: #555;
    margin: 12px 0;
}

.room-pricing {
    margin: 15px 0;
}

.price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

.currency {
    font-size: 0.9rem;
    margin-right: 4px;
}

.period {
    font-size: 0.85rem;
    font-weight: 400;
    color: #7f8c8d;
    margin-left: 4px;
}

@media (max-width: 768px) {
    .rooms-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
}
</style>
@endsection
