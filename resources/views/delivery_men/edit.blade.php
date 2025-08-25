@extends('layouts.app')

@section('content')
<h2>Edit Delivery Man</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('delivery-men.update', $deliveryMan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $deliveryMan->name) }}" required>
        @error('name') <p style="color:red">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone', $deliveryMan->phone) }}" required>
        @error('phone') <p style="color:red">{{ $message }}</p> @enderror
    </div>


    <div>
        <label>Status:</label>
        <select name="status" required>
            <option value="available" {{ old('status', $deliveryMan->status) == 'available' ? 'selected' : '' }}>Available</option>
            <option value="busy" {{ old('status', $deliveryMan->status) == 'busy' ? 'selected' : '' }}>Busy</option>
            <option value="inactive" {{ old('status', $deliveryMan->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <p style="color:red">{{ $message }}</p> @enderror
    </div>

    <button type="submit">Update Delivery Man</button>
</form>
@endsection
