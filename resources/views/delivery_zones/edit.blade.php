@extends('layouts.app')

@section('content')
<h2>Edit Delivery Zone</h2>
<form action="/delivery-zones/{{ $zone->id }}" method="POST">
    @csrf
    @method('PUT')
    Restaurant:
    <select name="restaurant_id" required>
        @foreach($restaurants as $r)
            <option value="{{ $r->id }}" {{ $zone->restaurant_id == $r->id ? 'selected' : '' }}>
                {{ $r->name }}
            </option>
        @endforeach
    </select><br>

    Type:
    <select name="type" required>
        <option value="radius" {{ $zone->type == 'radius' ? 'selected' : '' }}>Radius</option>
        <option value="polygon" {{ $zone->type == 'polygon' ? 'selected' : '' }}>Polygon</option>
    </select><br>

    Data (JSON format):
    <textarea name="data" required>{{ $zone->data }}</textarea><br>

    <button type="submit">Update</button>
</form>
@endsection
