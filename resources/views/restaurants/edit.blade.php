@extends('layouts.app')

@section('content')
<h2>Edit Restaurant</h2>
<form action="/restaurants/{{ $restaurant->id }}" method="POST">
    @csrf
    @method('PUT')
    Name: <input type="text" name="name" value="{{ $restaurant->name }}" required><br>
    Latitude: <input type="text" name="latitude" value="{{ $restaurant->latitude }}" required><br>
    Longitude: <input type="text" name="longitude" value="{{ $restaurant->longitude }}" required><br>
    <button type="submit">Update</button>
</form>
@endsection
