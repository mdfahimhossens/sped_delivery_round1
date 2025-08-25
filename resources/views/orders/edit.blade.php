@extends('layouts.app')

@section('content')
<h2>Edit Order #{{ $order->id }}</h2>

@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

@if($errors->any())
    <ul style="color: red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="restaurant_id">Restaurant:</label>
        <select name="restaurant_id" id="restaurant_id" required>
            <option value="">-- Select Restaurant --</option>
            @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" {{ $order->restaurant_id == $restaurant->id ? 'selected' : '' }}>
                    {{ $restaurant->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
    </div>

    <div>
        <label for="customer_phone">Customer Phone:</label>
        <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" required>
    </div>

    <div>
        <label for="delivery_latitude">Delivery Latitude:</label>
        <input type="number" step="any" name="delivery_latitude" id="delivery_latitude" value="{{ old('delivery_latitude', $order->delivery_latitude) }}" required>
    </div>

    <div>
        <label for="delivery_longitude">Delivery Longitude:</label>
        <input type="number" step="any" name="delivery_longitude" id="delivery_longitude" value="{{ old('delivery_longitude', $order->delivery_longitude) }}" required>
    </div>

    <div>
        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="pending" {{ $order->status=='pending' ? 'selected' : '' }}>Pending</option>
            <option value="assigned" {{ $order->status=='assigned' ? 'selected' : '' }}>Assigned</option>
            <option value="processing" {{ $order->status=='processing' ? 'selected' : '' }}>Processing</option>
            <option value="delivered" {{ $order->status=='delivered' ? 'selected' : '' }}>Delivered</option>
            <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <button type="submit">Update Order</button>
</form>
@endsection
