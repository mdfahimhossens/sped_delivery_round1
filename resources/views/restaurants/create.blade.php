@extends('layouts.app')

@section('content')
<h2>Add Restaurant</h2>
<form action="{{ route('restaurants.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Restaurant Name" required>

    <select name="type_id">
        <option value="">Select Type</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>

    <input type="text" name="latitude" placeholder="Latitude" required>
    <input type="text" name="longitude" placeholder="Longitude" required>

    <button type="submit">Save</button>
</form>

@endsection
