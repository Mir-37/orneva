@extends('layout.main')

@section('content')
    <section class="cart-page py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Cart Items -->
                <div class="col-lg-9">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="mb-4">Your Cart</h3>

                            @if ($cartItems->isEmpty())
                                <div class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-cart-shopping fa-3x mb-3"></i>
                                    <p>Your cart is empty.</p>
                                </div>
                            @else
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $item->product->image ? asset('storage/products/' . $item->product->image) : asset('frontend/img/products/f1.jpg') }}"
                                                            class="me-3 rounded"
                                                            style="width:60px; height:60px; object-fit:cover;">
                                                        <div>
                                                            <div class="fw-semibold">{{ $item->product->name }}</div>
                                                            <div class="text-muted small">
                                                                {{ $item->product->brand->name ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($item->product->price, 2) }}</td>
                                                <td>
                                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                        class="d-flex align-items-center">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                            min="1" class="form-control form-control-sm text-center"
                                                            style="width:70px;">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-primary ms-2">Update</button>
                                                    </form>
                                                </td>
                                                <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                                <td>
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-3">
                    <div class="summary p-4 shadow-sm bg-white rounded">
                        <h4 class="mb-3">Order Summary</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-3">
                            <span>Total</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100">Proceed to Checkout</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
