@extends('layouts.app')
@section('content')

    <h1>Orders</h1>
    <div class="container">
        <?php $ct=0; ?>
        @forelse($orders as $order)
            <?php $ct++;?>
            <h2>Order nr: {{$ct}}</h2>
            <ul>
                <li>{{ ucfirst($order->user_name) }}</li>
                <li>{{ ucfirst($order->details) }}</li>
                <li>{{ ucfirst($order->price) }}</li>
                <div class="removebutton">
                    <a href="{{ route('order.show',['order' => $order->id])  }}" name="remove">View Order</a>
                </div>
            </ul>
        @empty
        @endforelse
    </div>

@endsection
