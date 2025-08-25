@extends('layouts.app')

@section('content')
<h2>Place New Order</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div>
        <label>Restaurant:</label>
        <select name="restaurant_id" required>
            <option value="">--Select--</option>
            @foreach($restaurants as $restaurant)
            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Customer Name:</label>
        <input type="text" name="customer_name" required>
    </div>

    <div>
        <label>Customer Phone:</label>
        <input type="text" name="customer_phone" required>
    </div>

    <div>
        <label>Delivery Address:</label>
        <input type="text" name="delivery_address">
    </div>

    <div>
        <label>Latitude:</label>
        <input type="number" step="0.000001" name="delivery_latitude" required>
    </div>

    <div>
        <label>Longitude:</label>
        <input type="number" step="0.000001" name="delivery_longitude" required>
    </div>

    <div>
        <label>Total Amount:</label>
        <input type="number" step="0.01" name="total_amount">
    </div>

    <button type="submit">Place Order</button>
</form>
@endsection
