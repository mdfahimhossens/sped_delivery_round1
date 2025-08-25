@extends('layouts.app')

@section('content')
<h2>Delivery Men</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="">Back Home</a>

<a href="{{ route('delivery-men.create') }}">Add New Delivery Man</a>

<table border="1" cellpadding="10" style="margin-top:10px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($deliveryMen as $man)
        <tr>
            <td>{{ $man->id }}</td>
            <td>{{ $man->name }}</td>
            <td>{{ $man->phone }}</td>
            <td>{{ ucfirst($man->status) }}</td>
            <td>
                <a href="{{ route('delivery-men.edit', $man->id) }}">Edit</a> |
                <form action="{{ route('delivery-men.destroy', $man->id) }}" method="POST" style="display:inline;">
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
