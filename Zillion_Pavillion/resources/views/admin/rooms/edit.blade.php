@extends('admin.layout')

@section('page-title', 'Edit Room')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Room #{{ $room->room_number }}</h2>
    <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary">Back to Rooms</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Room Number</label>
                        <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $room->room_number) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $room->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" value="{{ old('type', $room->type) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price Per Night</label>
                        <input type="number" step="0.01" name="price_per_night" class="form-control" value="{{ old('price_per_night', $room->price_per_night) }}">
                    </div>

                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Rates</div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Effective</th>
                            <th>Default</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($room->rates as $rate)
                        <tr>
                            <td>{{ $rate->name }}</td>
                            <td>{{ $rate->currency }} {{ number_format($rate->price,2) }}</td>
                            <td>{{ $rate->effective_from ? $rate->effective_from->format('Y-m-d') : '-' }} to {{ $rate->effective_to ? $rate->effective_to->format('Y-m-d') : '-' }}</td>
                            <td>@if($rate->is_default) <span class="badge bg-success">Default</span> @endif</td>
                            <td>
                                <form action="{{ route('rooms.rates.destroy', ['room' => $room->id, 'rate' => $rate->id]) }}" method="POST" onsubmit="return confirm('Delete rate?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5">No rates defined</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <hr>

                <h6>Add Rate</h6>
                <form action="{{ route('rooms.rates.store', $room->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Rate name (e.g., Standard)">
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="number" step="0.01" name="price" class="form-control" placeholder="Price">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="text" name="currency" class="form-control" value="USD">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input type="date" name="effective_from" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="date" name="effective_to" class="form-control">
                        </div>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="is_default" value="1" id="is_default">
                        <label class="form-check-label" for="is_default">Set as default rate</label>
                    </div>
                    <button class="btn btn-success">Add Rate</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Room Preview</h5>
                <p><strong>Room #:</strong> {{ $room->room_number }}</p>
                <p><strong>Name:</strong> {{ $room->name }}</p>
                <p><strong>Type:</strong> {{ $room->type }}</p>
                <p><strong>Price per night:</strong> {{ $room->price_per_night ? '$'.number_format($room->price_per_night,2) : '-' }}</p>
                <p><strong>Default rate:</strong>
                    @if($room->currentRate)
                        {{ $room->currentRate->currency }} {{ number_format($room->currentRate->price,2) }} ({{ $room->currentRate->name }})
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
