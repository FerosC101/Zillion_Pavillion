@extends('admin.layout')

@section('page-title', 'Add New Room')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add New Room</h5>
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Rooms
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.rooms.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="room_number" class="form-label">Room Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('room_number') is-invalid @enderror" 
                                id="room_number" name="room_number" value="{{ old('room_number') }}" required>
                            @error('room_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Room Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Room Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="Standard" {{ old('type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                                <option value="Deluxe" {{ old('type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                <option value="Suite" {{ old('type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                                <option value="Executive" {{ old('type') == 'Executive' ? 'selected' : '' }}>Executive</option>
                                <option value="Family" {{ old('type') == 'Family' ? 'selected' : '' }}>Family</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price_per_night" class="form-label">Price Per Night (₱) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('price_per_night') is-invalid @enderror" 
                                id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}" required>
                            @error('price_per_night')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="max_occupancy" class="form-label">Max Occupancy <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('max_occupancy') is-invalid @enderror" 
                                id="max_occupancy" name="max_occupancy" value="{{ old('max_occupancy') }}" required>
                            @error('max_occupancy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="bed_count" class="form-label">Bed Count <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('bed_count') is-invalid @enderror" 
                                id="bed_count" name="bed_count" value="{{ old('bed_count') }}" required>
                            @error('bed_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="bed_type" class="form-label">Bed Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bed_type') is-invalid @enderror" 
                                id="bed_type" name="bed_type" value="{{ old('bed_type') }}" placeholder="e.g., Queen" required>
                            @error('bed_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="size_sqm" class="form-label">Size (m²) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('size_sqm') is-invalid @enderror" 
                                id="size_sqm" name="size_sqm" value="{{ old('size_sqm') }}" required>
                            @error('size_sqm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="view_type" class="form-label">View Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('view_type') is-invalid @enderror" 
                                id="view_type" name="view_type" value="{{ old('view_type') }}" placeholder="e.g., City, Garden" required>
                            @error('view_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="floor_number" class="form-label">Floor Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('floor_number') is-invalid @enderror" 
                                id="floor_number" name="floor_number" value="{{ old('floor_number') }}" required>
                            @error('floor_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="is_available" class="form-label">Availability <span class="text-danger">*</span></label>
                            <select class="form-select @error('is_available') is-invalid @enderror" id="is_available" name="is_available" required>
                                <option value="1" {{ old('is_available', '1') == '1' ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ old('is_available') == '0' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                            @error('is_available')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amenities <span class="text-danger">*</span></label>
                        <div id="amenities-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="amenities[]" placeholder="Enter amenity" required>
                                <button type="button" class="btn btn-outline-success" onclick="addAmenity()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <small class="text-muted">Add amenities like WiFi, Air Conditioning, TV, etc.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Images <span class="text-danger">*</span></label>
                        <div id="images-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="images[]" placeholder="Image filename (e.g., gallery1.jpg)" required>
                                <button type="button" class="btn btn-outline-success" onclick="addImage()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <small class="text-muted">Enter image filenames from public/images directory</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Create Room
                        </button>
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function addAmenity() {
    const container = document.getElementById('amenities-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="amenities[]" placeholder="Enter amenity">
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
            <i class="bi bi-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

function addImage() {
    const container = document.getElementById('images-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="images[]" placeholder="Image filename">
        <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
            <i class="bi bi-trash"></i>
        </button>
    `;
    container.appendChild(div);
}
</script>
@endsection
