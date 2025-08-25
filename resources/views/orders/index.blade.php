@extends('layouts.app')

@section('content')
<h2>Orders</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h3><a href="{{ route('orders.create') }}">Place New Order</a></h3>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Restaurant</th>
            <th>Delivery Man</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>
            <th>Distance (km)</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->restaurant->name ?? 'N/A' }}</td>
            
            <td>
                @if($order->deliveryMan)
                    {{ $order->deliveryMan->name }}
                @else
                    Not Assigned
                @endif
            </td>

            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->customer_phone }}</td>
            <td>{{ $order->distance_km ?? 'N/A' }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>
                @if($order->status == 'pending' || $order->status == 'assigned')
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <select name="status" required>
                        <option value="">--Change Status--</option>
                        <option value="accepted">Accept</option>
                        <option value="rejected">Reject</option>
                        <option value="processing">Processing</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
                @else
                    Done
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
