@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Sped Delivery</h1>
    <p>Welcome to Sped Delivery Dashboard</p>
    <p>Use the sidebar to navigate Orders, Delivery Zones, and Delivery Men.</p>

    <div class="dashboard-links" style="margin-top: 20px;">
        <ul>
            <li><a href="{{ route('restaurants.index') }}">Restaurants</a></li>
            <li><a href="{{ route('orders.index') }}">Orders</a></li>
            <li><a href="{{ route('delivery-zones.index') }}">Delivery Zones</a></li>
            <li><a href="{{ route('delivery-men.index') }}">Delivery Men</a></li>
        </ul>
    </div>
</div>

<style>
.dashboard {
    padding: 20px;
}
.dashboard-links ul {
    list-style: none;
    padding: 0;
}
.dashboard-links ul li {
    margin: 10px 0;
}
.dashboard-links ul li a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}
.dashboard-links ul li a:hover {
    text-decoration: underline;
}
</style>
@endsection
