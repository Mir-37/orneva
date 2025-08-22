@extends('layout.main')

@section('content')
    <section class="order-confirmation py-5">
        <div class="container">
            <div class="text-center mb-5">
                <i class="fa-solid fa-check-circle fa-4x text-success mb-3"></i>
                <h2>Thank you, {{ $order->user->name }}!</h2>
                <p class="text-muted">Your order <strong>{{ $order->order_no }}</strong> has been placed successfully.</p>
                <p>Status: <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></p>
            </div>

            <div class="row g-4">

                <!-- Order Items -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="mb-4">Order Details</h4>
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $item->product?->image ? asset('storage/products/' . $item->product->image) : asset('frontend/img/products/f1.jpg') }}"
                                                        class="me-3 rounded"
                                                        style="width:60px; height:60px; object-fit:cover;">
                                                    <div>
                                                        <div class="fw-semibold">
                                                            {{ $item->product?->name ?? 'Deleted Product' }}</div>
                                                        <div class="text-muted small">
                                                            {{ $item->product?->brand?->name ?? '' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="summary p-4 shadow-sm bg-white rounded">
                        <h4 class="mb-3">Order Summary</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>

                        <div class="mb-3">
                            <h5>Delivery Address</h5>
                            <p class="small mb-0">{{ $order->delivery_address }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
