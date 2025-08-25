@extends('layouts.app')

@section('content')
<h2>Delivery Zones</h2>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Restaurant</th>
            <th>Type</th>
            <th>Data</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($zones as $zone)
        <tr>
            <td>{{ $zone->restaurant->name }}</td>
            <td>{{ $zone->type }}</td>
            <td>{{ $zone->data }}</td>
            <td>
                <a href="{{ route('delivery-zones.edit', ['zone' => $zone->id]) }}">Edit</a> | 

                <form action="{{ route('delivery-zones.destroy', ['zone' => $zone->id]) }}" method="POST" style="display:inline;">
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
