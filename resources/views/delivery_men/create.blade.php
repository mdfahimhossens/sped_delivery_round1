@extends('layouts.app')

@section('content')
<h2>Add Delivery Man</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('delivery-men.store') }}" method="POST">
    @csrf
    <div>
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <p style="color:red">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>
        @error('phone') <p style="color:red">{{ $message }}</p> @enderror
    </div>


    <div>
        <label>Status:</label>
        <select name="status" required>
            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="busy" {{ old('status') == 'busy' ? 'selected' : '' }}>Busy</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <p style="color:red">{{ $message }}</p> @enderror
    </div>

    <button type="submit">Add Delivery Man</button>
</form>
@endsection
