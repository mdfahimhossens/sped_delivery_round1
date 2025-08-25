@extends('layouts.app')

@section('content')
<a href="{{ route('restaurants.create') }}">Add Restaurant</a>
<h2>Restaurants</h2>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Delivery Zones</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->name }}</td>
                <td>{{ $restaurant->type->name ?? 'N/A' }}</td>
                <td>{{ $restaurant->latitude ?? 'N/A' }}</td>
                <td>{{ $restaurant->longitude ?? 'N/A' }}</td>
                <td>
                    @if($restaurant->deliveryZones->count())
                        <ul>
                            @foreach($restaurant->deliveryZones as $zone)
                                <li>{{ $zone->type }} - 
                                    <a href="{{ route('delivery-zones.edit', $zone->id) }}">Edit</a> | 
                                    <form action="{{ route('delivery-zones.destroy', $zone->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ route('delivery-zones.create', ['restaurant' => $restaurant->id]) }}">Add Delivery Zone</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('restaurants.edit', $restaurant->id) }}">Edit</a> | 
                    <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
